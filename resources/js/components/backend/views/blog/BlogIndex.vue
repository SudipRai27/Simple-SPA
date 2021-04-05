<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <BlogCreateModal v-can="'blog_create'" />
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ componentTitle }}
          </div>
          <div class="card-body"><BlogTable /></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions } from "vuex";
import BlogCreateModal from "./ui/BlogCreateModal";
import BlogTable from "./ui/BlogTable";

export default {
  name: "BlogIndex",

  components: {
    BlogCreateModal,
    BlogTable,
  },

  created() {},

  data() {
    return {
      componentTitle: "Blogs",
    };
  },

  created() {
    this.getBlogs();
  },

  methods: {
    ...mapActions({
      getBlogs: "blog/fetchBlogs",
    }),
  },
};
</script>
