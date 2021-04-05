<template>
  <div>
    <CModal title="Delete Blog" :show.sync="blogDeleteModal" color="danger">
      <div>
        Are you sure you want to delete this category with an ID of
        {{ blogId }}?
      </div>
      <div slot="footer" class="w-100">
        <CButton
          style="border-radius: 0.2rem; color: white"
          color="danger"
          class="ml-1 mr-1 float-right"
          @click="blogDeleteModal = false"
          >Close
          <i class="fas fa-trash"></i>
        </CButton>
        <CButton
          style="border-radius: 0.2rem; color: white"
          color="primary"
          class="ml-1 mr-1 float-right"
          @click="deleteBlog()"
          >Delete
          <i class="fas fa-trash"></i>
        </CButton>
      </div>
    </CModal>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  name: "BlogDeleteModal",

  props: {
    blogId: {
      required: true,
      type: Number,
    },
  },

  data() {
    return {
      blogDeleteModal: false,
    };
  },

  methods: {
    ...mapActions({
      delete: "blog/deleteBlog",
    }),

    openModal() {
      this.blogDeleteModal = true;
    },

    deleteBlog() {
      this.delete(this.blogId)
        .then((res) => {
          this.blogDeleteModal = false;
          toast.$toast.success(res.data.message);
        })
        .catch((err) => {});
    },
  },
};
</script>
