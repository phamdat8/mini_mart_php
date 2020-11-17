<?php
session_start();
include_once('connect.php');
$p = new connect();
$GLOBALS['con'] = $p -> conn();



?>