<template>
  <div>
    <div
      v-if="shouldDisplayApp"
      :style="{'background-color': bgColor, 'transition': '500ms background ease'}"
      class="min-h-screen relative hidden md:block"
    >
      <transition name="fade" mode="out-in">
        <router-view/>
      </transition>

      <portal-target name="modalContainer"/>
    </div>

    <no-mobile v-if="!shouldDisplayApp"/>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import noMobile from "./pages/NoMobile";

export default {
  components: {
    noMobile
  },
  data() {
    return {
      innerWidth: 0
    };
  },
  computed: {
    ...mapGetters([
      "selectedTextBgColor",
      "selectedText",
      "communityAccentLight"
    ]),

    matchedCommunityRoute() {
      return this.$route.matched.find(item => item.name === "community");
    },

    isCommunity({ matchedCommunityRoute }) {
      return matchedCommunityRoute !== undefined;
    },

    bgColor({ isCommunity, selectedTextBgColor, communityAccentLight }) {
      return isCommunity ? communityAccentLight : selectedTextBgColor;
    },
    shouldDisplayApp({ innerWidth }) {
      return innerWidth >= 1024;
    }
  },

  mounted() {
    this.$nextTick(() => {
      this.innerWidth = window.innerWidth;

      window.addEventListener("resize", () => {
        this.innerWidth = window.innerWidth;
      });
    });
  }
};
</script>