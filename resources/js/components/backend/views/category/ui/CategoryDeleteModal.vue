<template>
  <div>
    <CModal
      title="Delete Category"
      :show.sync="categoryDeleteModal"
      color="danger"
    >
      <div>
        Are you sure you want to delete this category with an ID of
        {{ categoryId }}?
      </div>
      <div slot="footer" class="w-100">
        <CButton
          style="border-radius: 0.2rem; color: white"
          color="danger"
          class="ml-1 mr-1 float-right"
          @click="categoryDeleteModal = false"
          >Close
          <i class="fas fa-trash"></i>
        </CButton>
        <CButton
          style="border-radius: 0.2rem; color: white"
          color="primary"
          class="ml-1 mr-1 float-right"
          @click="deleteCategory()"
          >Delete
          <i class="fas fa-trash"></i>
        </CButton>
      </div>
    </CModal>
  </div>
</template>
<script>
export default {
  name: "CategoryDeleteModal",

  props: {
    categoryId: {
      required: true,
      type: Number,
    },
  },

  data() {
    return {
      categoryDeleteModal: false,
    };
  },

  methods: {
    openModal() {
      this.categoryDeleteModal = true;
    },

    deleteCategory() {
      if (this.getErrors) {
        this.$store.dispatch("removeErrors");
      }
      this.$store
        .dispatch("deleteCategory", this.categoryId)
        .then((res) => {
          this.categoryDeleteModal = false;
          console.log(res);
          toast.$toast.success(res.data.message);
        })
        .catch((err) => {});
    },
  },
};
</script>
