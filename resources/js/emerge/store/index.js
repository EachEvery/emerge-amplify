import Vue from "vue";
import Vuex, { Store } from "vuex";
import VuexPersistence from "vuex-persist";
import modules from "./modules/_modules.js";

const vuexLocal = new VuexPersistence({
    storage: window.localStorage,
    modules: ["builder"]
});

Vue.use(Vuex);

export default new Store({
    modules,
    plugins: [vuexLocal.plugin]
});
