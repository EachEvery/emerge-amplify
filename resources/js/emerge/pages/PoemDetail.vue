<template>
  <transition name="fade">
    <div v-if="poemLoaded" class="flex justify-center">
      <div class="mt-24 relative">
        <rendered-poem :poem="poem"/>

        <transition name="fadeUp">
          <share-poem v-if="showingShare" :poem="poem"/>
          <about-poem v-else-if="showingAbout" :poem="poem"/>
        </transition>

        <div
          class="absolute flex flex-column justify-center pl-3 z-50 transition-slow pin-y"
          style="left: 100%"
        >
          <sidebar-button
            v-if="hasAboutText"
            :icon="require('question.svg')"
            @click="() => route('about')"
            :style="aboutButtonStyle"
          >About</sidebar-button>

          <sidebar-button
            :icon="require('email.svg')"
            @click="() => route('share')"
            :style="shareButtonStyle"
          >Share</sidebar-button>

          <sidebar-button
            :icon="require('print.svg')"
            @click="handlePrint"
            :style="printButtonStyle"
          >Print</sidebar-button>
        </div>
      </div>

      <portal to="modalContainer">
        <rendered-poem :poem="poem" id="poem"/>
      </portal>
    </div>
  </transition>
</template>

<script>
import { mapState } from "vuex";
import { FETCH_POEM } from "../store/modules/poems.js";
import { SET_ACCENT_COLOR } from "../store/modules/community.js";

import renderedPoem from "../components/RenderedPoem";
import sidebarButton from "../components/SidearButton";
import sharePoem from "./SharePoem";
import aboutPoem from "./AboutPoem";

export default {
  components: {
    renderedPoem,
    sidebarButton,
    sharePoem,
    aboutPoem
  },
  methods: {
    route(route) {
      this.$router.push(`/poems/${this.poem.id}/${route}`);
    },
    handlePrint() {
      window.print();
    },
    fetchPoem() {
      return this.$store.dispatch("poems/" + FETCH_POEM, this.poemId);
    },
    async ensurePoem() {
      if (!this.shouldFetchPoem) return;

      setTimeout(async () => {
        this.notFoundIf((await this.fetchPoem()) === undefined);
      }, 250);
    },
    notFoundIf(notFound) {
      if (notFound) {
        this.$router.replace("/404");
      }
    },
    ensureBg() {
      if (this.poem !== undefined) {
        let cat = this.poem.text.category;

        this.$store.commit(SET_ACCENT_COLOR, {
          light: cat.color_light,
          dark: cat.color
        });
      }
    }
  },
  computed: {
    ...mapState("poems", ["poems"]),
    aboutButtonStyle({ subrouteActive, showingAbout }) {
      if (subrouteActive && !showingAbout) {
        return {
          opacity: 0.3
        };
      }
    },
    shareButtonStyle({ subrouteActive, showingShare }) {
      if (subrouteActive && !showingShare) {
        return {
          opacity: 0.3
        };
      }
    },
    printButtonStyle({ subrouteActive }) {
      if (subrouteActive) {
        return {
          opacity: 0.3
        };
      }
    },
    poemLoaded({ poem }) {
      return poem !== undefined;
    },
    shouldFetchPoem({ poem }) {
      return poem === undefined;
    },
    poemId() {
      return this.$route.params.poemId;
    },
    poem({ poems }) {
      return poems.find(poem => +poem.id === +this.$route.params.poemId);
    },
    showingAbout() {
      return this.$route.name === "about";
    },
    showingShare() {
      return this.$route.name === "share";
    },
    subrouteActive() {
      return this.$route.name !== "poemRoot";
    },
    hasAboutText({ poem }) {
      return poem.text.about_text && poem.text.about_text.trim() !== "";
    }
  },
  watch: {
    poem: function() {
      this.ensureBg();
    }
  },
  mounted() {
    console.log(this.poem);
    this.ensurePoem();
    this.$nextTick(() => {
      this.ensureBg();
    });
  }
};
</script>

<style lang="scss">
#poem {
  display: none;
}

@media print {
  #poem {
    display: block !important;
  }

  #community {
    display: none;
  }
}
</style>