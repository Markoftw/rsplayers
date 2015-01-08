<?php
ini_set('display_errors',"1");
session_start();
include "class.php";

if(isset($_POST['passwordCurr']) && isset($_POST['password1']) && isset($_POST['password2'])) {
    if (trim($_POST['passwordCurr']) != "" || trim($_POST['password1']) != "" || trim($_POST['password2']) != ""){
        if(trim($_POST['password1']) == trim($_POST['password2'])){
            $user = new user();
            $user->setUserID($_SESSION['UserID']);
            $user->setOldPassword(sha1($_POST['passwordCurr']));
            $user->setPassword(sha1($_POST['password1']));
            $user->setPasswordConfirm(sha1($_POST['password2']));
            $user->ChangePass();
        } else {
            echo "New passwords do not match!";
            header("Location: ../index.php?p=profile&a=settings&error=2");
        }
    } else {
        echo "Empty fields!";
        header("Location: ../index.php?p=profile&a=settings&error=3");
    }
} else {
    echo "Error.";
}