const errors = {
    state: () => ({
        errors: null
    }),
    mutations: {
        SET_ERRORS(state, payload) {
            state.errors = payload;
        },

        REMOVE_ERRORS(state) {
            state.errors = null;
        },

        REMOVE_SINGLE_ERROR(state, payload) {
            state.errors[payload] = null;
        }
    },
    actions: {
        removeErrors({ commit }) {
            commit("REMOVE_ERRORS");
        },

        removeSingleError({ getters, commit }, payload) {
            if (
                getters.getErrors &&
                getters.getErrors[payload] &&
                getters.getErrors[payload].length > 0
            ) {
                commit("REMOVE_SINGLE_ERROR", payload);
            }
        }
    },
    getters: {
        getErrors(state) {
            return state.errors;
        }
    }
};

export default errors;
