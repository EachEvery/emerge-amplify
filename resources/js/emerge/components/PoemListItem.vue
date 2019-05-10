<template>
  <router-link
    :to="`/poems/${poem.id}`"
    class="relative w-64 h-64 inline-block no-underline text-black hover:text-black transition-slow"
    :style="containerStyle"
    @mouseover.native="() => setState('hover')"
    @mouseout.native="() => setState('default')"
  >
    <div
      class="absolute pin flex flex-column bg-white p-2 px-2 leading-normal transition"
      :style="backStyle"
    >
      <small-caps class="mb-1">after {{afterText}}</small-caps>
      <small-caps :style="{color: category.color}">by {{text.author}}</small-caps>
    </div>

    <div
      class="absolute pin flex flex-column justify-between text-white px-3 py-2 pt-4 transition"
      :style="frontStyle"
    >
      <div>
        <h1 class="font-serif text-3xl w-48">{{poem.title}}</h1>
        <small-caps class="text-xs">by {{poem.author}}</small-caps>
      </div>

      <small-caps class="text-sm">{{category.name}}</small-caps>
    </div>
  </router-link>
</template>

<script>
export default {
  props: {
    poem: {
      type: Object,
      required: true
    },
    shouldFadeIn: {
      type: Boolean,
      required: false
    }
  },
  data({ hidding }) {
    return {
      state: this.shouldFadeIn ? "hidding" : "default"
    };
  },
  methods: {
    setState(state) {
      this.state = state;
    }
  },
  computed: {
    hidding({ state }) {
      return state === "hidding";
    },
    containerStyle({ hidding }) {
      return {
        opacity: hidding ? 0 : 1,
        transform: `translateY(${hidding ? 3 : 0}px)`
      };
    },
    hovering({ state }) {
      return state === "hover";
    },
    backStyle({ hovering }) {
      let translate = hovering ? "-23px" : "-20px";

      return {
        transform: `translateY(${translate}) translateX(${translate})`,
        fontSize: ".75em"
      };
    },
    category({ poem }) {
      return poem.text.category;
    },
    text({ poem }) {
      return poem.text;
    },
    afterText({ text }) {
      return text.title.length > 33
        ? text.title.substr(0, 33) + "..."
        : text.title;
    },
    frontStyle({ hovering, category }) {
      let transform = `translateY(${hovering ? "53px" : "50px"}) translateX(${
        hovering ? "3px" : "0px"
      })`;

      return {
        transform,
        background: category.color
      };
    }
  },
  mounted() {
    if (this.shouldFadeIn) {
      setTimeout(() => {
        this.state = "default";
      }, 500);
    }
  }
};
</script>