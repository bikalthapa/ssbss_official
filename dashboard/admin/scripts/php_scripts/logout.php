<?php
include __DIR__."../../../../../script/php_scripts/utilities/authentication.php";
if($auth->logout()){
    header("Location: ../../../../index.php");
}
?>