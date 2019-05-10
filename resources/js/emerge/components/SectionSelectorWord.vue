<template>
  <span class="inline-block" ref="el" v-if="!wordState.isLineBreak" style="margin-right:5px;">
    <slot/>
  </span>
  <br v-else ref="el">
</template>

<script>
export default {
  props: {
    frame: {
      type: Object,
      default: {
        top: 0,
        height: 0
      }
    },
    wordState: {
      type: Object,
      required: true
    }
  },
  methods: {
    isInsideFrame() {
      let wordTop = this.$refs.el.getBoundingClientRect().top;
      let wordHeight = this.$refs.el.clientHeight;

      let wordIsInsideFrame =
        wordTop >= this.frame.top &&
        wordTop <= this.frame.top + this.frame.height - 5;

      return wordIsInsideFrame;
    }
  }
};
</script>