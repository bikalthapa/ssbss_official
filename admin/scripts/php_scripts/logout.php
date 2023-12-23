<?php
    // This is for logout 
    $logout_condition = isset($_POST['logout'])?True:false;
    if($logout_condition){
        setcookie ("login_id", "", time() - 3600,'/');
        echo "logout_success";// Changing this results an error
    }

    function is_login($login_form_path){
        if(!isset($_COOKIE['login_id'])){
            header("location:".$login_form_path);
        }
    }
?>