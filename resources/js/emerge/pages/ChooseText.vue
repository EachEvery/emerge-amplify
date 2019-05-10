<template>
  <div class="select-none">
    <div class="py-4 overflow-x-hidden" v-if="initialized">
      <collection-heading :collection="collection"></collection-heading>
      <div class="relative mt-5vh">
        <div
          class="bg-white absolute shadow"
          style="left: 50%; margin-left: -200px; width: 400px; height: 55vh; min-height: 410px;"
        ></div>

        <text-category class="absolute pin-t pin-x pt-4" :category="selectedText.category"></text-category>

        <swiper
          :options="swiperOptions"
          :clean-styles-on-destroy="false"
          @slideChange="updateSelectedText"
          ref="swiper"
        >
          <swiper-slide v-for="text in texts" :key="text.id" class="select-none">
            <book-cover style="height: 55vh; min-height: 410px;">
              <template v-slot:title>{{text.title}}</template>
              <template v-slot:subtitle>{{text.author}}, {{text.year}}</template>
            </book-cover>
          </swiper-slide>
        </swiper>

        <div class="absolute pin-b pin-x text-center mb-5vh z-10 mt-3vh">
          <router-link
            :to="`/${selectedText.id}/choose-section`"
            class="inline-block rounded-full py-2 px-5 transition-slow hover:no-underline active:opacity-25 transition-fast"
            :style="{'border': `1px solid ${selectedText.category.color}`}"
          >
            <span
              class="font-sans font-semibold text-black uppercase tracking-wide mb-16 transition-slow"
              :style="{'color': selectedText.category.color}"
            >Select</span>
          </router-link>
        </div>
      </div>

      <span
        class="font-sans font-semibold text-black-alpha uppercase tracking-wide text-xs block text-center mt-4vh"
      >Select a text to create with</span>
      
      <button
        @click="prevSlide"
        class="pin-l pin-y fixed w-1/3 text-transparent cursor-back min-h-screen z-40 focus:outline-none"
      >Previous</button>
      <button
        class="pin-r pin-y fixed w-1/3 text-transparent cursor-forward z-40 focus:outline-none"
        @click="nextSlide"
      >Next</button>
    </div>

    <div class="absolute pin-t pin-l m-3 z-50">
      <router-link
        to="/poems"
        class="text-xs mt-8 hover:opacity-50 text-black hover:opacity-75 transition hover:no-underline"
        :style="{color: categoryColor}"
      >
        <icon
          :svg="require('back.svg')"
          class="w-8 mr-3 inline-block align-middle"
          style="transform:rotate(180deg)"
        ></icon>
        <small-caps class="text-black inline-block align-middle mt-1">View Community Poems</small-caps>
      </router-link>
    </div>
  </div>
</template>

<script>
import "swiper/dist/css/swiper.css";
import collectionHeading from "../components/CollectionHeading";
import bookCover from "../components/BookCover";
import textCategory from "../components/TextCategory.vue";
import icon from "../components/Icon";
import {
  SET_SELECTED_TEXT,
  SET_SELECTED_OFFSET
} from "../store/modules/texts.js";
import { swiper, swiperSlide } from "vue-awesome-swiper";
import { mapState, mapGetters } from "vuex";

export default {
  components: {
    swiper,
    swiperSlide,
    bookCover,
    textCategory,
    collectionHeading,
    icon
  },
  data() {
    return {
      state: "init"
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.init();
    });
  },
  methods: {
    init() {
      this.state = "default";
    },
    updateSelectedText() {
      let index = this.$refs.swiper._data.swiper.activeIndex;

      this.$store.commit(SET_SELECTED_TEXT, this.texts[index].id);
      this.$store.commit(SET_SELECTED_OFFSET, null);
    },
    nextSlide() {
      this.$refs.swiper._data.swiper.slideNext();
    },
    prevSlide() {
      this.$refs.swiper._data.swiper.slidePrev();
    }
  },
  computed: {
    ...mapGetters(["selectedText", "categoryColor", "collection", "texts"]),
    selectedIndex({ texts, selectedText }) {
      return texts.findIndex(text => +text.id === +selectedText.id);
    },
    photoHeight({ collection }) {
      return `${collection.photo_display_height}px`;
    },
    swiperOptions({ selectedIndex }) {
      return {
        slidesPerView: 1,
        spaceBetween: 200,
        centeredSlides: true,
        initialSlide: selectedIndex
      };
    },
    initialized({ state }) {
      return state === "default";
    }
  }
};
</script>
<style lang="scss" scoped>
.swiper-container {
  width: 370px;
  margin: auto;
  overflow: visible;
}

.cursor-forward {
  cursor: url("/images/cursor--forward.png?v=2"), auto;
}

.cursor-back {
  cursor: url("/images/cursor--back.png?v=2"), auto;
}
</style>



