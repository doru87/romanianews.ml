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

.adauga_articol {
position:absolute;
float:left;
width:140px;
top:40px;
background-color: #104d66;
border: 0;
border-radius: 3px;
cursor: pointer;
color: #fff;
font-size:16px;
font-weight: bold;
line-height: 1.4;
padding: 5px;
}

.logout {
position:absolute;
right:40px;
top:40px;
background-color: #104d66;
border: 0;
height: 60px; 
width: 60px;
border-radius: 125px;
cursor: pointer;
color: #fff;
font-size:16px;
font-weight: bold;
line-height: 1.4;
padding: 5px;
}

.online {
position:absolute;
float:left;
top:90px;
background-color: #104d66;
border: 0;
width: 140px;
cursor: pointer;
color: #fff;
font-size:16px;
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
	     <?php if(isset($_SESSION['administrator'])){
	 	echo '<b><a href="logout.php">Log out</a></b>';
	 	}else {
	 	    echo '<a href="logout.php">Log out</a>';
	 	}
	 	?>
    </nav>
    
      <div id="modal">
     	<div class="modal">
     	<a href="inserare_stire.php"><button class=adauga_articol>Adauga articol</button></a>
     	<a href="useri_online.php"><button class=online>Utilizatori online</button></a>
        </div>
      </div>
</div>      
   <footer id="footer">
       
   </footer>
</body>
</html>