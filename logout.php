<?php
   session_start();
   unset($_SESSION["valid"]);
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   session_destroy();
   header('Refresh: 0; URL = index.php');
?>