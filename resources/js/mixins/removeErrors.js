import store from "./../store";

const removeErrors = {
    methods: {
        removeStateErrors() {
            if (store.getters.getErrors) {
                store.dispatch("removeErrors");
            }
        }
    }
};

export default removeErrors;
