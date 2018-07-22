<?php
include 'db.php';
include 'functii.php';

?>

<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="style.css">
  <head>
<link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300italic,700,300' rel='stylesheet' type='text/css'>
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
<style type="text/css">

input[type=submit] {
margin: 0 0 0 0;
width: 140px;
background-color: #0693cd;
border: 0;
border-radius: 3px;
cursor: pointer;
color: #fff;
font-size:16px;
font-weight: bold;
line-height: 1.4;
padding: 5px;
}

img {
height: 150px;
width: 120px;
border:1px solid black;
padding: 5px;
margin: 20px 170px 0 0;
}

p{
position: relative;
top:10px;
left:10px;
font-family: 'Open Sans Condensed', sans-serif;
color: black;
font-size: 17px;
}

input[type=password] {
position: relative;
left:-60px;
top:-30px;
}

input[name=submit]{
position: relative;
top:-10px;
left:10px;
}

form[name=form_password]{
border:1px solid black;
position: relative;
top:20px;
}

.logout {
position:relative;
float:right;
top:0;
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

</style>
</head>
<body>
    <div id="header">
      <p><a href="#">Studio Caravalt</a></p>
    </div>
    <div class="right"></div>
    <div class="left"></div>
    <div class ="center"></div>
    <div id="footer"></div>
    
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
     	
     	<?php 
     	
	    global $conexiune;
     	    $id=$_GET['id_utilizator'];
     	    
     	    if(isset($_SESSION['administrator']))
     	    {
     	        $query = "SELECT * FROM utilizatori_inscrisi WHERE id_utilizator='$id'";
     	        $result = mysqli_query($conexiune, $query);
     	        while($row = mysqli_fetch_array($result)){
     	            $data_inscrierii=$row['data_inscrierii'];
     	            $ultima_activitate=$row['lastActiveTime'];
     	            $poza_profil = $row['poza_profil'];
     	            echo '<img src="data:image/png;base64,'.$poza_profil.'"/>
                     <p> Data inscrierii:'.$data_inscrierii.'</p>
     	             <p> Ultima data activ:'.$ultima_activitate.'</p>';
     	            
     	            
     	         }
     	    } else{
     	            echo "Nu aveti acces la aceasta pagina!";
     	        }
  
     	    
		?>
	
     	 </div>
      </div>
   
      </body>
</html>