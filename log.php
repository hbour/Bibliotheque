<?php
if($_SESSION) {
	include "logout.php";
} else {
	include "login.php";
}
?>