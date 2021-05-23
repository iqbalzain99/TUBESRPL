<?php


include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");
session_start();
// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();
if( isset($_POST['sort'])){
    $word = $_POST['search'];
    $otask->getFilteredActiveProject($word);
}else{
    $otask->getActiveProject();
}

$data = null;

while (list($id_project, $id_owner, $status, $end_date, $title, $location, $category, $date_project, $desc) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan

    $data .= "<li><div class='prj-box'>".
        "<a href='projectdetail.php?id_project=".$id_project. "'>".
            "<div class='prj-title'>".
                "<img src='img/header/rectangle.png' alt=''>".
                "<div class='judul'>".
                    "<h1>".$title."</h1>".
                    "<p>".$location."</p>".
                "</div>".
            "</div>".
            "<div class='prj-desc'>".
                "<p>".$desc."</p>".
            "</div>".
        "</a>".
    "</div></li>";
}
// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("skin/projects.html");

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
$tpl->replace("PROJECTLIST", $data);
// Menampilkan ke layar
$tpl->write();