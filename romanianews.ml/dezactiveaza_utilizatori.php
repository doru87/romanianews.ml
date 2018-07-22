<?php
include ("db.php");

$dezactiv="nu";
$activ="da";

if(isset($_POST['submit2'])){
    $id=$_POST['id_utilizator'];
    $query = "UPDATE utilizatori_inscrisi SET activ='$dezactiv' WHERE id_utilizator='$id'";
    $rezultat = mysqli_query($conexiune, $query);
        echo "<script>location='useri_online.php'</script>";

    
}else if(isset($_POST['submit1'])) {
    
    $id=$_POST['id_utilizator'];
    $query = "UPDATE utilizatori_inscrisi SET activ='$activ' WHERE id_utilizator='$id'";
    $rezultat = mysqli_query($conexiune, $query);
         echo "<script>location='useri_online.php'</script>";

    }
