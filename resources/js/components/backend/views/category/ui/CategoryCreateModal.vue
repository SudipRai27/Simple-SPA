<template>
  <div>
    <CButton color="primary" @click="openModal()" class="ml-3 mb-3">
      Add Category
    </CButton>
    <CModal
      title="Add Category"
      :show.sync="categoryCreateModal"
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
          @click="categoryCreateModal = false"
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
import removeErrors from "./../../../../../mixins/removeErrors";
export default {
  name: "CategoryModal",

  components: {
    FormErrorSingle,
  },

  mixins: [removeErrors],

  data() {
    return {
      form: {
        category_title: "",
      },
      categoryCreateModal: false,
    };
  },

  computed: {
    ...mapGetters(["getErrors"]),
  },

  methods: {
    submitForm() {
      this.removeStateErrors();
      this.$emit("addCategory", this.form);
    },

    openModal() {
      this.removeStateErrors();
      this.form.category_title = "";
      this.categoryCreateModal = true;
    },

    closeModal() {
      this.categoryCreateModal = false;
    },
  },
};
</script>
