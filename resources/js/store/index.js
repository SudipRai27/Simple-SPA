import Vue from "vue";
import Vuex from "vuex";
import sidebar from "./modules/sidebar";
import auth from "./modules/auth";
import errors from "./modules/errors";
import category from "./modules/category";
import blog from "./modules/blog";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        sidebar,
        auth,
        errors,
        category,
        blog
    }
});
