<template>
  <div class="login-container">
    <div class="login-box">
      <h2>
        WELCOME<br />
        TO<br />
        ALLERCHECK
      </h2>
      <form>
        <div class="input-group">
          <input
            type="text"
            id="username"
            required
            v-model="username"
            placeholder="Username"
          />
        </div>
        <div class="input-group">
          <input
            type="password"
            id="password"
            required
            v-model="password"
            placeholder="Password"
          />
        </div>
        <button type="submit" class="login-button">LOGIN</button>
      </form>
      <a href="#" class="create-account-link">CREATE ACCOUNT</a>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginPage",
  data() {
    return {
      username: "",
      password: ""
    };
  }
};
</script>

<style scoped>
/* Container Styles */
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f0f0f0; /* Light gray background */
  margin: 0;
}

/* Login Box Styles */
.login-box {
  background-color: #fff; /* White box for login */
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  text-align: center;
  width: 320px;
  font-family: "Arial", sans-serif; /* Matching font family */
}

/* Title Styles */
.login-box h2 {
  font-size: 1.5rem; /* Adjusted for better visibility */
  font-weight: bold;
  margin-bottom: 30px;
  color: #333; /* Dark gray for text */
  letter-spacing: 2px;
}

.login-box h2 br {
  display: block;
  line-height: 0.5rem; /* Adjusts the line spacing between 'WELCOME' and 'TO' */
}

/* Input Group Styles */
.input-group {
  margin-bottom: 20px;
}

.input-group input {
  width: 100%;
  padding: 12px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff; /* White background for inputs */
  text-align: left; /* Align text to the left */
}

.input-group input::placeholder {
  color: #aaa; /* Light gray for placeholder */
  font-weight: normal;
  letter-spacing: 1px;
}

/* Button Styles */
.login-button {
  width: 100%;
  padding: 12px;
  background-color: #333; /* Dark gray button */
  color: white;
  font-size: 1.1rem;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login-button:hover {
  background-color: #555; /* Slightly lighter gray on hover */
}

/* Create Account Link */
.create-account-link {
  display: block;
  margin-top: 20px;
  font-size: 1rem;
  font-weight: bold;
  text-decoration: none;
  color: #333;
  letter-spacing: 1px;
}

.create-account-link:hover {
  color: #555;
}
</style>
