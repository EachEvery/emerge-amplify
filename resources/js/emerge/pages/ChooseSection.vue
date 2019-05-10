<template>
  <div class="h-screen flex-1 pl-16 flex flex-col justify-center">
    <div class="relative border-t-2 border-b-2 bg-white" :style="{'border-color': categoryColor}">
      <text-section-selector ref="textSelector" :text="selectedText"></text-section-selector>

      <lg-choose-section-button
        @click="chooseSection"
        :color="categoryColor"
        :show-spinner="lockingPosition"
      />

      <md-choose-section-button
        @click="chooseSection"
        :color="categoryColor"
        :color-light="selectedText.category.color_light"
        :show-spinner="lockingPosition"
      />
    </div>
  </div>
</template>
<script>
import { mapGetters, mapState, mapMutations } from "vuex";
import { HARD_RESET, SET_WORDS } from "../store/modules/builder.js";

import lgChooseSectionButton from "../components/LargeChooseSectionButton";
import mdChooseSectionButton from "../components/MediumChooseSectionButton";

import getClosestSnapPoint from "../functions/getClosestSnapPoint.js";
import textSectionSelector from "../components/TextSectionSelector";

import spinner from "../components/Spinner";
import icon from "../components/Icon";

export default {
  components: {
    icon,
    textSectionSelector,
    lgChooseSectionButton,
    mdChooseSectionButton
  },
  data() {
    return {
      offset: 0,
      state: "default"
    };
  },
  computed: {
    ...mapGetters(["selectedText"]),
    ...mapState(["selectedOffset"]),
    categoryColor({ selectedText }) {
      return selectedText.category.color;
    },
    lockingPosition({ state }) {
      return state === "lockingPosition";
    }
  },
  methods: {
    async continue() {
      this.state = "lockingPosition";
      let words = await this.$refs.textSelector.ensureSelection();

      this.$store.commit(SET_WORDS, words);

      this.$router.push("create");
    },
    chooseSection() {
      if (
        window.confirm("Choose new section? Your current poem will be reset.")
      ) {
        this.$store.commit(HARD_RESET);

        this.continue();
      } else {
        this.continue();
      }
    }
  }
};
</script>

