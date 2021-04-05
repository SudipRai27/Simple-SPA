import constants from "./../constants";
import UserDashboard from "./../components/backend/views/user/UserDashboard";

export default [
    {
        path: "/user/dashboard",
        component: UserDashboard,
        name: "UserDashboard",
        meta: {
            title: "User | Dashboard",
            layout: "BackendLayout",
            requiresAuth: true,
            permissions: [
                {
                    role: constants.USER_ROLES.USER,
                    access: true,
                    redirect: ""
                },
                {
                    role: constants.USER_ROLES.ADMIN,
                    access: false,
                    redirect: "AdminDashboard"
                }
            ]
        }
    }
];
