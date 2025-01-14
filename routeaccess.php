<?php 
session_start(); 
if (isset($_SESSION['username']) === true) { 
  header('Location: /sdbpkad/'); 
  exit(); 
}else{
    header('Location: /sdbpkad/login');  
}
//   ?>