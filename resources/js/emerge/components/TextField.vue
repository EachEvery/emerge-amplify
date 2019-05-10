<template>
  <div
    :class="containerClasses"
    class="flex-column flex self-stretch transition"
    @mouseover="() => setState('hover')"
    @mouseout="() => setState('default')"
  >
    <input
      @focus="() => setState('focus')"
      @blur="() => setState('default')"
      @keyup="handleKeydown"
      :name="name"
      class="bg-transparent border-b-2 py-1 self-stretch text-lg focus:outline-none transition"
      :class="inputClass"
      :placeholder="placeholder"
      :required="required"
      :type="type"
      :disabled="disabled"
      v-if="!textarea"
    >
    
    <textarea
      v-else
      @focus="() => setState('focus')"
      @blur="() => setState('default')"
      :name="name"
      class="bg-transparent border-2 py-1 self-stretch text-lg focus:outline-none transition max-w-full h-32 p-2"
      style="resize: none;"
      :class="inputClass"
      :placeholder="placeholder"
      :required="required"
      :type="type"
      :disabled="disabled"
    ></textarea>

    <small-caps
      class="text-xs font-semibold mt-2 transition"
      :class="labelClass"
      :style="labelStyle"
    >{{label}}</small-caps>
  </div>
</template>
<script>
export default {
  props: {
    name: {
      type: String,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    type: {
      type: String,
      default: "text"
    },
    required: {
      type: Boolean,
      default: true
    },
    placeholder: {
      type: String,
      default: ""
    },
    disabled: {
      type: Boolean,
      default: false
    },
    inverted: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      state: "default"
    };
  },
  methods: {
    setState(state) {
      this.state = state;
    },
    handleKeydown(e) {
      this.$emit("keyup", e);
    }
  },
  computed: {
    hovering({ state }) {
      return state === "hover";
    },
    focusing({ state }) {
      return state === "focus";
    },
    active({ hovering, focusing, disabled }) {
      return (hovering || focusing) && !disabled;
    },
    containerClasses({ active, disabled, inverted }) {
      return {
        "text-category-color": active,
        "text-black": !active && !inverted,
        "text-white": !active && inverted,
        "opacity-50": disabled
      };
    },
    textarea({ type }) {
      return type === "textarea";
    },
    inputClass({ containerClasses, active, disabled, inverted }) {
      return {
        ...containerClasses,
        "border-category-color": active,
        "border-black": !active && !inverted,
        "border-white": !active && inverted
      };
    },
    labelClass({ containerClasses }) {
      return {
        ...containerClasses
      };
    },
    labelStyle({ active }) {
      return {
        transform: active ? "translateY(-2px) translateZ(0)" : "",
        "transform-origin": "center left"
      };
    }
  }
};
</script>
