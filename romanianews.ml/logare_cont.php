<?php
include 'db.php';
session_start();
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

.modal {
position:relative;
top:150px;
margin: auto;
padding: 40px;
width: 300px;
height: 200px;
border-radius: 4px;
background:#919fb7;
margin-bottom:800px;
}

input {
position:relative;
top: -20px;
padding: 3px;
margin-left: 100px;
}

input[type="submit"] {
margin: auto;
width: 80px;
top: 10px;
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
	 
    </nav>
    
      <div id="modal">
     	<div class="modal">
     	
     	<form action='logare_cont.php' method='post'> 
	     	Username:<input type='text' name='utilizator'/> 
	    	Password:<input type='password' name='parola'/> 
	      <input type='submit' name='submit' value='Log in'/> 
		</form>
		
		<?php 

if (isset($_POST['submit'])) {
    $utilizator = mysqli_real_escape_string($conexiune,$_POST['utilizator']);
    $parola = mysqli_real_escape_string($conexiune,$_POST['parola']);
	$activ="da";
    
    
	$sql = "SELECT * FROM utilizatori_inscrisi WHERE nume_utilizator ='".$utilizator."' AND parola_utilizator='".$parola."' AND activ='".$activ."'";
	
	$rezultat = mysqli_query($conexiune,$sql);
	
	if (mysqli_num_rows($rezultat) == 1) {
	    $row = mysqli_fetch_assoc($rezultat);
	    $_SESSION['utilizator'] = $row['nume_utilizator'];
	    $_SESSION['id_utilizator'] = $row['id_utilizator'];
	    $_SESSION['user'] = $row['tip_utilizator'];
	    $_SESSION['email'] = $row['email_utilizator'];
        
        echo "<script>location='administreaza_cont.php'</script>";
	    exit();
	 
	}
	    else {
	        $sql = "SELECT * FROM utilizatori WHERE administrator='".$utilizator."' AND parola='".$parola."'";
	        $rezultat = mysqli_query($conexiune, $sql);
	        
	        if (mysqli_num_rows($rezultat) == 1) {
	            $row = mysqli_fetch_assoc($rezultat);
	            $_SESSION['administrator']=$row['administrator'];
	            
	            echo "<script>location='panou_administrator.php'</script>";
	            exit();
	        }
	        
	    }
}
	
?>
     	 </div>
      </div>

    <footer id="footer">
        
    </footer>
 </body>
</html>