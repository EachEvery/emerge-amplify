<template>
  <poem-detail-sub :poem="poem" :style="{'--category-color': poem.text.category.color}">
    <small-caps class="text-center text-lg block">Share this Poem</small-caps>
    <form class="px-16 pt-10" ref="form" @submit.prevent="handleSubmit">
      <text-field
        :disabled="disableFields"
        :inverted="true"
        label="Your Name *"
        name="message[from_name]"
        placeholder="Jane Smith"
        class="mt-4"
      />

      <text-field
        :disabled="disableFields"
        :inverted="true"
        label="Receiver Email *"
        name="message[to_email]"
        placeholder="Who should receive this poem?"
        type="email"
        class="mt-4"
      />

      <text-field
        :disabled="disableFields"
        :inverted="true"
        :required="false"
        label="Add a Note"
        name="message[note]"
        type="textarea"
        class="mt-4"
      />

      <input type="hidden" name="message[poem_id]" :value="poem.id">
      
      <button
        class="text-black rounded-full w-64 mx-auto h-12 flex justify-center mt-5 bg-white transition hover:opacity-50 focus:opacity-50 focus:outline-none"
        :disabled="disableFields"
      >
        <transition name="fadeFixed">
          <small-caps v-if="!disableFields" class="self-center">Share Poem</small-caps>
          <spinner v-if="loading" class="self-center w-6 text-black"/>
          <icon v-if="saved" :svg="require('check.svg')" class="self-center w-6 text-black"/>
        </transition>
      </button>
    </form>
  </poem-detail-sub>
</template>
<script>
import poemDetailSub from "../components/PoemDetailSub";
import textField from "../components/TextField";
import formGroupHeading from "../components/FormGroupHeading";
import spinner from "../components/Spinner";
import icon from "../components/Icon";
import { storeMessage } from "../api";

export default {
  components: {
    poemDetailSub,
    formGroupHeading,
    textField,
    spinner,
    icon
  },
  props: {
    poem: {
      type: Object,
      required: true
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

      let response = await storeMessage(this.$refs.form);

      this.state = "saved";

      setTimeout(() => {
        this.$router.replace(`/poems/${this.poem.id}`);
      }, 500);
    }
  },
  computed: {
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