<template>
  <div
    class="flex-1 px-24 justify-center flex-column flex transition-slow"
    style="width: 550px; box-sizing: content-box"
    :style="containerStyle"
  >
    <form method="post" @submit.prevent="handleSubmit" ref="form">
      <form-group-heading number="1">about your poem</form-group-heading>

      <text-field
        label="Title"
        name="poem[title]"
        placeholder="Enter a title for your poem"
        class="mt-4"
        :disabled="disableFields"
        @keyup="setTitle"
      />

      <text-field
        label="Your Name"
        name="poem[author]"
        placeholder="Enter your name"
        class="mt-4"
        @keyup="setAuthor"
        :disabled="disableFields"
      />

      <text-field
        label="Email (to receive poem via email)"
        name="poem[email]"
        type="email"
        placeholder="test@example.com"
        class="mt-4"
        :disabled="disableFields"
      />

      <text-field
        label="Phone (to receive poem via text)"
        name="poem[phone]"
        placeholder="(330) 555-1234"
        v-inputmask="'(999) 999-9999'"
        :required="false"
        class="mt-4"
        :disabled="disableFields"
      />

      <form-group-heading number="2" class="mt-5">submit your poem</form-group-heading>

      <p
        class="text-base mt-3 leading-normal max-w-sm"
      >When you're ready to submit your poem, click the button below!</p>

      <button
        class="bg-black text-white rounded-full w-64 h-12 flex justify-center mt-2 hover:bg-category-color focus:bg-category-color transition focus:outline-none"
        :disabled="disableFields"
      >
        <transition name="fadeFixed">
          <small-caps v-if="!disableFields" class="self-center">Submit Poem</small-caps>
          <spinner v-if="loading" class="self-center w-6"/>
          <icon v-if="saved" :svg="require('check.svg')" class="self-center w-6 text-white"/>
        </transition>
      </button>
      
      <input type="hidden" name="poem[opacity]" :value="opacity">
      <input type="hidden" name="poem[text_id]" :value="selectedText.id">
      <input type="hidden" name="poem[collection_id]" :value="collection.id">
      <input type="hidden" name="poem[json]" :value="poemJson">
      <!-- <input type="hidden" name="base64" :value="blob"> -->
      <csrf-field/>
    </form>
  </div>
</template>
<script>
import formGroupHeading from "../components/FormGroupHeading";
import textField from "../components/TextField";
import csrfField from "../components/CsrfField";
import icon from "../components/Icon";
import spinner from "../components/Spinner";
import $ from "jquery";
import { mapGetters } from "vuex";
import { storePoem } from "../api";
import {
  SET_FINAL_POEM_TITLE,
  SET_FINAL_POEM_AUTHOR
} from "../store/modules/builder";

export default {
  components: {
    formGroupHeading,
    textField,
    csrfField,
    icon,
    spinner
  },
  props: {
    show: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      state: "default"
    };
  },
  methods: {
    async handleSubmit() {
      this.state = "loading";

      const formData = new FormData(this.$refs.form);

      await this.$parent.updateBlob();

      formData.append("base64", this.blob);

      let response = await storePoem(formData);

      this.state = "saved";

      setTimeout(() => {
        this.$router.push(`/poems?fadeIn=${response.data.id}`);
      }, 500);
    },
    setTitle(e) {
      this.$store.commit(SET_FINAL_POEM_TITLE, e.target.value);
    },
    setAuthor(e) {
      this.$store.commit(SET_FINAL_POEM_AUTHOR, e.target.value);
    }
  },
  computed: {
    ...mapGetters([
      "poemJson",
      "selectedText",
      "collection",
      "blob",
      "opacity"
    ]),
    containerStyle({ show }) {
      return {
        opacity: show ? 1 : 0,
        visability: show ? "visible" : "hidden",
        transform: show
          ? "scale(1) translateY(10px) translateX(4em)"
          : "scale(.9) translateY(0)"
      };
    },
    disableFields({ saved, loading }) {
      return saved || loading;
    },
    saved({ state }) {
      return state === "saved";
    },
    loading({ state }) {
      return state === "loading";
    }
  }
};
</script>


<style lang="scss" scoped>
form {
  position: relative;

  &::before {
    content: "";
    position: absolute;

    right: 100%;
    width: 1px;
    background: var(--category-color, blue);
    top: 0;
    bottom: 0;
    margin-right: 7em;
  }
}
</style>