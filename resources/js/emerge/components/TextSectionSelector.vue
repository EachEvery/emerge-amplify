<template>
  <div class="relative" :style="containerStyle" ref="container">
    <text-frame
      :enable-scroll="false"
      :offset="scrollTop"
      class="overflow-visable absolute pin-t opacity-25"
    >
      <section-selector-word
        v-for="wordState in wordObjects"
        :key="wordState.id"
        :frame="frame"
        :word-state="wordState"
      >{{wordState.word}}</section-selector-word>
    </text-frame>
    <text-frame
      @scroll="handleScroll"
      ref="content"
      :enable-scroll="true"
      class="overflow-scroll absolute pin"
      :style="{'background': selectedTextBgColor}"
    >
      <section-selector-word
        v-for="wordState in wordObjects"
        :key="wordState.id"
        :frame="frame"
        :word-state="wordState"
      >{{wordState.word}}</section-selector-word>
    </text-frame>

    <div class="bg-transparent absolute pin z-10 -m-8" v-if="snapping"></div>
  </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import textFrame from "./TextFrame";
import sectionSelectorWord from "./SectionSelectorWord";
import getLineHeight from "../functions/getLineHeight.js";
import getClosestSnapPoint from "../functions/getClosestSnapPoint.js";
import animate from "../functions/animate.js";
import splitText from "../functions/splitText.js";
import { poemLineCount, sectionSelector } from "../config/builder.js";
import { SET_SELECTED_OFFSET } from "../store/modules/texts.js";

export default {
  components: {
    textFrame,
    sectionSelectorWord
  },
  props: {
    text: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      scrollTop: 0,
      snapping: false,
      containerHeight: 0,
      frameHeight: 0,
      frameTop: 0
    };
  },
  methods: {
    handleScroll(e) {
      this.scrollTop = e.target.scrollTop;
      this.$store.commit(SET_SELECTED_OFFSET, this.closestSnapPoint);
    },
    setContainerHeight() {
      this.containerHeight = this.$refs.content.viewBoxHeight;

      this.$nextTick(() => {
        this.setFrameDemensions();
      });
    },
    ensureSelection() {
      return new Promise(async (resolve, reject) => {
        this.snapping = true;

        await animate(
          this.$refs.content.$el,
          "scrollTop",
          this.closestSnapPoint
        );

        this.snapping = false;

        let words = this.$refs.content.$children
          .filter(item => item.isInsideFrame())
          .map(item => item.wordState);

        resolve(words);
      });
    },
    initScrollPosition() {
      this.$refs.content.$el.scrollTop = this.selectedOffset;
    },
    setFrameDemensions() {
      let $el = this.$refs.content.$el;

      this.frameHeight = $el.clientHeight;
      this.frameTop = $el.getBoundingClientRect().top;
    }
  },
  computed: {
    ...mapGetters(["selectedTextBgColor", "wordObjects"]),
    ...mapState({
      selectedOffset: state => state.texts.selectedOffset
    }),

    closestSnapPoint() {
      return this.$refs.content.closestSnapPoint;
    },

    snapPointDiff() {
      return this.$refs.content.snapPointDiff;
    },

    frame({ frameHeight, frameTop }) {
      return {
        height: frameHeight,
        top: frameTop
      };
    },

    containerStyle({ text, containerHeight }) {
      return {
        backgroundColor: "#fff",
        height: `${containerHeight}px`
      };
    }
  },
  mounted() {
    this.$nextTick(() => {
      this.setContainerHeight();
      this.initScrollPosition();
    });
  }
};
</script>


