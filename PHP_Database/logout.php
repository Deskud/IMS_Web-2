<?php
session_start();

session_unset();

session_destroy();

header("Location: ../Login.php");//Balik sa Login page pag pinindot yung Logout button.

?>