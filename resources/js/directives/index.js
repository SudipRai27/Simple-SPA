import Vue from "vue";
import constants from "./../constants";

export const can = Vue.directive("can", {
    bind: function(el, binding, vnode) {
        if (Vue.prototype.$user.get().role === constants.USER_ROLES.ADMIN) {
            return;
        }
        const store = vnode.context.$store;
        const permission = store.state.auth.auth_user.permissions;
        if (
            !permission.includes(
                binding.expression.replace(/'/g, "").replace(/"/g, "")
            )
        ) {
            vnode.elm.style.display = "none";
        }
    }
});
