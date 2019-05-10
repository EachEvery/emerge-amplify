<template>
  <button
    @click="handleClick"
    class="text-black text-center w-16 inline-block hover:no-underline hover:text-black hover:opacity-75 transition my-3 leading-tight"
  >
    <icon :svg="icon" class="w-10 block mb-2 pt-2"/>
    <small-caps class="text-xs">
      <slot/>
    </small-caps>
  </button>
</template>
<script>
import icon from "./Icon";

export default {
  props: {
    icon: {
      type: String,
      required: true
    }
  },
  components: {
    icon
  },
  methods: {
    handleClick(e) {
      this.$emit("click", e);
    }
  }
};
</script>