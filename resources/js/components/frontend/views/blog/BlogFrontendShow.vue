<template>
  <div class="container">
    <div class="my-3 p-4 bg-gray-50 rounded cursor-pointer shadow-xl">
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
      <div class="my-2">
        <img
          :src="image.url"
          v-for="image in blog.image_details"
          :key="image.id"
          class="inline-block w-60 mr-4"
        />
      </div>
      <p>{{ blog.description }}</p>
    </div>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  name: "BlogFrontendShow",

  data() {
    return {
      blog: {},
    };
  },

  methods: {
    ...mapActions({
      getSingleBlog: "blog/getSingleBlog",
    }),
  },

  created() {
    this.getSingleBlog(this.$route.params.id)
      .then((res) => {
        this.blog = res.data.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>
