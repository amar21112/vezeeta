<style>
  body {
    font-family: Arial, sans-serif;
    background: #f5f7fa;
    margin: 0;
    /* direction: rtl; */
  }
  
  .login-container {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 350px;
    text-align: center;
    border-top: 5px solid #1a76d2;
  }

  .login-container h2 {
    color: #1a76d2;
    margin-bottom: 20px;
  }

  .login-container input:not([type="checkbox"]) {
    width: 90%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }

  input[type="checkbox"] {
    margin-inline-end: 10px;
    transform: scale(1.2);
  }

  .login-container button {
    width: 100%;
    padding: 12px;
    background: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
  }

  .login-container button:hover {
    background: #c0392b;
  }

  .login-container p {
    margin-top: 15px;
    font-size: 14px;
  }

  .login-container a {
    color: #1a76d2;
    text-decoration: none;
  }

  .login-container a:hover {
    text-decoration: underline;
  }

  /* ✅ تذكرني مظبوطة ناحية اليمين */
  .remember-me {
    display: flex;
    /* justify-content: flex-end; يودّي المربع + النص على أقصى يمين */
    margin: 10px 0;
    font-size: 14px;
    color: #333;
  }

  .remember-me label {
    display: flex;
    align-items: center;
    gap: 5px;
    /* مسافة صغيرة بين المربع والكلمة */
    cursor: pointer;
  }
</style>