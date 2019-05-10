<template>
  <div
    class="absolute flex flex-column justify-center pl-3 z-50 transition-slow"
    style="left: 100%"
  >
    <button
      @click.prevent="() => handleClick('reset')"
      class="text-black text-center w-16 inline-block hover:no-underline hover:text-black hover:opacity-75 transition my-3 leading-tight"
    >
      <icon :svg="require('refresh.svg')" class="w-10 block mb-2 pt-2"/>
      <small-caps class="text-xs">Reset</small-caps>
    </button>
    
    <button
      @click.prevent="() => handleClick('preview')"
      class="text-black text-center w-16 inline-block hover:no-underline hover:text-black hover:opacity-75 transition my-3 leading-tight"
    >
      <icon :svg="require('preview.svg')" class="w-10 block mb-2 pt-2"/>
      <small-caps class="text-xs">Preview</small-caps>
    </button>
    
    <button
      @click.prevent="() => handleClick('save')"
      class="text-black text-center w-16 inline-block hover:no-underline hover:text-black hover:opacity-75 transition my-3 leading-tight"
    >
      <icon :svg="require('check.svg')" class="w-10 block mb-2 pt-2"/>
      <small-caps class="text-xs">Save &amp; Post</small-caps>
    </button>
  </div>
</template>

<script>
import icon from "../components/Icon";
export default {
  components: {
    icon
  },
  methods: {
    handleClick(event) {
      this.$emit(event);
    }
  }
};
</script>