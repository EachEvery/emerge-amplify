<template>
  <span
    @mouseover="handleMouseOver"
    class="fixed hidden md:inline-block xl:hidden bg-white rounded-full mt-3"
    :style="containerStyle"
  >
    <button class="inline-block rounded-full" @click="handleClick" :style="buttonStyle">
      <spinner class="block w-8 mb-2" v-if="showSpinner"/>

      <icon :svg="require('check.svg')" class="block w-8 mb-2" v-else></icon>

      <small-caps class="text-sm">Create with this section</small-caps>
    </button>
  </span>
</template>
<script>
import icon from "./Icon";
import spinner from "./Spinner";
import smallCaps from "./SmallCaps";
export default {
  components: {
    icon,
    smallCaps,
    spinner
  },
  props: {
    color: {
      type: String,
      required: true
    },
    colorLight: {
      type: String,
      required: true
    },
    showSpinner: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    handleClick(e) {
      this.$emit("click", e);
    },
    handleMouseOver(e) {
      this.$emit("mouseover", e);
    }
  },
  computed: {
    buttonStyle({ color, colorLight }) {
      return {
        color: color,
        left: 0,
        padding: "5px 10px",
        background: colorLight
      };
    },
    containerStyle() {
      return {
        left: "110px",
        bottom: "6vh"
      };
    }
  }
};
</script>