<?php
include 'db.php';

if (isset ($_POST["nume"]) && isset ($_POST["parola"]) && isset ($_POST["email"]) 
    && isset ($_POST["nume_prenume"]) && isset ($_POST["sex"])){
    
        $nume=$_POST['nume'];
        $parola=$_POST['parola'];
        $email=$_POST["email"];
        $nume_prenume=$_POST["nume_prenume"];
        $sex=$_POST["sex"];

        
        $imagine = $_FILES['poza']['tmp_name'];
        
        $continut_imagine = file_get_contents($imagine);
        $encodare_imagine = base64_encode($continut_imagine);
        
        $query = "INSERT INTO utilizatori_inscrisi (nume_utilizator,parola_utilizator,email_utilizator,
            nume_prenume_utilizator,sex_utilizator,poza_profil) VALUES ('$nume','$parola','$email','$nume_prenume','$sex','$encodare_imagine')";
       
        $inserare = mysqli_query($conexiune,$query);
        if($inserare) {
            echo "<script>alert('V-ati inregistrat cu succes.!')</scrip>";
        }else{
            echo  "<script>alert('Exista o problema.!')</scrip>";
        }
}
?>
