<template>
  <div>
    <CModal
      title="Edit Blog"
      :show.sync="blogEditModal"
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
            track-by="category_title"
            :options="getAllCategories"
            :custom-label="customLabel"
            :multiple="true"
            :close-on-select="false"
            :searchable="true"
            :preselect-first="true"
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
            :data-upload-id="`blog-edit-images${blogId}`"
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
                name="test-edit-images[]"
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
            field="images.1"
          />
        </div>
      </form>
      <div slot="footer" class="w-100">
        <CButton
          style="border-radius: 0.2rem; color: white"
          color="danger"
          class="ml-1 mr-1 float-right"
          @click="blogEditModal = false"
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
  name: "BlogEditModal",

  props: {
    blogId: {
      required: true,
      type: Number,
    },
  },

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
        category_id: [],
      },
      blogEditModal: false,
      editUploadContainer: "",
    };
  },

  mounted() {
    this.editUploadContainer = new FileUploadWithPreview(
      `blog-edit-images${this.blogId}`
    );
  },

  computed: {
    ...mapGetters(["getErrors", "getAllCategories"]),
  },

  methods: {
    ...mapActions({
      getBlog: "blog/getSingleBlog",
      updateBlog: "blog/updateBlog",
    }),

    customLabel(option) {
      return `${option.category_title}`;
    },

    openModal() {
      this.removeStateErrors();
      this.editUploadContainer.clearPreviewPanel();
      this.getBlog(this.blogId)
        .then((res) => {
          this.form.title = res.data.data.title;
          this.form.description = res.data.data.description;
          this.form.category_id = res.data.data.category;
          this.blogEditModal = true;
        })
        .catch((err) => {});
    },

    submitForm() {
      this.removeStateErrors();
      const categoryIds = [];
      this.form.category_id.forEach((category) => {
        if (category.id && category.id != "undefined") {
          categoryIds.push(category.id);
        }
      });
      if (this.errors) {
        this.$store.dispatch("removeErrors");
      }
      let formData = new FormData();
      formData.append("title", this.form.title);
      formData.append("description", this.form.description);
      if (categoryIds.length > 0) {
        categoryIds.forEach((categoryId) =>
          formData.append("category_id[]", categoryId)
        );
      } else {
        formData.append("category_id", "");
      }
      if (this.editUploadContainer.cachedFileArray.length > 0) {
        this.editUploadContainer.cachedFileArray.forEach((file) =>
          formData.append("images[]", file)
        );
      }
      formData.append("blogId", this.blogId);
      formData.append("_method", "PUT");
      this.updateBlog(formData)
        .then((res) => {
          toast.$toast.success(res.data.message);
          this.closeModal();
        })
        .catch((err) => {});
    },

    closeModal() {
      this.blogEditModal = false;
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css" scoped></style>
<style scoped>
@import "file-upload-with-preview/dist/file-upload-with-preview.min.css";
</style>
