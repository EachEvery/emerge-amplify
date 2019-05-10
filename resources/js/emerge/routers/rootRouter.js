import Vue from "vue";
import VueRouter from "vue-router";
import ChooseText from "../pages/ChooseText.vue";
import ChooseSection from "../pages/ChooseSection.vue";
import BuildPoem from "../pages/BuildPoem.vue";
import TextRoot from "../pages/TextRoot.vue";
import Community from "../pages/Community.vue";
import BuilderHelp from "../pages/BuilderHelp.vue";
import PoemList from "../pages/PoemList.vue";
import PoemDetail from "../pages/PoemDetail.vue";
import PageNotFound from "../pages/404.vue";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: "/404", component: PageNotFound },
        { path: "/", component: ChooseText },
        {
            path: "/poems",
            component: Community,
            name: "community",
            children: [
                {
                    path: "",
                    component: PoemList,
                    props: route => ({
                        query: route.query,
                        fadeIn: route.query.fadeIn
                    }),
                    name: "poemList"
                },
                {
                    path: ":poemId",
                    component: PoemDetail,
                    name: "poemRoot",
                    children: [
                        { path: "about", component: PoemDetail, name: "about" },
                        { path: "share", component: PoemDetail, name: "share" }
                    ]
                }
            ]
        },
        {
            path: "/:textId",
            component: TextRoot,
            children: [
                { path: "", redirect: "/" },
                {
                    path: "choose-section",
                    component: ChooseSection,
                    name: "chooseSection"
                },
                {
                    path: "create",
                    component: BuildPoem,
                    name: "create",
                    children: [
                        {
                            path: "save",
                            component: BuildPoem,
                            name: "savePoem"
                        }
                    ]
                }
            ]
        }
    ]
});
