<template>
  <div>
    <input type="hidden" name="_token" v-bind:value="token">
    <input type="hidden" name="_method" :value="method" v-if="method !== ''">
  </div>
</template>

<script>
export default {
  props: {
    method: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      token: window.Laravel.csrf
    };
  },
  methods: {
    async fetchToken() {
      let response = await window.axios.get("/csrf");

      return Promise.resolve(response.data);
    },
    async refreshToken() {
      let token = await this.fetchToken();

      this.token = token;
    }
  },
  created() {
    this.interval = setInterval(() => {
      this.refreshToken();
    }, 1000 * 120);
  },
  destroyed() {
    window.clearInterval(this.interval);
  }
};
</script>
