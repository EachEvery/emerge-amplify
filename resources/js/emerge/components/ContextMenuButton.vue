<template>
  <button
    :aria-label="label"
    class="h-8 w-8 rounded-full flex justify-center no-select"
    :class="buttonClass"
    style="border: 1px solid #464646; margin-left: 2px; margin-right: 2px"
    data-kill-context-menu="false"
    @click.prevent="handleClick"
  >
    <slot/>
  </button>
</template>

<script>
import icon from "./Icon";
export default {
  components: {
    icon
  },
  props: {
    label: {
      type: String,
      required: true
    },
    inverted: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    handleClick(e) {
      this.$emit("click", e);
    }
  },
  computed: {
    buttonClass({ inverted }) {
      return {
        "text-white": inverted,
        "bg-black": inverted,

        "text-black": !inverted,
        "bg-white": !inverted
      };
    }
  }
};
</script>
<style scoped lang="scss">
button {
  transition: 300ms all ease;
  transform: translateZ(0);
  &:active,
  &:focus {
    outline: none;
    transform: scale(0.9);
    color: black;
  }
}
</style>