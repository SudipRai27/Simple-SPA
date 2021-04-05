<template>
  <!-- header block -->
  <header
    class="max-w-screen-xl mx-auto px-6 lg:px-8 xl:px-4 py-4 lg:py-6 flex justify-between"
  >
    <router-link to="/">
      <span class="sr-only">SaaS landing page</span>
      <h3>Blogger</h3>
    </router-link>
    <nav class="flex items-center space-x-4">
      <router-link
        to="/blogs"
        class="flex space-x-1 items-center hover:text-gray-500"
      >
        Blogs
      </router-link>
      <template v-if="!isAuthenticated">
        <router-link
          to="/login"
          class="flex space-x-1 items-center hover:text-gray-500"
        >
          <svg
            class="hidden sm:inline w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
            ></path>
          </svg>
          <span>Sign in</span>
        </router-link>
        <router-link
          to="/register"
          class="inline-block bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-700 font-semibold rounded-lg py-2 px-5 text-white"
          >Register</router-link
        >
      </template>
      <template v-else>
        <router-link
          to="/user/dashboard"
          class="flex space-x-1 items-center hover:text-gray-500"
          >Dashboard</router-link
        >
      </template>
    </nav>
  </header>
  <!--/ header block -->
</template>
<script>
import { mapGetters } from "vuex";

export default {
  name: "Navbar",
  computed: {
    ...mapGetters(["isAuthenticated"]),
  },
};
</script>
