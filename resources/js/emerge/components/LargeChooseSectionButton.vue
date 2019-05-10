<template>
  <span @mouseover="handleMouseOver" class="hidden xl:inline">
    <button
      class="absolute z-20 pin-r pin-t mr-10 mt-5 p-2 w-32 hover:opacity-75 transition hover:no-underline block text-center"
      :style="{'color': color, 'left': '520px'}"
      @click="handleClick"
    >
      <spinner v-if="showSpinner" class="block w-8 mb-2"/>
      <icon :svg="require('check.svg')" class="block w-8 mb-2" v-else></icon>
      <br>
      <small-caps class="text-base">Create with this section</small-caps>
    </button>
  </span>
</template>
<script>
import icon from "./Icon";
import smallCaps from "./SmallCaps";
import spinner from "./Spinner";
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
  }
};
</script>