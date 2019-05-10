<template>
  <div class="absolute font-bold flex" :style="containerStyle" ref="container">
    <cmb label="Make word bold" :inverted="state.bold" @click="() => handleChange('bold')">
      <span class="font-serif font-extrabold text-lg" style="line-height: 1;">B</span>
    </cmb>

    <cmb
      label="Make word underline"
      :svg="require('back.svg')"
      class="-mt-3"
      :inverted="state.underline"
      @click="() => handleChange('underline')"
    >
      <span class="underline font-serif text-lg" style="line-height: 1;">U</span>
    </cmb>

    <cmb
      label="Make word italic"
      :svg="require('back.svg')"
      @click="() => handleChange('italic')"
      :inverted="state.italic"
    >
      <span class="font-italic font-serif text-lg" style="line-height: 1;">I</span>
    </cmb>
  </div>
</template>

<script>
import cmb from "./ContextMenuButton";

export default {
  components: {
    cmb
  },
  props: {
    target: {
      type: HTMLElement,
      required: true
    },
    state: {
      type: Object,
      required: true
    }
  },
  methods: {
    handleChange(propToToggle) {
      this.$emit("change", {
        ...this.state,
        [propToToggle]: !this.state[propToToggle]
      });
    }
  },
  data() {
    return {
      clientWidth: 0
    };
  },
  computed: {
    containerStyle({ target, clientWidth }) {
      const bounds = target.getBoundingClientRect();
      const height = target.clientHeight;

      const widthDifference = clientWidth - target.clientWidth;
      const left = bounds.left - widthDifference / 2;

      return {
        left: `${left}px`,
        top: `${bounds.top - height}px`
      };
    }
  },
  mounted() {
    this.$nextTick(() => {
      this.clientWidth = this.$refs.container.clientWidth;
    });
  }
};
</script>
