import Vue from "vue";
import VueRouter from "vue-router";
import store from "./../store";
import Landing from "./../components/frontend/views/Landing";
import BlogFrontendIndex from "./../components/frontend/views/blog/BlogFrontendIndex";
import AuthRoutes from "./auth";
import UserRoutes from "./user";
import AdminRoutes from "./admin";
import BlogRoutes from "./blog";
import CategoryRoutes from "./category";

Vue.use(VueRouter);
const router = new VueRouter({
    routes: [
        ...AuthRoutes,
        ...UserRoutes,
        ...AdminRoutes,
        ...BlogRoutes,
        ...CategoryRoutes,
        {
            path: "/",
            component: Landing,
            name: "Landing",
            meta: {
                title: "Landing Page",
                layout: "FrontendLayout"
            }
        },
        {
            path: "/blogs",
            component: BlogFrontendIndex,
            name: "Blogs",
            meta: {
                title: "Blogs",
                layout: "FrontendLayout"
            }
        }
    ],
    mode: "history"
});

router.beforeEach((to, from, next) => {
    if (store.getters.getErrors) {
        store.dispatch("removeErrors");
    }
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.isAuthenticated) {
            next({
                path: "/login"
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (!store.getters.isAuthenticated) {
            next();
        } else {
            next({ name: "UserDashboard" });
        }
    } else {
        next();
    }
});

export default router;
