<template>
    <div class="account-container">
      <div class="account-card">
        <div class="profile-section">
          <div class="profile-pic"></div>
          <h2>JuanDC</h2>
        </div>
        <div class="allergies-section">
          <div class="allergy-group">
            <h3>FRUITS/VEGETABLES I’M ALLERGIC TO:</h3>
            <ul>
              <li>Apple</li>
              <li>Carrot</li>
              <li>Strawberry</li>
            </ul>
          </div>
          <div class="allergy-group">
            <h3>I MIGHT BE ALLERGIC TO:</h3>
            <ul>
              <li>Peach</li>
              <li>Tomato</li>
              <li>Spinach</li>
            </ul>
          </div>
        </div>
        <button class="edit-button" @click="editProfile">EDIT</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AccountPage',
    methods: {
      editProfile() {
        alert('Edit profile clicked');
      }
    }
  }
  </script>
  
  <style scoped>
  .account-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f0f4f8;
    padding: 20px;
  }
  
  .account-card {
    background: #2e2e2e;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    width: 450px;
    padding: 30px;
    color: #ffffff;
    text-align: center;
    position: relative;
  }
  
  .profile-section {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
  }
  
  .profile-pic {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background-color: #cccccc;
    margin-right: 15px;
  }
  
  .profile-section h2 {
    font-size: 24px;
    color: #ffffff;
  }
  
  .allergies-section {
    margin-bottom: 20px;
  }
  
  .allergy-group {
    margin-bottom: 15px;
    text-align: left;
  }
  
  .allergy-group h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #ffffff;
  }
  
  .allergy-group ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  
  .allergy-group li {
    font-size: 16px;
    color: #cccccc;
  }
  
  .edit-button {
    background-color: #ffffff;
    color: #2e2e2e;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    position: absolute;
    bottom: 15px;
    right: 15px;
    transition: background-color 0.3s, transform 0.3s;
  }
  
  .edit-button:hover {
    background-color: #dddddd;
    transform: scale(1.05);
  }
  </style>
  