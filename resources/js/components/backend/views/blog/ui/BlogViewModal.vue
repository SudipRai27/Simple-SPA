<template>
  <div>
    <CModal
      title="View Blog"
      :show.sync="blogViewModal"
      color="primary"
      size="xl"
    >
      <div class="row">
        <div class="col-sm-12 col-md-7 blog">
          <div class="header">
            <h4>
              {{ blog.title }}
            </h4>
            <span class="badge badge-success date">
              {{ blog.created_at }}
            </span>
          </div>
          <div class="categories">
            <span v-for="category in blog.categories" :key="category.id">
              <span class="badge badge-info">{{ category.category_title }}</span
              >&nbsp;
            </span>
          </div>
          <div class="details">
            <p class="description">
              {{ blog.description }}
            </p>
          </div>
        </div>
        <div class="col-sm-12 col-lg-5">
          <h4>Images</h4>
          <div class="image-container">
            <div
              v-for="image in blog.images"
              :key="image.id"
              class="image-wrapper"
            >
              <img :src="image.url" alt="" class="blog-image" />
            </div>
          </div>
        </div>
      </div>
      <div slot="footer" class="w-100"></div>
    </CModal>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  name: "CategoryModal",

  props: {
    blogId: {
      required: true,
      type: Number,
    },
  },

  data() {
    return {
      blog: {
        title: "",
        description: "",
        created_at: "",
        categories: [],
        images: [],
      },
      blogViewModal: false,
    };
  },

  methods: {
    ...mapActions({
      getBlog: "blog/getSingleBlog",
    }),
    openModal() {
      this.getBlog(this.blogId)
        .then((res) => {
          this.blog.title = res.data.data.title;
          this.blog.description = res.data.data.description;
          this.blog.categories = res.data.data.category;
          this.blog.images = res.data.data.image_details;
          this.blog.created_at = res.data.data.created_at;
          this.blogViewModal = true;
        })
        .catch((err) => {});
    },
  },
};
</script>
<style lang="scss" scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;

  .date {
    font-style: italic;
  }
}

.categories {
  margin-bottom: 10px;
}

.description {
  padding: 1rem;
  font-size: 14px;
  background: aliceblue;
}

.image-container {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;

  .image-wrapper {
    width: 200px;
  }

  .blog-image {
    width: 100%;
  }
}
</style>
