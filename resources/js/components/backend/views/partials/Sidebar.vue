<template>
  <CSidebar
    fixed
    :minimize="sidebarIsMinimized"
    :show="showSideBar"
    @update:show="(value) => $store.commit('set', ['sidebarShow', value])"
  >
    <CSidebarBrand class="d-md-down-none">
      <CIcon
        class="c-sidebar-brand-full"
        name="logo"
        size="custom-size"
        :height="35"
        viewBox="0 0 556 134"
      />
      <CIcon
        class="c-sidebar-brand-minimized"
        name="logo"
        size="custom-size"
        :height="35"
        viewBox="0 0 110 134"
      />
    </CSidebarBrand>
    <ul class="c-sidebar-nav">
      <li class="c-sidebar-nav-item">
        <router-link class="c-sidebar-nav-link" to="/user/dashboard">
          <span class="sidebar-icon"> <CIcon name="cil-speedometer" /> </span>
          Dashboard
        </router-link>
      </li>
      <li
        class="c-sidebar-nav-item"
        v-if="hasPermission('category_management_access')"
      >
        <router-link class="c-sidebar-nav-link" to="/backend/categories">
          <span class="sidebar-icon"><CIcon name="cil-lock-locked" /> </span>
          Category
        </router-link>
      </li>
      <li
        class="c-sidebar-nav-item"
        v-if="hasPermission('blog_management_access')"
      >
        <router-link class="c-sidebar-nav-link" to="/backend/blogs">
          <span class="sidebar-icon"><CIcon name="cil-lock-locked" /> </span>
          Blog
        </router-link>
      </li>
      <li class="c-sidebar-nav-item">
        <router-link class="c-sidebar-nav-link" to="/logout">
          <span class="sidebar-icon"><CIcon name="cil-lock-locked" /> </span>
          Log Out
        </router-link>
      </li>
    </ul>

    <CSidebarMinimizer
      class="d-md-down-none"
      @click.native="
        $store.commit('set', ['sidebarMinimize', !sidebarIsMinimized])
      "
    />
  </CSidebar>
</template>

<script>
import { mapGetters } from "vuex";
import permission from "./../../../../mixins/permission";
export default {
  name: "Sidebar",

  mixins: [permission],

  computed: {
    ...mapGetters(["showSideBar", "sidebarIsMinimized"]),
  },

  data() {
    return {
      icons: {},
    };
  },
};
</script>
<style lang="scss" scoped>
span.sidebar-icon {
  display: inline-block;
  margin: 0 1rem;
}
</style>
