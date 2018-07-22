<?php
include ("db.php");
session_start();

if (isset($_SESSION['id_utilizator'])){
   $query = "UPDATE utilizatori_inscrisi SET lastActiveTime=now() WHERE id_utilizator='".$_SESSION['id_utilizator']."'"; 
   $rezultat = mysqli_query($conexiune, $query);
}
