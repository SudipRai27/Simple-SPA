<template>
  <div>
    <main class="bg-white text-gray-700 font-medium">
      <Navbar />
      <slot />
      <Footer />
    </main>
  </div>
</template>
<script>
import Navbar from "./../frontend/partials/Navbar";
import Footer from "./../frontend/partials/Footer";
export default {
  name: "FrontendLayout",
  components: {
    Navbar,
    Footer,
  },
};
</script>
<style lang="scss" scoped>
@import "./../../../sass/tailwind";
</style>
