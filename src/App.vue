<template>
  <div id="app">
    <LoginPage />
  </div>
</template>

<script>
import LoginPage from "./components/LoginPage.vue";

export default {
  name: "App",
  components: {
    LoginPage,
  },
};
</script>

<style>
/* Optional: Global styles */
body {
  margin: 0;
  font-family: Arial, sans-serif;
}
</style>
