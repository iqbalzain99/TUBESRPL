<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");
session_start();
// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if(isset($_GET['id_project'])){
	$projectId = $_GET['id_project'];
    $otask->getProjectByID($projectId);
}else{
    header("location:projects.php");
}

$data = null;
$dataAdmin = null;

list($id_project, $id_owner, $status, $end_date, $title, $location, $category, $date_project, $desc) = $otask->getResult();
$otask->getUserByID($id_owner);
list($userId, $email, $username, $password) = $otask->getResult();
	// Tampilan jika status task nya sudah dikerjakan

$data .= "<div class='prj-details'>".
    "<h1 style='font-size: 48px; '>".$title."</h1>".
    "<div class='align'>".
        "<h3 style='font-size: 24px;'>".$username."</h3>".
        "<h3 style='font-size: 24px;'>".$location."</h3>".
    "</div>".
    "<p>".$date_project."</p>".
    "<p style='font-weight: bold;'>Project Description</p>".
    "<p style='text-align: justify;'>".$desc."</p>".
    "<div class='align'>".
        "<div class='prj-cat'>".
            "<p style='font-weight: bold;'>Project Category</p>".
            "<p>".$category."</p>".
        "</div>".
        "<div class='prj-lvl'>".
            "<p style='font-weight: bold;'>Project Level</p>".
            "<p>level</p>".
        "</div>".
    "</div>".
"</div>";

$dataAdmin .= "<div class='admin-details'>".
    "<img src='img/header/Rectangle.png' alt=''>".
    "<div class='admin-name'>".
        "<h2>".$username."</h2>".
        "<p>".$email."</p>".
    "</div>".
"</div>";


$apply ="<a href='applyprj.php?id_project=".$projectId. "'>".
    "<p>Apply Now</p>".
"</a>";

if(isset($_GET['id_project'])){
    $applicant = $otask->getUserIdByUsername($_SESSION['username']);
    $owner = $otask->getUserIdByProjectId($_GET['id_project']);
    if($applicant === $owner){
        $apply ="<a href='applicantDetails.php?id_project=".$projectId. "'>".
            "<p>Details</p>".
        "</a>";
    }
}
// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("skin/projectdetail.html");

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
$tpl->replace("DATAPROJECT", $data);
$tpl->replace("DATAADMIN", $dataAdmin);
$tpl->replace("APPLYNOW", $apply);
// Menampilkan ke layar
$tpl->write();