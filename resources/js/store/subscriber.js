import store from "./../store";
import axios from "axios";

store.subscribe(mutation => {
    switch (mutation.type) {
        case "SET_AUTH":
            if (mutation.payload.user.access_token) {
                const bearerToken = mutation.payload.user.access_token;
                axios.defaults.headers.common = {
                    Authorization: `Bearer ${bearerToken}`
                };
            } else {
                axios.defaults.headers.common = {
                    Authorization: ""
                };
            }
            break;
    }
});
