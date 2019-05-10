<template>
  <div class="md:flex h-screen overflow-hidden relative">
    <div class="absolute pin-t pin-l m-3 z-20">
      <router-link
        :to="back.route"
        class="text-xs mt-8 hover:opacity-50 text-black hover:opacity-75 transition hover:no-underline"
        :style="{color: categoryColor}"
      >
        <icon :svg="require('back.svg')" class="w-8 mr-3"></icon>
        <small-caps class="text-black">{{back.text}}</small-caps>
      </router-link>
    </div>

    <div
      class="min-h-screen hidden md:flex md:flex-no-grow xl:flex-grow flex-col justify-center transition-slow px-16 max-w-md"
      :class="bgClass"
      style="min-height: 600px;"
      :style="collectionHeadingStyle"
    >
      <collection-heading :collection="collection" class="mb-20 transition"></collection-heading>
      <text-category class="mb-2" :category="selectedText.category"></text-category>

      <book-cover class="self-center mb-24" style="width: 370px;">
        <template v-slot:title>{{selectedText.title}}</template>
        <template v-slot:subtitle>{{selectedText.author}}, {{selectedText.year}}</template>
      </book-cover>
    </div>

    <router-view class="-mr-10"></router-view>
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import bookCover from "../components/BookCover";
import textCategory from "../components/TextCategory";
import collectionHeading from "../components/CollectionHeading";
import { SET_SELECTED_TEXT } from "../store/modules/texts.js";
import icon from "../components/Icon";

export default {
  components: {
    icon,
    bookCover,
    textCategory,
    collectionHeading
  },
  computed: {
    ...mapGetters(["selectedText", "categoryColor", "collection"]),
    choosingSection() {
      return this.$route.name === "chooseSection";
    },
    savingPoem() {
      return this.$route.name === "savePoem";
    },
    bgClass({ choosingSection }) {
      return choosingSection ? "bg-white" : "bg-transparent";
    },
    back({ choosingSection, selectedText }) {
      let backinfo = {
        chooseSection: {
          text: "select a new text",
          route: "/"
        },
        create: {
          text: "select a new section",
          route: `/${selectedText.id}/choose-section`
        },
        savePoem: {
          text: "edit your poem",
          route: `/${selectedText.id}/create`
        }
      };
      return backinfo[this.$route.name];
    },
    collectionHeadingStyle({ choosingSection, savingPoem }) {
      return {
        transform: choosingSection
          ? "scale(1.09) translateZ(0)"
          : savingPoem
          ? "scale(0.8) translateX(-100%) translateZ(0)"
          : "scale(0.8) translateX(0) translateZ(0)"
      };
    }
  },
  created() {
    this.$store.commit(SET_SELECTED_TEXT, this.$route.params.textId);
  }
};
</script>