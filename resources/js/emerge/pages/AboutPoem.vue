<template>
  <poem-detail-sub :poem="poem" class="flex flex-column justify-between">
    <small-caps class="text-center text-lg block">About this Poem</small-caps>

    <p class="font-serif text-lg block px-10 font-semibold mb-12">{{poem.text.about_text}}</p>

    <a
      :href="poem.text.about_link"
      class="text-black rounded-full w-64 mx-auto h-12 flex justify-center mt-5 mb-10 bg-white transition hover:opacity-50 focus:opacity-50 focus:outline-none hover:no-underline hover:text-black"
      target="_blank"
    >
      <small-caps class="self-center">{{buttonText}}</small-caps>
    </a>
  </poem-detail-sub>
</template>
<script>
import poemDetailSub from "../components/PoemDetailSub";

export default {
  components: {
    poemDetailSub
  },
  props: {
    poem: {
      type: Object,
      required: true
    }
  },
  computed: {
    buttonText({ poem }) {
      if (poem.text.about_button_text) {
        return poem.text.about_button_text;
      }

      return "Learn More";
    }
  }
};
</script>