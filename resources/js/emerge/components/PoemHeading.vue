<template>
  <div class="mx-24 pt-8 absolute pin-t pin-x text-center">
    <h1
      slot="title"
      class="font-serif font-semibold text-lg text-black transition"
      :class="{'opacity-0': !showTitle}"
    >
      <slot name="title">&nbsp;</slot>
    </h1>
    <small-caps class="text-xs">
      <slot name="after"/>
    </small-caps>
  </div>
</template>
<script>
import smallCaps from "./SmallCaps.vue";
export default {
  components: {
    smallCaps
  },
  props: {
    showTitle: {
      type: Boolean,
      default: true
    }
  }
};
</script>