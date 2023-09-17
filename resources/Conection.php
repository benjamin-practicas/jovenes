<?php
  function conect (){
    $servername = "www.practice-design.xyz";
    $database = "u736202668_moodle";
    $username = "u736202668_usuario1";
    $password = "Contrasena1";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database) or die ("dabase error".mysql_error());
   // mysql_select_db($database, $conn);
    return $conn;
}
  
  
?>