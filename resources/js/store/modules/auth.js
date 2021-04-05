import axios from "axios";
import storage from "./../../utils/storage";
import constants from "../../constants";

const auth = {
    state: () => ({
        access_token: null,
        auth_user: null
    }),
    mutations: {
        SET_AUTH(state, payload) {
            state.auth_user = payload.user.auth_user;
            state.access_token = payload.user.access_token;
        },
        UNSET_AUTH(state) {
            state.auth_user = null;
            state.access_token = null;
        }
    },
    actions: {
        register({}, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/register", payload)
                    .then(res => {
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        login(context, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/login", payload)
                    .then(res => {
                        context.commit("SET_AUTH", res.data);
                        storage.setItem(
                            constants.AUTH_USER,
                            JSON.stringify(res.data.user.auth_user)
                        );
                        storage.setItem(
                            constants.ACCESS_TOKEN,
                            res.data.user.access_token
                        );
                        resolve(res.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .post("api/logout")
                    .then(res => {
                        commit("UNSET_AUTH");
                        storage.destroyItem(constants.AUTH_USER);
                        storage.destroyItem(constants.ACCESS_TOKEN);
                        resolve(res);
                    })
                    .catch(err => {
                        commit("UNSET_AUTH");
                        storage.destroyItem(constants.AUTH_USER);
                        storage.destroyItem(constants.ACCESS_TOKEN);
                        reject(err);
                    });
            });
        }
    },
    getters: {
        isAuthenticated(state) {
            if (state.access_token && state.auth_user != null) {
                return true;
            }
            return false;
        },
        getAuthUser(state) {
            return state.auth_user;
        },
        getAccessToken(state) {
            return state.access_token;
        }
    }
};

export default auth;
