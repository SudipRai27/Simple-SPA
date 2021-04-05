<template>
  <div>
    <Sidebar />
    <div class="c-wrapper c-fixed-components">
      <Header />
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
              <slot />
            </div>
          </div>
        </main>
        <Footer />
      </div>
    </div>
  </div>
</template>
<script>
import Header from "./../backend/views/partials/Header";
import Footer from "./../backend/views/partials/Footer";
import Sidebar from "./../backend/views/partials/Sidebar";
export default {
  name: "BackendLayout",
  components: {
    Header,
    Footer,
    Sidebar,
  },
};
</script>
<style lang="scss" scoped>
@import "./../../../sass/coreui";
</style>
