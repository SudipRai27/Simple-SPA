import Login from "./../components/auth/Login";
import Register from "./../components/auth/Register";
import Logout from "./../components/auth/Logout";

export default [
    {
        path: "/login",
        component: Login,
        name: "Login",
        meta: {
            title: "Login",
            guest: true
        }
    },
    {
        path: "/register",
        component: Register,
        name: "Register",
        meta: {
            title: "Register",
            guest: true
        }
    },
    {
        path: "/logout",
        component: Logout,
        name: "Logout",
        meta: {
            requiresAuth: true,
            title: "Logout"
        }
    }
];
