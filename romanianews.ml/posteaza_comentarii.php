<?php
include 'db.php';

if(isset($_POST['nume_utilizator']) && isset($_POST['email_utilizator']) && isset($_POST['comentariu_utilizator']) && isset($_POST['id_articol']))
{
    global $conexiune;
    $id_articol=$_POST["id_articol"];
	$nume=$_POST['nume_utilizator'];
	$email=$_POST['email_utilizator'];
	$comentariu=$_POST['comentariu_utilizator'];
    $random_num = rand(0, 99999999999);
	
	   $query1 = "INSERT INTO comentarii_utilizatori (id_articol,nume,email,comentariu,data_postare,comment_hash) VALUES ('$id_articol','$nume','$email','$comentariu',CURRENT_TIMESTAMP,$random_num)";
		
	       $insereaza=mysqli_query($conexiune,$query1);
	       
	   
}

?>

		