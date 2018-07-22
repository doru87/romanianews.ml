<?php
include 'db.php';

?>

<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="style.css">
  <head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300italic,700,300' rel='stylesheet' type='text/css'>
 	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
<style type="text/css">
* {
margin: 0;
padding: 0;
box-sizing: border-box;
}

.container{
width: 100%;
margin-top: 0px;
height:1000px;
}

.modal {
position: relative;
top: 100px;
margin: auto;
padding: 40px;
width: 500px;
height: 500px;
border-radius: 4px;
background: #919fb7;
}

.modal h2 {
color: #232323;
font: 30px arial, sans-serif;
text-align: center;
}

.modal input {
position: relative;
top: -20px;
padding: 3px;
margin-left: 150px;
display: block;
}

input[type="radio"] {
margin-left: 115px;
display: inline-block;
top: 0px;
}

input[type="submit"] {
margin: 30px 0 0 10px;
width: 160px;
background-color: #0693cd;
border: 0;
border-radius: 3px;
cursor: pointer;
color: #fff;
font-size: 16px;
font-weight: bold;
line-height: 1.4;
padding: 5px;
}

#footer {
background-color: #30353C;
height: 200px; 
width: 100%;
}
    
</style>
</head>
<body>
<div class="container">
    <div id="header">
      <p><a href="#">Romania News</a></p>
    </div>

 <nav class="navbar">
    
      <a href="creeaza_cont.php">Creeaza cont</a>
      <a href="logare_cont.php">Ai deja cont?</a>
      
      <?php 
      $output = '';
      $categorii ="select * from categorii_stiri";
      $ruleaza = mysqli_query($conexiune, $categorii);
        while ($lista_categorii = mysqli_fetch_field($ruleaza)) {
            $categorie = $lista_categorii->name;
            $output .= ' <a href="index.php?categorie='.$categorie.'">'.$categorie.'</a>';
      }
        echo $output;
        
      ?>
	   <?php if(isset($_SESSION['id_utilizator'])){
	 	echo '<b><a href="logout.php">Log out</a></b>';
	 	}else {
	 	    echo '<a href="logout.php">Log out</a>';
	 	}
	 	?>
    </nav>
    
     <div id="modal">
     	<div class="modal">

      <h2>Creeaza cont</h2>
      
      	<form action="creeaza_cont.php" method="post" enctype="multipart/form-data">
      	<p>Nume utilizator: <input type = "text" id="nume" name="nume"></input></p>
      	<p>Parola: <input type = "password" id="parola" name="parola"></input></p>
      	<p>Confirma Parola: <input type = "password" id="confirma_parola" name="confirma_parola"></input></p>
      	<p>Adresa de Email: <input type = "text" id="email" name="email"></input></p>
      	<p>Numele si prenumele: <input type = "text" id ="nume_prenume" name="nume_prenume"></input></p>
      	<p>Sex: <input type = "radio" id="sex" name= "sex" value="masculin">Masculin <input type = "radio" id="sex" name= "sex" value="feminin">Feminin</p>
      	<p>Imagine profil: <input type="file" name="poza"></p>
      	<p><input type ="submit" id="submit" name="submit" value="Inregistreaza-te"></p>
      	</form>
      	
      	
      	<?php if (isset($_POST['submit'])) {
      	    
      	    $nume=$_POST['nume'];
      	    $parola=$_POST['parola'];
      	    $email=$_POST["email"];
      	    $nume_prenume=$_POST["nume_prenume"];
      	    $sex=$_POST["sex"];
      	    $activ = "da";
      	    $tip = "user";
      	    $imagine = $_FILES['poza']['tmp_name'];
      	    
      	    $continut_imagine = file_get_contents($imagine);
      	    $encodare_imagine = base64_encode($continut_imagine);
      	    
      	    $query = "INSERT INTO utilizatori_inscrisi (tip_utilizator,nume_utilizator,parola_utilizator,email_utilizator,
            nume_prenume_utilizator,sex_utilizator,poza_profil,data_inscrierii,activ) VALUES ('$tip','$nume','$parola','$email','$nume_prenume','$sex','$encodare_imagine',now(),'$activ')";
      	    
      	    $inserare = mysqli_query($conexiune,$query);
      	}
      	
      	?>
      	</div>
      </div>
</div>  
  <footer id ="footer">
      
  </footer>    
      
  </body>
</html>
