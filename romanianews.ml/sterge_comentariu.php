<?php
include 'db.php';
global $conexiune;

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_GET['id_articol'])){
    $id = $_GET['id_articol'];
}
if (isset($_GET['hash'])){
    $id_hash = $_GET['hash'];
}

$query = "DELETE FROM comentarii_utilizatori WHERE id_articol LIKE '%$id%' AND comment_hash LIKE '%$id_hash%'";
$rezultat = mysqli_query($conexiune, $query);
if(mysqli_affected_rows($conexiune)>0){
       echo "<script>location='index.php'</script>";
}