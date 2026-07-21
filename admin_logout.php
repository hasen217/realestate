<?php
session_start();
session_unset();
session_destroy();
header("Location: realestateadmin.php");
exit();
?>
