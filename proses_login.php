<?php 
require_once 'config/config.php';
if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];

   $query = $conn->query("SELECT * FROM pengguna WHERE email = '$email' AND password = '$password'");

   $result = mysqli_num_rows($query);

   if ($result > 0) {
      session_start(); 
      $_SESSION['login'] = true;
      header('location:index.php?module=beranda');
   } else {
      session_start();
      $_SESSION['error-login'] = 'Masukkan email dan password yang sesuai!';
      header('location:login.php');
   }
}