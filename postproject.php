<?php


include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");
session_start();
// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if( isset($_POST['done'])){
	$title = $_POST['title'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $desc = htmlspecialchars($_POST['desc']);
    if(isset($_SESSION['username'])){
        $otask->addProjectBaru($_SESSION['username'] , $title, $location , $category, $date, $desc);
        echo "<script type='text/javascript'>alert('Project Berhasil Ditambahkan!');</script>";
        header('Refresh: 1; URL = projects.php');
        
    }else{
        echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu!');</script>";
    }
}
//$id, $tname, $tnim, $tp1, $tp2, $tp3, $tkelas
// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("skin/postproject.html");
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