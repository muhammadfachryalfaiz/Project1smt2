<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <style>
  body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-form {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333333;
    }

    .input-group {
      margin-bottom: 20px;
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
      color: #666666;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #cccccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      border: none;
      color: #ffffff;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: #ff0000;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <form class="login-form" action="login.php" method="POST">
      <h2>Login</h2>
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" name="login">Login</button>
    </form>
  </div>

  <?php
session_start();

// Informasi login yang valid
$valid_username = "Admin";
$valid_password = "Admin";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Periksa apakah username dan password valid
    if ($username === $valid_username && $password === $valid_password) {
        // Simpan username ke dalam session (untuk penanda bahwa user telah login)
        $_SESSION['username'] = $username;
        
        // Redirect ke halaman selanjutnya setelah login sukses (misalnya, halaman dashboard)
        header("Location: index.php");
        exit();
    } else {
        // Jika username atau password tidak valid, tampilkan pesan error
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>


</body>
</html>