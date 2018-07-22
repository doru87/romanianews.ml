<?php
include 'db.php';
include 'functii.php';
header('Content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html>

<html>
	<link rel="stylesheet" type="text/css" href="style.css">
  <head>

<link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300italic,700,300' rel='stylesheet' type='text/css'>
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
overflow-x:hidden;
}

.navslider {
display: table;
margin: 0 auto;
}

.navslider  a { 
background: #e74c3c;
border-radius: 20px; 
color: white;
display: block;
float: left;
font-family: sans-serif;
font-size: 12px;
height: 30px;
line-height: 30px;
margin: 5px;
text-align: center;
text-decoration: none;
width: 30px;
}

.navslider a:active {
background: #c0392b;
}

#slider {
height: 350px;
width: 500px;
background: #ecf0f1;
margin: 20px auto;
position: relative;
border: 10px solid white;
box-shadow: 0px 0px 5px 2px #ccc;
}

.box {
color: rgba(255,255,255,.6);
font-family: sans-serif;
font-size: 48px;
height: 100%;
line-height: 300px;
position: absolute;
text-align: center;
width: 100%;
}

.box:target {
z-index: 10;
opacity: 1;
}

.box img {
width: 100%;
height: 300px;
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
      
    <input type="text" name="search_text" id="text_cautat" placeholder="Cauta Articol" class="form-control" />

    </div>
    
    <div class="right"></div>
    <div class="left"></div>
    <div class ="center"></div>

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
 
	
<?php  $query = "select * from inserare_stire";
 	      $list = array();
 	      $ruleaza = mysqli_query($conexiune, $query);
 	      while ($row = mysqli_fetch_assoc($ruleaza)){
 	

 	          $data = array("poza" => $row["poza"], "id_articol" => $row["id_articol"]);
 	       
 	          $poza[] = array_values($data)[0];
 	          $id_articol[] = array_values($data)[1];

 	      }
	         echo "  <div id='slider'>
                        <div class='box' id='box1'> <a href='http://www.romanianews.ml/afisare_articol.php?id_articol=$id_articol[0]'><img src='/poze/$poza[0]'></a></div>
                        <div class='box' id='box2'> <a href='http://www.romanianews.ml/afisare_articol.php?id_articol=$id_articol[1]'><img src='/poze/$poza[1]'></a></div>
                        <div class='box' id='box3'> <a href='http://www.romanianews.ml/afisare_articol.php?id_articol=$id_articol[2]'><img src='/poze/$poza[2]'></a></div>
                     </div>
                          <nav class='navslider'>
                            <a href='#box1'>1</a>
                            <a href='#box2'>2</a>
                            <a href='#box3'>3</a>  
                          </nav>";
 	      
 	?>


    <div class="content-wrapper">

 	   		<div class= "post">
<?php 
obtine_articole();
?>
  	</div
 
  </div>
  </div>

  
<script type="text/javascript">

	  function load_data(query)
	  {
	   $.ajax({
	    url:"fetch.php",
	    method:"POST",
	    data:{query:query},
	    success:function(data)
	    {
	     $('.post').html(data);
	    }
	   });
	  }
	  $('#text_cautat').keyup(function(){
	   var text = $(this).val();
	   if(text != '')
	   {
	    load_data(text);
	   }
	   else
	   {
	    load_data();
	   }
	  });
 
  </script>
  </body>
</html>




