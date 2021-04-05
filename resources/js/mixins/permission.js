import constants from "./../constants";

const permission = {
    methods: {
        hasPermission(permissionName) {
            if (this.$user.get().role === constants.USER_ROLES.ADMIN) {
                return true;
            }
            const permissions = this.$store.state.auth.auth_user.permissions;
            return permissions.some(
                permission => permission.name === permissionName
            );
        }
    }
};

export default permission;
