<template>
  <div
    :style="frameStyle"
    class="whitespace-pre-wrap font-serif text-xl"
    @scroll="handleScroll"
    ref="container"
  >
    <div :style="slotContainerStyle" ref="content">
      <slot/>
    </div>
  </div>
</template>
<script>
import { poemLineCount, frame, sectionSelector } from "../config/builder.js";
import getLineHeight from "../functions/getLineHeight.js";
import getClosestSnapPoint from "../functions/getClosestSnapPoint.js";
import $ from "jquery";

export default {
  props: {
    offset: {
      type: Number,
      default: 0
    },
    enableScroll: {
      type: Boolean,
      default: false
    },
    snapOnLoad: {
      type: Boolean,
      default: false
    },
    includePadding: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      width: frame.width,
      lineHeight: 0,
      scrollTop: 0
    };
  },
  methods: {
    ensureLineHeight() {
      this.lineHeight = getLineHeight(this.$refs.content);
    },
    handleScroll(e) {
      if (this.enableScroll) {
        this.scrollTop = e.target.scrollTop;
        this.$emit("scroll", e, this.closestSnapPoint);
      }
    },

    init() {
      this.ensureLineHeight();
    }
  },
  computed: {
    frameStyle({ viewBoxHeight, width }) {
      return {
        height: `${viewBoxHeight}px`
      };
    },

    snapPointDiff({ scrollTop, closestSnapPoint }) {
      return Math.abs(closestSnapPoint - scrollTop);
    },

    viewBoxHeight({ verticalPadding, lineHeight }) {
      const halfVp = verticalPadding / 2;
      return lineHeight * poemLineCount - verticalPadding * 2;
    },

    verticalPadding() {
      return sectionSelector.verticalPadding;
    },

    slotContainerStyle({
      offset,
      verticalPadding,
      enableScroll,
      width,
      includePadding
    }) {
      return {
        transform: enableScroll ? "" : `translateY(${offset * -1}px)`,
        padding: includePadding
          ? `${sectionSelector.verticalPadding}px 0`
          : "0px",
        width: `${width}px`
      };
    },

    closestSnapPoint({ scrollTop, lineHeight }) {
      return getClosestSnapPoint(scrollTop, lineHeight);
    }
  },

  mounted() {
    this.$nextTick(() => {
      this.init();
    });
  }
};
</script>