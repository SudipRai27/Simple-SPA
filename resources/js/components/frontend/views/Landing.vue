<template>
  <div class="py-12 md:py-24 bg-gray-100">
    <div
      class="max-w-screen-xl mx-auto px-6 lg:px-8 xl:px-4 grid md:grid-cols-1 xl:grid-cols-1"
    >
      <div class="order-2 md:order-1 col-span-2 self-center mt-12 md:mt-0">
        <h1
          class="text-gray-800 text-3xl md:text-4xl lg:text-5xl font-bold mb-2 md:mb-4 lg:mb-8"
        >
          The best way to write code all day
        </h1>
        <p class="text-lg xl:text-xl text-gray-600 mb-6 lg:mb-8 xl:mb-10">
          For writers, a random sentence can help them get their creative juices
          flowing. Since the topic.
        </p>
        <div class="flex space-x-4 mb-6">
          <input
            type="text"
            placeholder="enter your email..."
            class="flex-1 py-4 px-4 border border-gray-200 rounded-lg leading-none focus:outline-none"
          />
          <button
            class="focus:outline-none inline-block bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-700 font-semibold rounded-lg py-2 px-5 text-white"
          >
            Get started
          </button>
        </div>
        <p class="text-gray-500 text-sm">
          No credit card required. Cancel anytime.
        </p>
      </div>
    </div>
  </div>
</template>
<script>
import Navbar from "./../partials/Navbar";
import Footer from "./../partials/Footer";

export default {
  name: "Landing",
  components: {
    Navbar,
    Footer,
  },
};
</script>
