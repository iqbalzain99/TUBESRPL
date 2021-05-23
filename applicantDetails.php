<?php


include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");
session_start();
// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if( isset($_GET['id_project'])){
    // //mengupdate data pada tabel
    if(isset($_GET['id_done'])){
        $id_data = $_GET['id_done'];
        
        $otask->updateStatusAppliedProject(1, $id_data);
        $idProject = $_GET['id_project'];
        header("Location: applicantDetails.php?id_project='$idProject'");
    }

    $otask->getAppliedProjectByIdProject($_GET['id_project']);
    $data = null;
    // $no = 1;

    while (list($id_apply, $id_applicant, $id_project, $id_owner, $full_name, $address, $sex, $birth_date, $phone_num, $req_data, $experiences,$status )= $otask->getResult()) {
        
        // Tampilan jika status pembayaran nya sudah bayar
    
        $data .= "<tr>
        <td style='text-align: center;'>" . $id_apply . "</td>
        <th>".$id_applicant."</th>
        <th>".$id_project."</th>
        <th>".$id_owner."</th>
        <th>".$full_name."</th>
        <th>".$address."</th>
        <th>".$sex."</th>
        <th>".$req_data."</th>
        <th>".$experiences."</th>";
        if($status == 0){
            $data .= "<td align='center'><button class='btn btn-success'><a href='applicantDetails.php?id_project=".$_GET['id_project']."&id_done=" . $id_apply ."' style='color: white; text-decoration: none;'>Done</a></button></td>
            </tr>";
        }else{
            $data .= "<td align='center'><button class='btn btn-outline-success' disabled><a style='color: black; text-decoration: none;'>Done</a></button></td>";
        }
    }
}
// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("skin/applicantDetails.html");

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
$tpl->replace("DATA_TABEL", $data);
// Menampilkan ke layar
$tpl->write();