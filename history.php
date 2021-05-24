<?php


include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");
session_start();
// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

$otask2 = new Task($db_host, $db_user, $db_password, $db_name);
$otask2->open();
if(isset($_SESSION['username'])){
        
    $nama = $_SESSION['username'];
    $otask->getAppliedProjectByIdApplicant($otask->getUserIdByUsername($nama));
    $data = null;
    // $no = 1;

    while (list($id_apply, $id_applicant, $id_project, $id_owner, $full_name, $address, $sex, $birth_date, $phone_num, $req_data, $experiences,$status )= $otask->getResult()) {
        
        // Tampilan jika status pembayaran nya sudah bayar
        $otask2->getProjectById($id_project);
        list($id_prj, $id_ownr, $stts, $end_date, $title, $location, $category, $date_project, $desc) = $otask2->getResult();
        $data .= "<tr>
        <td>" . $title . "</td>
        <td>".$location."</td>
        <td>".$category."</td>
        <td>".$date_project."</td>
        <td>".$desc."</td>";
        if($status == 0){
            $data .= "<td align='center'>Dalam Pengajuan</td>
            </tr>";
        }else{
            $data .= "<td align='center'>Disetujui</td>";
        }
    }
}



// Menutup koneksi database
$otask->close();
$otask2->close();
// Membaca template skin.html
$tpl = new Template("skin/history.html");

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
        <p style='color: #ECF0F1; font-size: 24px; font-family: Raleway; font-weight: 300; margin-right: 15px;'>Hello, $nama!</p>
        <div class='profile-container'>
            <a href='editprofile.php'><img src='img/header/rira.png'></a>
        </div>";
        
}
$tpl->replace("PROFIL", $profilDefault);
$tpl->replace("DATA_TABEL", $data);
// Menampilkan ke layar
$tpl->write();