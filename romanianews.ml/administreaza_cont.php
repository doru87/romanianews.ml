<?php
include 'db.php';
include 'functii.php';
?>

<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="style.css">
  <head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300italic,700,300' rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
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

input[name=incarca_poza] {
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
border: 1px solid black;
padding: 5px;
margin: 20px 170px 0 0;
}

.parola p {
position: relative;
top: 30px;
left: 10px;
font-family: 'Open Sans Condensed', sans-serif;
color: black;
font-size: 17px;
}

.parola input[type="password"] {
position:relative;
left: 100px;
top: 10px;
}

.parola input[name="submit_parola"] {
position:relative;
top:70px;
left:-120px;
width: 140px;
background-color: #0693cd;
border: 0;
border-radius: 3px;
cursor: pointer;
color: #fff;
font-size: 16px;
font-weight: bold;
line-height: 1.4;
}

form[name="form_password"] {
border: 1px solid black;
position: relative;
top: 20px;
height:200px;
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

#footer {
background-color: #30353C;
height: 200px; 
width: 100%;
bottom:0;
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
     	<form action="administreaza_cont.php" method="POST" enctype="multipart/form-data"> 
			<input type="file" name="imagine"/>
			<input type="submit" name="incarca_poza"  id="submit" value="Upload"/>
		</form>
     	<?php 
     	echo incarcare_poza_utilizator();
     	?>
     	
     	<form action="administreaza_cont.php" method="POST" name = "form_password" enctype="multipart/form-data">
     	  <div class="parola">
			<p>Parola Veche:</p>
				<input type="password" name="parola_veche">

			<p>Parola Noua:</p>
				<input type="password" name="parola_noua">

				<input type="submit" name="submit_parola" value="Schimba parola">
		   </div>
		</form>
		<?php 
		echo schimbare_parola();
		?>
	
     	 </div>
      </div>
</div>  

   <footer id="footer">
       
   </footer>
      </body>
      <script type="text/javascript">

$(document).ready(function(){
	   			
     setInterval(actualizeaza,5000);
			
});
		
      function actualizeaza(){
			 $.ajax({
			  url: 'actualizeaza_utilizatori_online.php',
			  type: 'post',
			  success: function(response){
	
			  }
			 });
			}
      </script>
</html>