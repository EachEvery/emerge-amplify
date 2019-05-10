<template>
  <div
    @mouseover="handleMouseOver"
    @mouseout="handleMouseOut"
    class="relative flex align-center flex-row rounded-full transition"
    style="height: 24px;"
    :style="{'border': state === 'focus' ? '2px solid var(--category-color)' : '2px solid transparent'}"
  >
    <div
      style="top: 50%; height: 2px; margin-top: -1px;"
      class="bg-black absolute pin-x opacity-50"
    ></div>

    <div
      class="rounded-full bg-white shadow absolute pin-t thumb"
      style="width: 24px; height: 24px; margin-left: -12px;"
      :style="thumbStyle"
    ></div>
    <input
      type="range"
      v-model="sliderValue"
      ref="slider"
      class="absolute pin opacity-0 w-full h-full"
      :min="min"
      :max="max"
      @focus="handleFocus"
      @blur="handleBlur"
    >
  </div>
</template>
<script>
export default {
  props: {
    min: {
      type: String,
      default: "3"
    },
    max: {
      type: String,
      default: "40"
    }
  },
  data() {
    return {
      sliderValue: 15,
      state: "default",
      timeout: null
    };
  },

  watch: {
    sliderValue: function(val) {
      this.$emit("change", val);
    }
  },
  methods: {
    handleMouseOver() {
      this.$emit("mouseover");
    },
    handleMouseOut() {
      this.$emit("mouseout");
    },
    setValue(val) {
      this.sliderValue = val;
    },
    handleFocus() {
      this.state = "focus";
    },
    handleBlur() {
      this.state = "default";
    }
  },
  computed: {
    thumbStyle({ sliderValue, max, min }) {
      let totalSteps = +max - +min + 1;
      let currentStep = +sliderValue - +min + 1;

      return {
        left: `${(+currentStep / +totalSteps) * 100}%`
      };
    }
  }
};
</script>

<style lang="scss" scoped>
input[type="range"] {
  cursor: -webkit-grab;
  &:active {
    cursor: -webkit-grabbing;
  }
}
</style>