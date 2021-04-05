<template>
  <div class="container">
    <div class="text-center italic">
      <h3>Blogs</h3>
    </div>
    <div class="shadow flex">
      <input
        class="w-full rounded p-2"
        type="text"
        placeholder="Search..."
        v-model="search"
      />
      <button
        class="bg-white w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400"
      >
        <i class="material-icons">search</i>
      </button>
    </div>
    <div class="">
      <template v-for="blog in filteredList">
        <div
          :key="blog.id"
          class="my-3 p-4 bg-gray-50 rounded cursor-pointer shadow-xl"
          @click="showBlog(blog.id)"
        >
          <div class="flex place-items-center justify-between">
            <h4>{{ blog.title }}</h4>
            <span>{{ blog.created_at }}</span>
          </div>
          <span v-for="category in blog.category" :key="category.id">
            <span class="bg-green-300 inline-block p-1 m-0.5">{{
              category.category_title
            }}</span
            >&nbsp;
          </span>
          <p>{{ blog.description }}</p>
        </div>
      </template>
    </div>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  name: "BlogFrontendIndex",

  data() {
    return {
      blogs: [],
      search: "",
    };
  },

  async created() {
    try {
      const res = await axios.get("/api/blogs");
      this.blogs = res.data.data;
    } catch (ex) {
      console.log(ex);
    }
  },

  computed: {
    filteredList() {
      return this.blogs.filter((blog) => {
        return blog.title.toLowerCase().includes(this.search.toLowerCase());
      });
    },
  },

  methods: {
    ...mapActions({
      fetchBlogs: "blog/fetchBlogs",
    }),

    showBlog(blogId) {
      this.$router.push({
        name: "BlogFrontendShow",
        params: {
          id: blogId,
        },
      });
    },
  },
};
</script>

