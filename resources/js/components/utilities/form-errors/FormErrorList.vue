<template>
  <div
    class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg"
  >
    <div v-for="(v, k) in errors" :key="k">
      <p v-for="error in v" :key="error" class="text-sm">
        {{ error }}
      </p>
    </div>
  </div>
</template>
<script>
export default {
  name: "FormError",
  props: ["errors"],
};
</script>
