<?php


include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");
session_start();
// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);


$otask->open();
//$id, $tname, $tnim, $tp1, $tp2, $tp3, $tkelas
if(isset($_SESSION['username'])){    
    if(isset($_GET['id_project'])){
        $idproject = $_GET['id_project'];
        $applicant = $otask->getUserIdByUsername($_SESSION['username']);
        $owner = $otask->getUserIdByProjectId($_GET['id_project']);
        
        if( isset($_POST['done'])){
            $full_name = $_POST['fname'];
            $address = $_POST['address'];
            $sex = $_POST['gender'];
            $birth_date = $_POST['birthdate'];
            $phone_num = $_POST['telnum'];
            $req_data = $_POST['reqdat'];
            $experiences = htmlspecialchars($_POST['desc']);
            $otask->addApplyProject($applicant, $idproject, $owner, $full_name, $address, $sex, $birth_date, $phone_num, $req_data, $experiences );
            echo "<script type='text/javascript'>alert('Pendaftaran Berhasil!');</script>";
            header('Refresh: 0; URL = projects.php');
        }
        
    }
}else{
    echo "<script type='text/javascript'>alert('Login terlebih dahulu!');</script>";
    header('Refresh: 0; URL = login.php');
}



// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("skin/applyprj.html");
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