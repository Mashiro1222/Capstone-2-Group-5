<template>
  <div class="container">
    <!-- Left Section -->
    <div class="left">
    </div>

    <!-- Right Section -->
    <div class="right">
      <div class="login-box">
        <h1>Welcome To AllerCheck!</h1>
        <div class="input-group">
          <img src="@/assets/user-icon.png" alt="User Icon" />
          <input type="text" v-model="username" placeholder="Username" />
        </div>
        <div class="input-group">
          <img src="@/assets/password-icon.png" alt="Password Icon" />
          <input
            type="password"
            v-model="password"
            placeholder="Password"
            @keyup.enter="handleLogin"
          />
        </div>
        <button @click="handleLogin">LOGIN</button>
        <a href="#" @click.prevent="forgotPassword">Forgot Password?</a>
        <a href="/create-account" class="create-account">Create Account</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginPage",
  data() {
    return {
      username: "",
      password: "",
    };
  },
  methods: {
    handleLogin() {
      // Placeholder login function
      console.log("Logging in with", this.username, this.password);
      if (this.username && this.password) {
        alert(`Welcome, ${this.username}!`);
      } else {
        alert("Please enter both username and password.");
      }
    },
    forgotPassword() {
      // Placeholder forgot password function
      alert("Forgot password? We'll handle this later.");
    },
  },
};
</script>

<style scoped>
/* General Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}
body {
  background: url("@/assets/nature-background.jpg") no-repeat center center/cover;
  height: 100vh;
  display: flex;
}

/* Container Layout */
.container {
  display: flex;
  width: 100%;
  height: 100vh;
  backdrop-filter: blur(5px); /* Subtle blur effect */
  background: url("@/assets/nature-background.jpg") no-repeat center center/cover;
}

/* Left Section */
.left {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.left img {
  width: 120px;
  opacity: 0.9;
}

/* Right Section */
.right {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(255, 255, 255, 0.9);
  box-shadow: -5px 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 20px 0 0 20px;
}

/* Login Box */
.login-box {
  width: 350px;
  text-align: center;
}
.login-box h1 {
  margin-bottom: 20px;
  font-size: 2rem;
  color: #333;
  font-weight: bold;
}
.input-group {
  position: relative;
  margin: 15px 0;
}
.input-group input {
  width: 100%;
  padding: 12px 12px 12px 40px;
  border: none;
  border-radius: 25px;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
  font-size: 1rem;
  outline: none;
}
.input-group img {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  width: 20px;
  opacity: 0.5;
}
button {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 25px;
  background-color: #6c9f3b;
  color: white;
  font-size: 1.1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
button:hover {
  background-color: #597d2b;
}
a {
  display: block;
  margin-top: 10px;
  color: #6c9f3b;
  text-decoration: none;
  font-size: 0.9rem;
}
a:hover {
  text-decoration: underline;
}

</style>
