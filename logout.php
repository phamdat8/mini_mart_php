<?php
  include("src/session.php");
  $p = new session();
  $p -> logout();
  header('location: index.php');
?>