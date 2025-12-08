<?php

session_name("emp");
session_start();
session_unset();
session_destroy();
setcookie("emp", $_COOKIE['emp'], time() - 1, "/");
header("Location: login.php");

