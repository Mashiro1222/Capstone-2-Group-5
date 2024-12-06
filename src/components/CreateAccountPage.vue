<template>
  <div class="create-account-container">
    <div class="create-account-box">
      <h2>
        CREATE<br />
        ACCOUNT
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
        <div class="input-group">
          <input
            type="password"
            id="repeat-password"
            required
            v-model="repeatPassword"
            placeholder="Repeat Password"
          />
        </div>
        <button type="submit" class="sign-up-button">SIGN UP</button>
      </form>
      <a href="/" class="login-link">LOGIN INSTEAD</a>
    </div>
  </div>
</template>

<script>
export default {
  name: "CreateAccountPage",
  data() {
    return {
      username: "",
      password: "",
      repeatPassword: ""
    };
  }
};
</script>

<style scoped>
/* Container Styles */
.create-account-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f0f0f0; /* Light gray background */
  margin: 0;
}

/* Create Account Box Styles */
.create-account-box {
  background-color: #d3d3d3; /* Gray box for create account */
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  text-align: center;
  width: 320px;
  font-family: "Arial", sans-serif; /* Matching font family */
}

/* Title Styles */
.create-account-box h2 {
  font-size: 1.5rem; /* Adjusted for better visibility */
  font-weight: bold;
  margin-bottom: 30px;
  color: #333; /* Dark gray for text */
  letter-spacing: 2px;
}

.create-account-box h2 br {
  display: block;
  line-height: 0.5rem; /* Adjusts the line spacing */
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
  text-align: left;
}

.input-group input::placeholder {
  color: #aaa; /* Light gray for placeholder */
  font-weight: normal;
  letter-spacing: 1px;
}

/* Button Styles */
.sign-up-button {
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

.sign-up-button:hover {
  background-color: #555; /* Slightly lighter gray on hover */
}

/* Login Link */
.login-link {
  display: block;
  margin-top: 20px;
  font-size: 1rem;
  font-weight: bold;
  text-decoration: none;
  color: #333;
  letter-spacing: 1px;
}

.login-link:hover {
  color: #555;
}
</style>
