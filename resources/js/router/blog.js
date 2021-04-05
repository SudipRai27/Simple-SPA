import constants from "./../constants";
import BlogIndex from "./../components/backend/views/blog/BlogIndex";
import BlogFrontendShow from "./../components/frontend/views/blog/BlogFrontendShow";
import store from "./../store";

export default [
    {
        path: "/backend/blogs",
        component: BlogIndex,
        name: "Blog",
        meta: {
            title: "Blogs",
            layout: "BackendLayout",
            requiresAuth: true,
            permissions: [
                {
                    role: constants.USER_ROLES.USER,
                    access: () =>
                        store.state.auth.auth_user.permissions.some(
                            permission =>
                                permission.name == "blog_management_access"
                        ),
                    redirect: "UserDashboard"
                },
                {
                    role: constants.USER_ROLES.ADMIN,
                    access: true,
                    redirect: ""
                }
            ]
        }
    },
    {
        path: "/blog/:id",
        component: BlogFrontendShow,
        name: "BlogFrontendShow",
        meta: {
            title: "Blog | Detail",
            layout: "FrontendLayout"
        }
    }
];
