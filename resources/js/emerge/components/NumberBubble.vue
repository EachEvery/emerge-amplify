<template>
  <div
    class="flex w-8 h-8 rounded-full font-sans font-extrabold text-lg justify-center"
    :class="{'text-white': !inverted, 'text-black': inverted}"
    style="background: var(--category-color);"
  >
    <span class="self-center inline-block" :style="style">
      <slot/>
    </span>
  </div>
</template>
<script>
export default {
  props: {
    offset: {
      type: Number,
      defeault: 0
    },
    inverted: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    style({ offset }) {
      return {
        transform: `translateX(${offset}px)`
      };
    }
  }
};
</script>

