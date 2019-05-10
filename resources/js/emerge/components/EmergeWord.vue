<template>
  <button
    v-if="!wordState.isLineBreak"
    @click="handleClick"
    @contextmenu.prevent="handleContextMenu"
    :key="wordState.id"
    class="outline-none"
    :class="wordClass"
    :style="wordStyle"
    :disabled="disabled"
    ref="el"
  >
    <slot/>
  </button>
  <br v-else ref="el">
</template>

<script>
export default {
  props: {
    wordState: {
      type: Object,
      required: true
    },
    transition: {
      type: Boolean,
      default: true
    },
    disabled: {
      type: Boolean,
      default: false
    },
    baseOpacity: {
      type: Number,
      default: 0
    }
  },
  methods: {
    handleClick() {
      if (this.disabled) return;
      this.$emit("toggle", {
        ...this.wordState,
        selected: !this.wordState.selected
      });
    },
    handleContextMenu() {
      if (this.disabled) return;
      this.$emit("contextmenu", this.wordState.id, this.$refs.el);
    }
  },

  computed: {
    wordStyle({ wordState, transition, baseOpacity }) {
      return {
        opacity: wordState.selected ? 1 : baseOpacity,
        "text-decoration": wordState.underline ? "underline" : "none",
        fontWeight: wordState.bold ? 800 : 400,
        fontStyle: wordState.italic ? "italic" : "normal",
        transition: transition ? "400ms opacity ease, 400ms transform ease" : ""
      };
    },

    wordClass({ wordState, disabled }) {
      return {
        bounce: wordState.selected && !disabled,
        "cursor-pointer ": !disabled,
        "cursor-default": disabled
      };
    }
  }
};
</script>

<style scoped lang='scss'>
button {
  backface-visibility: hidden;
  transform: translateZ(0);
  -webkit-font-smoothing: subpixel-antialiased;

  &:active {
    color: rgba(0, 0, 0, 0.847059);
  }

  &:focus {
    color: rgba(0, 0, 0, 0.8);
    outline: none;
    opacity: 1;
  }

  margin-right: 5px;

  &[disabled="disabled"] {
    color: black;
  }
}

.bounce {
  animation: bounce 700ms cubic-bezier(0.58, 0, 0.42, 1);
}

@keyframes bounce {
  0% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(-1px) scale(1.03);
  }

  100% {
    transform: translateY(0);
  }
}
</style>