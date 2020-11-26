<?php
  if(!isset($_SESSION)) {
     session_start();
  }
  include("src/session.php");
  $p = new session();
  $p -> logout();
  header('location: index.php');
?>