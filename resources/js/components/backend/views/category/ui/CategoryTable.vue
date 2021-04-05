<template>
  <div>
    <template v-if="categories.length">
      <table class="table table-responsive-sm">
        <thead>
          <tr>
            <th>Id</th>
            <th>Category Title</th>
            <th>Created at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody v-if="categories.length > 0">
          <tr v-for="category in categories" :key="category.id">
            <td>{{ category.id }}</td>
            <td>{{ category.category_title }}</td>
            <td>
              <span class="badge badge-success">{{ category.created_at }}</span>
            </td>
            <td>
              <div class="row">
                <div class="col-4">
                  <button
                    class="btn btn-block btn-success btn-sm"
                    type="button"
                    @click="openCategoryEditModal(category.id)"
                    v-if="hasPermission('category_edit')"
                  >
                    Edit
                  </button>
                  <CategoryEditModal
                    :categoryId="category.id"
                    :ref="'CategoryEditModal' + category.id"
                  />
                </div>
                <div class="col-4">
                  <button
                    class="btn btn-block btn-danger btn-sm"
                    type="button"
                    @click="
                      openCategoryDeleteModal(
                        'CategoryDeleteModal' + category.id
                      )
                    "
                    v-if="hasPermission('category_delete')"
                  >
                    Delete
                  </button>
                  <CategoryDeleteModal
                    :ref="'CategoryDeleteModal' + category.id"
                    :categoryId="category.id"
                  />
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </template>
    <template v-else>
      <CAlert show color="info">Categories Not Found</CAlert>
    </template>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import CategoryDeleteModal from "./CategoryDeleteModal";
import CategoryEditModal from "./CategoryEditModal";
import permission from "./../../../../../mixins/permission";

export default {
  name: "CategoryTable",

  mixins: [permission],

  components: {
    CategoryDeleteModal,
    CategoryEditModal,
  },

  computed: {
    ...mapGetters({ categories: "getAllCategories" }),
  },

  methods: {
    openCategoryDeleteModal(ref) {
      this.$refs[ref][0].openModal();
    },
    openCategoryEditModal(categoryId) {
      let refName = `CategoryEditModal${categoryId}`;
      this.$refs[refName][0].getCategory(categoryId);
    },
  },
};
</script>
