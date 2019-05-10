<template>
  <div class="text-center transition-slow px-16 mt-3 relative builder-bottom" :style="style">
    <transition name="component-fade">
      <slot/>
    </transition>
  </div>
</template>
<script>
export default {
  props: {
    show: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    style({ show }) {
      return {
        opacity: show ? "1" : 0,
        visibility: show ? "visible" : "hidden",
        transform: show ? "translateY(0)" : "translateY(5px)"
      };
    }
  }
};
</script>
<style scoped lang="scss">
.builder-bottom {
  > * {
    position: absolute;
    right: 20%;
    left: 20%;
  }
}
</style>