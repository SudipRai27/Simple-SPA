<template>
  <div>
    <CButton color="info" @click="openModal()" class="ml-3 mb-3">
      Add Blog
    </CButton>
    <CModal
      title="Add Blog"
      :show.sync="blogCreateModal"
      color="primary"
      size="xl"
    >
      <form @submit.prevent="submitForm()" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Title</label>
          <input
            type="text"
            name="title"
            class="form-control"
            placeholder="Blog title"
            v-model="form.title"
            @input="$store.dispatch('removeSingleError', 'title')"
            required
          />
          <FormErrorSingle v-if="getErrors" :errors="getErrors" field="title" />
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea
            type="text"
            name="description"
            class="form-control"
            placeholder="Blog description"
            v-model="form.description"
            @input="$store.dispatch('removeSingleError', 'description')"
            required
            rows="10"
          />
          <FormErrorSingle
            v-if="getErrors"
            :errors="getErrors"
            field="description"
          />
        </div>
        <div class="form-group">
          <label for="category_id">Category</label>
          <multiselect
            v-model="form.category_id"
            :options="getAllCategories.map((category) => category.id)"
            :custom-label="
              (opt) =>
                getAllCategories.find((category) => category.id == opt)
                  .category_title
            "
            :multiple="true"
            :close-on-select="false"
            :searchable="true"
          >
          </multiselect>
          <FormErrorSingle
            v-if="getErrors"
            :errors="getErrors"
            field="category_id"
          />
        </div>
        <div class="form-group">
          <div
            class="custom-file-container"
            data-upload-id="blog-create-images"
          >
            <label
              >Upload Image
              <a
                href="javascript:void(0)"
                class="custom-file-container__image-clear"
                title="Clear Image"
                >&times;</a
              ></label
            >
            <label class="custom-file-container__custom-file">
              <input
                type="file"
                class="custom-file-container__custom-file__custom-file-input"
                accept="image/*"
                multiple
                aria-label="Choose File"
                name="test-images[]"
              />
              <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
              <span
                class="custom-file-container__custom-file__custom-file-control"
              ></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
          </div>
          <FormErrorSingle
            v-if="getErrors"
            :errors="getErrors"
            field="images"
          />
        </div>
      </form>
      <div slot="footer" class="w-100">
        <CButton
          style="border-radius: 0.2rem; color: white"
          color="danger"
          class="ml-1 mr-1 float-right"
          @click="closeModal()"
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
import { mapGetters, mapActions } from "vuex";
import FormErrorSingle from "./../../../../utilities/form-errors/FormErrorSingle";
import Multiselect from "vue-multiselect";
import FileUploadWithPreview from "file-upload-with-preview";
import removeErrors from "./../../../../../mixins/removeErrors";

export default {
  name: "BlogCreate",

  components: {
    FormErrorSingle,
    Multiselect,
  },

  mixins: [removeErrors],

  data() {
    return {
      form: {
        title: "",
        description: "",
        category_id: "",
      },
      blogCreateModal: false,
      uploadContainer: "",
    };
  },

  mounted() {
    this.uploadContainer = new FileUploadWithPreview("blog-create-images");
  },

  computed: {
    ...mapGetters(["getErrors", "getAllCategories"]),
  },

  methods: {
    ...mapActions({
      create: "blog/createBlog",
    }),

    submitForm() {
      this.removeStateErrors();
      const formData = new FormData();
      formData.append("title", this.form.title);
      formData.append("description", this.form.description);
      if (this.form.category_id.length > 0) {
        this.form.category_id.forEach((categoryId) =>
          formData.append("category_id[]", categoryId)
        );
      } else {
        formData.append("category_id", this.form.category_id);
      }
      if (this.uploadContainer.cachedFileArray.length > 0) {
        this.uploadContainer.cachedFileArray.forEach((file) =>
          formData.append("images[]", file)
        );
      }
      this.create(formData)
        .then((res) => {
          toast.$toast.success(res.data.message);
          this.closeModal();
        })
        .catch((err) => {});
    },

    openModal() {
      this.removeStateErrors();
      this.form.title = "";
      this.form.description = "";
      this.form.category_id = "";
      this.uploadContainer.clearPreviewPanel();
      this.blogCreateModal = true;
    },

    closeModal() {
      this.blogCreateModal = false;
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
@import "file-upload-with-preview/dist/file-upload-with-preview.min.css";
</style>
