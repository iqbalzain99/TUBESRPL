<?php


include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");
session_start();
// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if( isset($_POST['login'])){
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    
    if($username === "admin" && $password === "admin"){
        header("location:admin.php");
    } 
    else {
        $check = mysqli_query($otask->getLink(),"SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
        if (mysqli_num_rows($check)=== 1) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $username;
            header("location:index.php");
        }else{
            echo "<script type='text/javascript'>alert('Username dan password salah!');</script>";
        }
    }
}
// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("skin/login.html");

$profilDefault = "<div class='profile-container'>
<div class='btn-profile'>
    <a href='login.php'>Login</a>
</div>
<div class='btn-profile2'>
    <a href='signup.php'>Sign up</a>
</div>
</div>";

if(isset($_SESSION['username'])){
        
        $nama = $_SESSION['username'];
        $profilDefault = "<div class='btn-profile'>
        <a href='logout.php'>Log Out</a>
        </div>
        <p style='color: #ECF0F1; font-size: 24px; font-family: Raleway; font-weight: 300;'>Hello, $nama!</p>
        <div class='profile-container'>
            <a href='editprofile.php'><img src='img/header/rira.png'></a>
        </div>";
        
}
$tpl->replace("PROFIL", $profilDefault);
// Menampilkan ke layar
$tpl->write();