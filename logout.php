<?php

session_start();

if(isset($_SESSUON['user_id']))
{
    unset($_SESSION['user_id']);
}

header("Location: login.php");
die;