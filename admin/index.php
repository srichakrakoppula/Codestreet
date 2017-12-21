<?php
if($_SESSION['isadmin']===false)
    header("Location: ../index.php");
else
    header("Location: admin.php");