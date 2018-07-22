<?php

include 'db.php';
session_start();
?>

<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="style.css">
  <head>
<link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300italic,700,300' rel='stylesheet' type='text/css'>
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
<style type="text/css">

#modal {
padding: 30px;
}

.modal {
position:relative;
top:70px;
margin: auto;
padding: 40px;
width: 1000px;
height: 600px;
border-radius: 4px;
background:#919fb7;
}

.modal p {
position:relative;
text-align: center;
color: #232323;
font: 30px arial, sans-serif;
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

.table-responsive{
width:800px;
margin : 0 auto;
}

.tabel {
background:#fff;
}

.tabel th{
font-family: 'Patua One', cursive;
font-size:16px;
font-weight:400;
color:#fff;
text-align:left;
padding:20px;
background-color: #646f7f;
}

input[name=submit_button] {
position:relative;
width:140px;
top:0;
right:80px;
background-color: #0693cd;
border: 0;
border-radius: 3px;
cursor: pointer;
color: #fff;
font-size:16px;
font-weight: bold;
line-height: 1.4;
padding: 5px;
margin:0 0 0 140px;

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
  	
  	 <?php if(isset($_SESSION['administrator'])){ ?>
   		<script type="text/javascript">
   
   			function actualizeaza(){
   			 $.ajax({
   			  url: 'actualizeaza_utilizatori_online.php',
   			  type: 'post',
   			  success: function(response){
   	
   			  }
   			 });
   			}

   			function lista_utilizatori_online(){
      			 $.ajax({
      			  url: 'lista_utilizatori_online.php',
      			 type: 'post',
      	
      			  success: function(data){
      				$('.modal').html(data);
      			  }
      			 });
      			}

   			$(document).ready(function(){
   	   			
   			 setInterval(actualizeaza,5000);
   			 setInterval(lista_utilizatori_online,1000);
   			});
   			
   			
   		</script>
   		<?php }else{
   		    
   		    echo "<p>Nu aveti acces la aceasta pagina!</p>";
   		}?>
  	
        </div>
      </div>
   
      </body>
      
</html>
