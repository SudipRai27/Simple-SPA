import Vue from "vue";
import VueToast from "vue-toast-notification";
import router from "./router";
import App from "./components/App";
import "vue-toast-notification/dist/theme-sugar.css";
import VueRouterUserRoles from "vue-router-user-roles";
import constants from "./constants";
import store from "./store";
import storage from "./utils/storage";
import axios from "axios";
import { can } from "./directives";

// Core UI only

import "core-js/stable";
import CoreuiVue from "@coreui/vue";
import { iconsSet as icons } from "./coreuiicons";

Vue.use(CoreuiVue);
Vue.prototype.$log = console.log.bind(console);
Vue.config.performance = true;

// Core UI only

// Datatable
require("bootstrap-vue-datatable");
// Datatable

require("./bootstrap");
require("./store/subscriber");

window.toast = Vue.use(VueToast, {
    position: "top-right"
});

Vue.use(VueRouterUserRoles, { router });

axios.interceptors.response.use(
    function(response) {
        return response;
    },
    function(error) {
        switch (error.response.status) {
            case 401:
                store.commit("UNSET_AUTH");
                storage.destroyItem(constants.ACCESS_TOKEN);
                storage.destroyItem(constants.AUTH_USER);
                toast.$toast.info("Session Expired");
                router.push({ name: "Login" });
                return Promise.reject(error);

            case 422:
                store.commit("SET_ERRORS", error.response.data.errors);
                return Promise.reject(error);

            case 403:
                toast.$toast.error("Forbidden to view this page");
                return Promise.reject(error);

            case 404:
                if (error.response.data.message) {
                    toast.$toast.error(error.response.data.message);
                } else {
                    toast.$toast.error("Resource not found");
                }
                return Promise.reject(error);

            case 400:
                toast.$toast.error("Bad request");
                break;

            case 500:
                toast.$toast.error("Oops!! some error occured in the server");
                break;

            case 419:
                store.commit("UNSET_AUTH");
                storage.destroyItem(constants.ACCESS_TOKEN);
                storage.destroyItem(constants.AUTH_USER);
                toast.$toast.info("Unauthorized. Please login");
                router.push({ name: "Login" });
                return Promise.reject(error);
            default:
                return Promise.reject(error);
        }
    }
);

let payload = {
    user: {
        access_token: storage.retrieveItem(constants.ACCESS_TOKEN),
        auth_user: storage.retrieveItem(constants.AUTH_USER)
    }
};

if (payload.user.access_token && payload.user.auth_user != null) {
    payload.user.auth_user = JSON.parse(
        storage.retrieveItem(constants.AUTH_USER)
    );
    store.commit("SET_AUTH", payload);
}

let user;
if (store.getters.isAuthenticated) {
    user = {
        role: store.state.auth.auth_user.role_name
    };
} else {
    user = {
        role: constants.USER_ROLES.GUEST
    };
}

Vue.prototype.$user.set(user);
Vue.directive("can", can);

const app = new Vue({
    el: "#app",
    components: {
        App
    },
    icons, // Core UI Icons
    router,
    store
});
