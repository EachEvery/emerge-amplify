<template>
  <div :class="className" v-html="svg"></div>
</template>

<style module lang="scss">
.svg {
  fill: currentColor;
  margin-top: -4px;
  vertical-align: middle;
}
</style>

<script>
export default {
  props: ["svg", "fullWidth"],
  mounted() {
    this.$el.firstChild.classList.add(this.$style.svg);
    this.$el.firstChild.removeAttribute("height");
    this.$el.firstChild.removeAttribute("width");
  },
  computed: {
    className() {
      return this.fullWidth
        ? "icon svg inline-block full-width"
        : "icon svg inline-block";
    }
  }
};
</script>