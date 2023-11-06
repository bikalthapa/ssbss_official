<?php
function redirect_to($path){
	$destination = "location:".$path;
	header($destination);
}
?>