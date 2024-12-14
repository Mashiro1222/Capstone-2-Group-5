<template>
  <div id="app">
    <!-- This is where the routed components will be displayed -->
    <router-view /> 
  </div>
</template>

<script>
import { createRouter, createWebHistory } from "vue-router";
import LoginPage from "./components/LoginPage.vue";
import CreateAccountPage from "./components/CreateAccountPage.vue";
import MainPage from "./components/MainPage.vue";
import MyAccountPage from "./components/MyAccountPage.vue";

const routes = [
  { path: "/", redirect: "/login" }, // Redirect root to Login Page
  { path: "/login", name: "Login", component: LoginPage },
  { path: "/create-account", name: "CreateAccount", component: CreateAccountPage },
  { path: "/main-page", name: "MainPage", component: MainPage },
  { path: "/my-account-page", name: "MyAccountPage", component: MyAccountPage },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default {
  name: "App",
  router, // You need to include the router here
};
</script>

<style>
/* Optional: Global styles */
body {
  margin: 0;
  font-family: Arial, sans-serif;
}
</style>
