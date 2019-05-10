require("../bootstrap");

import Vue from "vue";
import Emerge from "./Emerge.vue";
import PortalVue from "portal-vue";
import VInputmask from "v-inputmask";

import store from "./store";
import router from "./routers/rootRouter";

/**
 * Global Components
 */
Vue.use(PortalVue);
Vue.use(VInputmask);
Vue.component("small-caps", require("./components/SmallCaps.vue"));

new Vue({
    el: "#emerge",
    store,
    router,
    render: h => h(Emerge)
});
