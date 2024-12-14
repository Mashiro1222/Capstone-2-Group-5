<template>
    <div class="allerguide-container">
      <div class="allerguide-card">
        <div class="header">
          <h1>ALLERCHECK</h1>
          <p>Your guide to fruits & vegetables allergies</p>
        </div>
        <div class="content">
          <p>Discover the possible allergies that may arise from the fruits and vegetables you eat</p>
          <div class="button-group">
            <button @click="handleUpload">UPLOAD IMAGE</button>
            <button @click="handleTakePhoto">OR TAKE A PHOTO</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AllerCheckCard',
    methods: {
      handleUpload() {
        alert('Upload image clicked');
      },
      handleTakePhoto() {
        alert('Take photo clicked');
      }
    }
  }
  </script>
  
  <style scoped>
  html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f0f4f8;
  }
  
  .allerguide-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
  }
  
  .allerguide-card {
    background: #2e2e2e;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    padding: 40px;
    width: 70%; /* Adjust to fit the full width */
    max-width: 900px;
    color: #ffffff;
    text-align: center;
    overflow: auto;
  }
  
  .header h1 {
    margin-bottom: 15px;
    font-size: 36px;
    font-family: 'Arial', sans-serif;
    font-weight: bold;
    color: #ffffff;
  }
  
  .header p {
    font-size: 20px;
    margin-bottom: 30px;
    color: #cccccc;
  }
  
  .content p {
    margin-bottom: 30px;
    font-size: 18px;
    color: #dddddd;
  }
  
  .button-group {
    display: flex;
    justify-content: center;
    gap: 15px;
  }
  
  button {
    background-color: #ffffff;
    color: #2e2e2e;
    border: none;
    border-radius: 10px;
    padding: 15px 25px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s, transform 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  button:hover {
    background-color: #dddddd;
    transform: scale(1.05);
  }
  </style>
  