<template>
  <component :is="layout">
    <slot />
  </component>
</template>
<script>
const defaultLayout = "FrontendLayout";
export default {
  name: "AppLayout",
  computed: {
    layout() {
      const layout = this.$route.meta.layout || defaultLayout;
      return () => import(`./${layout}.vue`);
    },
  },
};
</script>
