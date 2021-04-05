<template>
  <div></div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "Logout",

  computed: {
    ...mapGetters(["isAuthenticated"]),
  },

  mounted() {
    if (this.isAuthenticated) {
      this.$store
        .dispatch("logout")
        .then((res) => {
          this.$user.set({ role: "guest" });
          this.$router.push({ name: "Login" });
        })
        .catch((err) => {
          this.$router.push({ name: "Login" });
          this.$user.set({ role: "guest" });
        });
    }
  },
};
</script>
