import { createRouter, createWebHistory } from vue-router;
import LoginPage from src/components/LoginPage.vue; // Path to your Login Page
import CreateAccountPage from src/components/CreateAccountPage.vue; // Path to your Create Account Page

const routes = [
  {
    path: "/",
    name: "Login",
    component: LoginPage, // Login Page as the default route
  },
  {
    path: "/create-account",
    name: "CreateAccount",
    component: CreateAccountPage, // Create Account Page route
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
