<template>
  <div class="flex justify-end pr-32 relative pt-40vh">
    <div style="max-width: 1100px" class="text-right">
      <poem-list-item
        v-for="poem in poems"
        :key="poem.id"
        :poem="poem"
        class="md:ml-12 mb-32 text-left z-40"
        :should-fade-in="shouldFadeIn(poem.id)"
      />
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import { INIT_POEMS } from "../store/modules/poems.js";
import {
  SET_ACCENT_COLOR,
  DEFAULT_ACCENT_COLORS
} from "../store/modules/community.js";
import poemListItem from "../components/PoemListItem";

export default {
  components: {
    poemListItem
  },
  props: {
    query: {
      type: Object,
      default: () => {}
    },
    fadeIn: {
      type: String
    }
  },
  data() {
    return {
      state: "default"
    };
  },

  methods: {
    async ensurePoems() {
      this.state = "loading";

      await this.$store.dispatch("poems/" + INIT_POEMS, this.query);
      this.state = "default";
    },
    shouldFadeIn(id) {
      return parseInt(this.fadeIn) === parseInt(id);
    }
  },

  computed: {
    ...mapState("poems", ["poems"]),
    loading({ state }) {
      return state === "loading";
    }
  },
  mounted() {
    this.ensurePoems();
    this.$nextTick(() => {
      this.$store.commit(SET_ACCENT_COLOR, {
        light: "#EDFAF5",
        dark: "#60d9a7"
      });
    });
  }
};
</script>

