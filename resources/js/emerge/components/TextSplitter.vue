<template>
  <div class="container">
    <template v-for="(paragraph, p) in text.split('\n')" class="inline-block">
      <template v-for="(word, w) in paragraph.split(' ')">
        <slot :word="word" :wordKey="`${p}.${w}`"></slot>
      </template>
      <br :key="`break-${p}`">
    </template>
  </div>
</template>
<script>
export default {
  props: {
    text: {
      type: String,
      required: true
    }
  }
};
</script>

<style scoped>
span {
  display: inline-block;
}
</style>