<?php 
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "pfe";

  $error = "";
  try{
    $conn = new mysqli($servername,$username,$password,$dbname);

  }
 catch(Exception $err){
    
 }
 if(!$conn){
    die("connection failed: ");
 }
