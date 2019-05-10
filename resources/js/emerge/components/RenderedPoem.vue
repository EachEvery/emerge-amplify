<template>
  <poem-card>
    <poem-heading :style="{color: poem.text.category.color}" :show-title="true">
      <template v-slot:title>{{poem.title}}, by {{poem.author}}</template>
      <template v-slot:after>after {{text.title}} by {{text.author}}</template>
    </poem-heading>
    <text-frame class="overflow-hidden" :include-padding="false">
      <template v-for="word in words">
        <emerge-word
          :word-state="word"
          :key="word.id"
          :base-opacity="parseFloat(poem.opacity)"
        >{{word.word}}</emerge-word>
      </template>
    </text-frame>
  </poem-card>
</template>
<script>
import poemCard from "./PoemCard";
import poemHeading from "./PoemHeading";
import textFrame from "./TextFrame";
import emergeWord from "./EmergeWord";

export default {
  components: {
    poemCard,
    poemHeading,
    textFrame,
    emergeWord
  },
  props: {
    poem: {
      type: Object,
      required: true
    }
  },
  computed: {
    text({ poem }) {
      return poem.text;
    },
    category({ text }) {
      return text.category;
    },
    words({ poem }) {
      return JSON.parse(poem.json);
    }
  }
};
</script>
