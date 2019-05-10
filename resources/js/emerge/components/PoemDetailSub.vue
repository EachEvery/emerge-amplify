<template>
  <div
    class="absolute pin bg-black text-white px-4 pb-4 pt-12"
    style="transform: translateX(-50px) translateY(-50px)"
  >
    <button
      class="text-3xl absolute pin-t pin-r m-2 mr-3 text-white leading-tight"
      @click.prevent="handleClick"
    >&times;</button>
    <slot/>
  </div>
</template>
<script>
export default {
  props: {
    poem: {
      type: Object,
      required: true
    }
  },
  methods: {
    handleClick() {
      this.$router.replace(`/poems/${this.poem.id}`);
    }
  }
};
</script>