<template>
  <div
    class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full space-y-8">
      <div>
        <img
          class="mx-auto h-12 w-auto"
          src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
          alt="Workflow"
        />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Sign up
        </h2>
      </div>

      <!-- <FormErrorList :errors="errors" v-if="errors" /> -->
      <form class="mt-8 space-y-6" @submit.prevent="submitForm()">
        <input type="hidden" name="remember" value="true" />
        <div class="my-4">
          <label for="name" class="sr-only">Name</label>
          <input
            id="name"
            name="name"
            type="text"
            autocomplete="name"
            required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Full Name"
            v-model="form.name"
            @input="updateErrorField('name')"
          />
          <FormErrorSingle v-if="getErrors" :errors="getErrors" field="name" />
        </div>
        <div class="my-4">
          <label for="email-address" class="sr-only">Email address</label>
          <input
            id="email-address"
            name="email"
            type="email"
            autocomplete="email"
            required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Email address"
            v-model="form.email"
            @input="updateErrorField('email')"
          />
          <FormErrorSingle v-if="getErrors" :errors="getErrors" field="email" />
        </div>
        <div class="my-4">
          <label for="password" class="sr-only">Password</label>
          <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Password"
            v-model="form.password"
            @input="updateErrorField('password')"
          />
          <FormErrorSingle
            v-if="getErrors"
            :errors="getErrors"
            field="password"
          />
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember_me"
              name="remember_me"
              type="checkbox"
              class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
            />
            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
              Remember me
            </label>
          </div>
        </div>
        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <!-- Heroicon name: solid/lock-closed -->
              <svg
                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
              >
                <path
                  fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </span>
            Sign up
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import FormErrorList from "./../utilities/form-errors/FormErrorList";
import FormErrorSingle from "./../utilities/form-errors/FormErrorSingle";

export default {
  name: "Register",

  components: {
    FormErrorList,
    FormErrorSingle,
  },

  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
      },
    };
  },

  computed: {
    ...mapGetters(["getErrors"]),
  },

  methods: {
    submitForm() {
      if (this.getErrors) {
        this.$store.dispatch("removeErrors");
      }
      this.$store
        .dispatch("register", this.form)
        .then((res) => {
          toast.$toast.success(res.data.message);
          this.form = {
            name: "",
            email: "",
            password: "",
          };
        })
        .catch((err) => {});
    },

    updateErrorField(field) {
      this.$store.dispatch("removeSingleError", field);
    },
  },
};
</script>
