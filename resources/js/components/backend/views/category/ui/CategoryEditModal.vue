<template>
  <div>
    <CModal
      title="Edit Category"
      :show.sync="categoryEditModal"
      color="primary"
    >
      <form @submit.prevent="submitForm()">
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            name="name"
            class="form-control"
            placeholder="Category Name"
            v-model="form.category_title"
            @input="$store.dispatch('removeSingleError', 'category_title')"
            required
          />
          <FormErrorSingle
            v-if="getErrors"
            :errors="getErrors"
            field="category_title"
          />
        </div>
      </form>
      <div slot="footer" class="w-100">
        <CButton
          style="border-radius: 0.2rem; color: white"
          color="danger"
          class="ml-1 mr-1 float-right"
          @click="categoryEditModal = false"
          >Close
          <i class="fas fa-trash"></i>
        </CButton>
        <CButton
          style="border-radius: 0.2rem; color: white"
          color="primary"
          class="ml-1 mr-1 float-right"
          @click="submitForm()"
          >Save
          <i class="fas fa-trash"></i>
        </CButton>
      </div>
    </CModal>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import FormErrorSingle from "./../../../../utilities/form-errors/FormErrorSingle";
import { EventBus } from "./../../../../../eventbus";
import removeErrors from "./../../../../../mixins/removeErrors";
export default {
  name: "CategoryEditModal",

  components: {
    FormErrorSingle,
  },

  mixins: [removeErrors],

  props: {
    categoryId: {
      required: true,
      type: Number,
    },
  },

  data() {
    return {
      form: {
        category_title: "",
      },
      categoryEditModal: false,
    };
  },

  created() {
    EventBus.$on("closeEditCategoryModal", () => {
      //listened from CategoryIndex
      this.categoryEditModal = false;
    });
  },

  computed: {
    ...mapGetters(["getErrors"]),
  },

  methods: {
    getCategory(categoryId) {
      this.$store
        .dispatch("getCategory", categoryId)
        .then((res) => {
          this.form.category_title = res.data.data.category_title;
          this.openModal();
        })
        .catch((err) => {});
    },

    openModal() {
      this.category_title = "";
      this.removeStateErrors();
      this.categoryEditModal = true;
    },

    submitForm() {
      this.removeStateErrors();
      this.form.categoryId = this.categoryId;
      EventBus.$emit("updateCategory", this.form); ///emitted to category index
    },
  },
};
</script>
