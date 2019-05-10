<template>
  <div>
    <small-caps
      :style="{'opacity': showingSaveForm ? 1 : 0}"
      class="absolute pin-t pin-x text-center transition mt-3vh text-lg"
    >SAVE & PUBLISH YOUR POEM</small-caps>

    <div
      class="select-none transition-slow flex justify-center -ml-12"
      :style="containerStyle"
      @click="killContextMenu"
    >
      <eager-load-font-styles/>

      <div class="flex justify-center flex-column min-h-screen relative mt-2vh">
        <button
          @click="killPreview"
          class="absolute pin-t transition font-light pin-r -mr-10 text-5xl mt-3"
          :class="{'opacity-0': !previewing}"
        >&times;</button>
        <poem-card ref="poemCard">
          <poem-heading :style="{color: categoryColor}" :show-title="showTitle">
            <template v-slot:title>{{finalPoem.title}}, by {{finalPoem.author}}</template>
            <template v-slot:after>after {{selectedText.title}} by {{selectedText.author}}</template>
          </poem-heading>

          <div class="relative">
            <text-frame
              class="overflow-hidden select-none opacity-0"
              :style="dupeFrameStyle"
              :include-padding="false"
            >
              <emerge-word
                v-for="wordState in words"
                :key="wordState.id"
                :word-state="getDupeWordState(wordState)"
                :transition="transition"
                :disabled="true"
              >{{wordState.word}}</emerge-word>
            </text-frame>
            <text-frame
              class="overflow-hidden select-none absolute pin-t pin-x"
              ref="frame"
              :include-padding="false"
            >
              <emerge-word
                v-for="wordState in words"
                :key="wordState.id"
                :word-state="wordState"
                :base-opacity="opacity"
                :transition="transition"
                :disabled="showingSaveForm"
                @toggle="toggleWord"
                @contextmenu="handleContextMenu"
              >{{wordState.word}}</emerge-word>
            </text-frame>
          </div>
        </poem-card>

        <builder-bottom-controls :show="!showingSaveForm && !previewing">
          <opacity-slider
            ref="opacitySlider"
            v-if="userHasInteracted"
            @change="updateOpacity"
            @mouseover="disableTransition"
            @mouseout="enableTransition"
          />
          <small-caps v-else>
            <poem-init-prompt>Click any word to begin</poem-init-prompt>
          </small-caps>
        </builder-bottom-controls>

        <builder-sidebar
          @reset="handleReset"
          @preview="handlePreview"
          @save="handleSave"
          :style="{opacity: showingSaveForm || previewing ? '0' : 1}"
        />
      </div>

      <portal to="modalContainer">
        <transition name="bounce">
          <word-context-menu
            v-if="showContextMenu"
            :state="contextMenuState"
            :target="contextMenuTarget.el"
            @change="handleCMChange"
          />
        </transition>
      </portal>
      <save-poem :show="showingSaveForm"/>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState, mapMutations } from "vuex";
import html2canvas from "html2canvas";
import eagerLoadFontStyles from "../components/EagerLoadFontStyles";
import savePoem from "./SavePoem";
import textFrame from "../components/TextFrame";
import emergeWord from "../components/EmergeWord";
import opacitySlider from "../components/OpacitySlider";
import wordContextMenu from "../components/WordContextMenu";
import poemInitPrompt from "../components/PoemInitPrompt";
import builderBottomControls from "../components/BuilderBottomControls";
import poemHeading from "../components/PoemHeading";
import poemCard from "../components/PoemCard";
import builderSidebar from "../components/BuilderSidebar";

import {
  TOGGLE_WORD,
  SET_WORD,
  SET_OPACITY,
  ENSURE_USER_INTERACTION,
  RESET,
  SET_BLOB
} from "../store/modules/builder.js";

export default {
  components: {
    textFrame,
    emergeWord,
    opacitySlider,
    wordContextMenu,
    poemInitPrompt,
    builderBottomControls,
    eagerLoadFontStyles,
    poemHeading,
    poemCard,
    savePoem,
    builderSidebar
  },
  data() {
    return {
      transition: true,
      contextMenuTarget: null,
      state: "default"
    };
  },
  methods: {
    getDupeWordState(state) {
      return {
        ...state,
        selected: this.userHasInteracted ? !state.selected : true
      };
    },
    killPreview() {
      if (this.previewing) {
        this.state = "default";
      }
    },
    getNormalState(state) {
      return {
        ...state
      };
    },
    disableTransition() {
      this.transition = false;
    },
    enableTransition() {
      this.transition = true;
    },
    killContextMenu() {
      this.contextMenuTarget = null;
    },
    toggleWord(wordObj) {
      this.$store.commit(SET_WORD, wordObj);
      this.$store.dispatch(ENSURE_USER_INTERACTION, 400);
    },
    handleContextMenu(id, el) {
      this.killContextMenu();

      this.$nextTick(() => {
        this.contextMenuTarget = {
          id,
          el
        };
      });
    },

    updateOpacity(val) {
      this.$store.commit(SET_OPACITY, val);
    },

    ensureOpacity() {
      if (this.userHasInteracted) {
        this.$refs.opacitySlider.setValue(this.baseOpacity);
      }
    },

    handleCMChange(wordState) {
      this.$store.commit(SET_WORD, wordState);
    },

    handlePreview() {
      this.killContextMenu();
      this.state = "preview";
    },

    handleSave() {
      if (this.words.filter(word => word.selected).length === 0) {
        alert("Please select at least one word before continuing.");
        return;
      }

      this.$router.push(this.saveRoute);
    },

    handleReset() {
      if (confirm("Reset your poem?")) {
        this.killContextMenu();
        this.$store.commit(RESET);
      }
    },

    updateBlob() {
      return new Promise(async (resolve, reject) => {
        let canvas = await html2canvas(this.$refs.poemCard.$el);
        let blob = canvas.toDataURL();

        this.$store.commit(SET_BLOB, blob);

        setTimeout(() => {
          resolve();
        }, 1000);
      });
    }
  },
  computed: {
    showTitle({ previewing, showingSaveForm }) {
      return previewing || showingSaveForm;
    },
    previewing({ state }) {
      return state === "preview";
    },
    dupeFrameStyle({ transition, opacity }) {
      return {
        opacity,
        ...(transition
          ? {
              transition: "300ms opacity ease"
            }
          : {})
      };
    },
    showingSaveForm() {
      return this.$route.name === "savePoem";
    },

    showContextMenu({ contextMenuTarget }) {
      return contextMenuTarget !== null;
    },

    contextMenuState({ words, contextMenuTarget }) {
      return words.find(word => word.id === contextMenuTarget.id);
    },

    containerStyle({ showingSaveForm, categoryColor, previewing }) {
      return {
        "--category-color": categoryColor,
        transform:
          showingSaveForm || previewing
            ? `translateX(${previewing ? "-10%" : "-36%"})`
            : "none"
      };
    },

    saveRoute() {
      return `${this.$route.path}/save`;
    },

    ...mapState({
      words: state => state.builder.words,
      baseOpacity: state => state.builder.baseOpacity,
      userHasInteracted: state => state.builder.userHasInteracted
    }),

    ...mapGetters(["selectedText", "categoryColor", "opacity", "finalPoem"])
  },

  mounted() {
    this.$nextTick(() => {
      this.ensureOpacity();
    });
  }
};
</script>