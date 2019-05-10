<template>
  <div class="text-center">
    <img :src="collection.photo_url" :style="{'height': height}">
    <h1
      class="font-sans font-semibold text-black-alpha uppercase tracking-wide text-sm mt-3vh"
    >{{collection.title}}</h1>
  </div>
</template>
<script>
export default {
  props: {
    collection: {
      type: Object,
      required: true
    }
  },
  computed: {
    height({ collection }) {
      return `12vh`;
    }
  }
};
</script>