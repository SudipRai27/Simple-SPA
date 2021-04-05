const categories = {
    state: () => ({
        categories: []
    }),
    mutations: {
        SET_CATEGORIES(state, payload) {
            state.categories = payload;
        },
        ADD_CATEGORY(state, payload) {
            state.categories.unshift(payload);
        },
        UPDATE_CATEGORY(state, payload) {
            state.categories = state.categories.map(category =>
                category.id === payload.id ? payload : category
            );
        },
        REMOVE_CATEGORY(state, payload) {
            // payload is the category id
            state.categories = state.categories.filter(
                category => category.id != payload
            );
        }
    },
    actions: {
        fetchCategories({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/category")
                    .then(res => {
                        commit("SET_CATEGORIES", res.data.data);
                        resolve();
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        createCategory({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/category/add", payload)
                    .then(res => {
                        commit("ADD_CATEGORY", res.data.data);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        getCategory({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`/api/category/${payload}`)
                    .then(res => {
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        updateCategory({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .put(`/api/category/update/${payload.categoryId}`, {
                        category_title: payload.category_title
                    })
                    .then(res => {
                        commit("UPDATE_CATEGORY", res.data.data);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        deleteCategory({ commit }, payload) {
            // payload is the category id
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/category/delete/${payload}`)
                    .then(res => {
                        commit("REMOVE_CATEGORY", payload);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        }
    },
    getters: {
        getAllCategories(state) {
            return state.categories;
        }
    }
};

export default categories;
