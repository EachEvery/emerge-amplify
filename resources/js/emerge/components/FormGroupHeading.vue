<template>
  <div class="flex relative h-8">
    <number-bubble
      :offset="offset"
      class="absolute mr-4"
      :inverted="inverted"
      style="right: 100%;"
    >{{number}}</number-bubble>
    <small-caps class="self-center" :class="{'text-white': inverted}">
      <slot/>
    </small-caps>
  </div>
</template>
<script>
import numberBubble from "./NumberBubble";

export default {
  components: {
    numberBubble
  },
  props: {
    number: {
      type: String,
      required: true
    },
    inverted: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    offset({ number }) {
      return number === "1" ? -1 : 0;
    }
  }
};
</script>