<template>
  <div>
    <template v-if="blogs.length">
      <table class="table table-responsive-sm">
        <thead>
          <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Category</th>
            <th>Created at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="blog in blogs" :key="blog.id">
            <td>{{ blog.id }}</td>
            <td>{{ blog.title }}</td>
            <td>
              <span v-for="(category, index) in blog.category" :key="index">
                <span class="badge badge-info">{{
                  category.category_title
                }}</span>
              </span>
            </td>
            <td>
              <span class="badge badge-success">{{ blog.created_at }}</span>
            </td>
            <td>
              <div class="row">
                <div class="col-4">
                  <button
                    class="btn btn-block btn-info btn-sm"
                    type="button"
                    v-can="'blog_view'"
                    @click="openModal('BlogViewModal' + blog.id)"
                  >
                    View
                  </button>
                  <BlogViewModal
                    :ref="'BlogViewModal' + blog.id"
                    :blogId="blog.id"
                  />
                </div>
                <div class="col-4">
                  <button
                    class="btn btn-block btn-success btn-sm"
                    type="button"
                    v-can="'blog_edit'"
                    @click="openModal('BlogEditModal' + blog.id)"
                  >
                    Edit
                  </button>
                  <BlogEditModal
                    :ref="'BlogEditModal' + blog.id"
                    :blogId="blog.id"
                  />
                </div>
                <div class="col-4">
                  <button
                    class="btn btn-block btn-danger btn-sm"
                    type="button"
                    @click="openModal('BlogDeleteModal' + blog.id)"
                    v-can="'blog_delete'"
                  >
                    Delete
                  </button>
                  <BlogDeleteModal
                    :ref="'BlogDeleteModal' + blog.id"
                    :blogId="blog.id"
                  />
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </template>
    <template v-else>
      <CAlert show color="info">Blogs Not Found</CAlert>
    </template>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import BlogDeleteModal from "./BlogDeleteModal";
import BlogEditModal from "./BlogEditModal";
import BlogViewModal from "./BlogViewModal";

export default {
  name: "BlogTable",

  components: {
    BlogDeleteModal,
    BlogEditModal,
    BlogViewModal,
  },

  data() {
    return {
      blogViewModal: false,
    };
  },

  created() {
    this.$store.dispatch("fetchCategories");
  },

  computed: {
    ...mapGetters({ blogs: "blog/getAllBlogs" }),
  },

  methods: {
    openModal(ref) {
      this.$refs[ref][0].openModal();
    },
  },
};
</script>
<style scoped>
.badge-info {
  display: inline-block;
  margin: 0 5px;
}
</style>
