<template>
  <p class="text-red-400 text-sm mt-1" v-text="errorMessage()"></p>
</template>
<script>
export default {
  name: "SingleError",
  props: ["field", "errors"],
  methods: {
    errorMessage() {
      if (
        this.errors &&
        this.errors[this.field] &&
        this.errors[this.field].length > 0
      ) {
        return this.errors[this.field][0];
      }
    },
  },
};
</script>
