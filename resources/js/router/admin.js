import constants from "./../constants";
import AdminDashboard from "./../components/backend/views/admin/AdminDashboard";

export default [
    {
        path: "/admin/dashboard",
        component: AdminDashboard,
        name: "AdminDashboard",
        meta: {
            title: "Admin | Dashboard",
            layout: "BackendLayout",
            requiresAuth: true,
            permissions: [
                {
                    role: constants.USER_ROLES.USER,
                    access: false,
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
