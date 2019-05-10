<template>
  <div class="vh-100 relative" id="community">
    <div class></div>
    <div class="absolute pin overflow-x-scroll">
      <div class="fixed pin-t pin-r mr-8 mt-3 z-20">
        <router-link
          :to="back.route"
          class="text-xs mt-8 hover:opacity-50 text-black hover:opacity-75 transition hover:no-underline"
          :style="{color: communityAccentDark}"
        >
          <icon :svg="require('back.svg')" class="w-8 mr-3 inline-block align-middle"></icon>
          <small-caps class="text-black inline-block align-middle">{{back.text}}</small-caps>
        </router-link>
      </div>

      <div class="fixed pin-t pin-x">
        <div class="h-24 transition bg-white" :style="headerStyle"/>
        <outline-heading
          class="-mb-6 md:-mt-10 relative z-50 transition px-4"
          :style="headingStyle"
        >COMMUNITY
          <br>POEMS
        </outline-heading>
      </div>

      <div class="px-4 relative">
        <transition name="fade" mode="out-in">
          <router-view/>
        </transition>
      </div>
    </div>
  </div>
</template>
<script>
import outlineHeading from "../components/OutlineHeading";
import icon from "../components/Icon";
import { mapGetters } from "vuex";
import { HARD_RESET } from "../store/modules/builder";
import { SET_SELECTED_OFFSET } from "../store/modules/texts";

export default {
  components: {
    outlineHeading,
    icon
  },
  computed: {
    ...mapGetters(["communityAccentDark"]),
    isPoemList() {
      return this.$route.name === "poemList";
    },
    back({ isPoemList }) {
      return {
        route: isPoemList ? "/" : "/poems",
        text: isPoemList ? "Create a Poem" : "View All Poems"
      };
    },
    headerStyle({ isPoemList }) {
      return isPoemList
        ? {}
        : {
            transform: "translateY(-100%)"
          };
    },
    headingStyle({ isPoemList }) {
      return isPoemList
        ? {}
        : {
            transform: "scale(.9) translateX(-80px) translateY(50px)"
          };
    }
  },
  mounted() {
    this.$store.commit(HARD_RESET);
    this.$store.commit(SET_SELECTED_OFFSET, null);
  }
};
</script>
