import constants from "./../constants";
import CategoryIndex from "./../components/backend/views/category/CategoryIndex";
import store from "./../store";

export default [
    {
        path: "/backend/categories",
        component: CategoryIndex,
        name: "Category",
        meta: {
            title: "Categories",
            layout: "BackendLayout",
            requiresAuth: true,
            permissions: [
                {
                    role: constants.USER_ROLES.USER,
                    access: () =>
                        store.state.auth.auth_user.permissions.some(
                            permission =>
                                permission.name == "category_management_access"
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
    }
];
