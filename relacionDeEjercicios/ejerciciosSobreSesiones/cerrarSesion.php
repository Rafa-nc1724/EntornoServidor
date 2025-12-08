<?php

session_name("user");
session_start();

session_unset();
session_destroy();
setcookie("user", $_COOKIE['user'], time() - 1, "/");
header("Location: index.php");
