<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <CategoryCreateModal
          @addCategory="addCategory"
          ref="CategoryCreateModal"
          v-if="hasPermission('category_create')"
        />
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Categories
          </div>
          <div class="card-body"><CategoryTable /></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CategoryCreateModal from "./ui/CategoryCreateModal";
import CategoryTable from "./ui/CategoryTable";
import { EventBus } from "./../../../../eventbus";
import permission from "./../../../../mixins/permission";

export default {
  name: "CategoryIndex",

  mixins: [permission],

  components: {
    CategoryTable,
    CategoryCreateModal,
  },

  created() {
    this.$store.dispatch("fetchCategories");
    // listened from CategoryEditModal
    EventBus.$on("updateCategory", (payload) => {
      this.$store
        .dispatch("updateCategory", payload)
        .then((res) => {
          toast.$toast.success(res.data.message);
          EventBus.$emit("closeEditCategoryModal"); //emitted to CategoryEditModal
        })
        .catch((err) => {});
    });
  },

  methods: {
    addCategory(payload) {
      this.$store
        .dispatch("createCategory", payload)
        .then((res) => {
          toast.$toast.success(res.data.message);
          this.$refs.CategoryCreateModal.closeModal();
        })
        .catch((err) => {});
    },
  },
};
</script>
