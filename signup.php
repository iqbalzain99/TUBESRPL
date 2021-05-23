<?php
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if( isset($_POST['signUp'])){
	$email = $_POST['email'];
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $repas = $_POST['re-pass'];
    if($password != $repas){
        echo "<script type='text/javascript'>alert('Password yang dimasukkan tidak sesuai!');</script>";
    }else{
        // $otask->open();
        // $duplicate = cekUsername($username);
        $duplicate = mysqli_query($otask->getLink(),"SELECT * FROM tb_user WHERE username = '$username'");
        if(mysqli_num_rows($duplicate)>0){
            echo "<script type='text/javascript'>alert('Username telah terdaftar!');</script>";
        }
        else{
            $otask->addUserBaru($email , $username, $password);
            session_start();
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $username;
            header("location:index.php");
        }
    }
}
//$id, $tname, $tnim, $tp1, $tp2, $tp3, $tkelas
// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("skin/signup.html");
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