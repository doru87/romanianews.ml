<?php 
include ("functii.php");
include ("db.php");
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="style.css">
  <head>
      <meta charset="utf-8" />
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
position:relative;
}

.cont-wrapper {
width: 1000px;
padding: 20px;
margin:0 auto;
margin-bottom:300px;
}

.cont-wrapper .post {
width: 100%;
margin:0 auto;
}

.editeaza {
position:relative;
float:right;
width:140px;
top:60px;
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
}

#modal {
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
z-index: -1;
background: rgba(0, 0, 0, 0.7);
opacity: 0;
}

.modal {
position:relative;
top:70px;
margin: auto;
padding: 40px;
width: 400px;
height: 550px;
border-radius: 4px;
background:#919fb7;
}

.modal a.close {
position: absolute;
display: block;
top: 7px;
right: 7px;
background: #232323;
color: #fff;
text-align: center;
font: 14px/1.5 Helvetica, Verdana, sans-serif;
text-decoration: none;
padding: 0 5px;
}

#modal:target,
#modal:target > .modal {
opacity: 1;
z-index: 2;
}   

.post p {
font-size: 2em;
}

#modal input[name="titlu_articol"]{
position:relative;
top:20px;
margin-left:0;
margin-bottom:20px;
width: 90%;
}

#modal input[name="categorie_articol"]{
position:relative;
top:20px;
margin-left:0;
margin-bottom:20px;
width: 50%;
}

#modal textarea {
position:relative;
width:400px;
height:300px;
top:20px;
width: 100%;
}

#modal input[name="submit"]{
position:relative;
top:20px;
}

.main {
position: absolute;
top: 240px;
width: 200px;
height:337px;
overflow: hidden;
background: #3B3B3B;
transition: 1s ease-in-out;
visibility: hidden;
opacity: 0;
}

.main-nav {
overflow-y:scroll;
height:337px;
width: 220px;
}

.main-nav a {
display: block;
background: linear-gradient(#3e3e3e, #383838);
border-top: 1px solid #484848;
border-bottom: 1px solid #2E2E2E;
color: white;
padding: 15px;
}

.open-menu {
position:absolute;
top: 200px;
left:0;
}

.close-menu {
position:absolute;
top: 200px;
left:250px;
}

.btn {
position:relative;
float:right;
top:60px;
right:80px;
background: #406782;
background-image: -webkit-linear-gradient(top, #406782, #12405c);
background-image: -moz-linear-gradient(top, #406782, #12405c);
background-image: -ms-linear-gradient(top, #406782, #12405c);
background-image: -o-linear-gradient(top, #406782, #12405c);
background-image: linear-gradient(to bottom, #406782, #12405c);
-webkit-border-radius: 0;
-moz-border-radius: 0;
border-radius: 0px;
-webkit-box-shadow: 0px 1px 3px #666666;
-moz-box-shadow: 0px 1px 3px #666666;
box-shadow: 0px 1px 3px #666666;
font-family: Arial;
color: #ffffff;
font-size: 20px;
padding: 10px 20px 10px 20px;
text-decoration: none;
}

.btn:hover {
background: #13405c;
background-image: -webkit-linear-gradient(top, #13405c, #183e57);
background-image: -moz-linear-gradient(top, #13405c, #183e57);
background-image: -ms-linear-gradient(top, #13405c, #183e57);
background-image: -o-linear-gradient(top, #13405c, #183e57);
background-image: linear-gradient(to bottom, #13405c, #183e57);
text-decoration: none;
}

.menuBtn {
position: absolute;
display: inline-block;
background: #f1103a;
color: #FFF;
cursor: pointer;
font: bold 1.7em/36px Courier New;
width: 36px;
height: 36px;
text-align: center;
text-shadow: 0 -5px, 0 5px;
transition: 0.15s;
}

.menuBtn:hover {
background: #222;
}
.active  {
visibility: visible;
opacity: 1;
} 

.bookmark_active {
visibility: visible;
opacity: 1;
}

.imagine_stanga {
width:120px;
height:90px;
}

.sectiune{
position:relative;
top:150px;
float:right;
}

.sectiune_dreapta{
height:auto;
background-color:#586b89; 
padding: 20px;
margin: 20px 20px;
margin-left:10px;
font-size: 0.6em;
}

.postare{
width:200px;
height:240px;
background-color:#d4d8dd; 
padding: 20px;
margin: 0 0 20px 0;
font-size: 0.6em;
margin: 20px auto;
}

.sectiune_dreapta p {
color: #f2eded;
font: 15px arial, sans-serif;
text-align: center;
}

#raspuns {
display: inline-block;
}

#comments .commentlist{margin:20px 0 72px 0; padding:0;}
#comments .commentlist .comment{padding:10px;background:#E0E0E0; margin:0 20px 20px 0;list-style:none;}
#comments .commentlist .comment .avatar{float:left;margin:0 20px 0 0;width:100px;height:100px;}
 
.author {
padding:5px;
}

.delete_comment {
position:relative;
top:160px;  
left:0px;
}

.modal h2 {
color: #232323;
font: 30px arial, sans-serif;
text-align: center;
}

.modal input {
position: relative;
top:-20px;
padding:3px;
margin-left:150px;
display:block;
}

input[type=radio]{
margin-left:115px;
display: inline-block;
top:0px;
}

input[type=submit] {
margin:30px 0 0  10px;
width: 160px;
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

<div class="sectiune">
  <div class=sectiune_dreapta>
      <input type="hidden" id="refreshed" value="no">
	<p>Ultimele ştiri din aceeaşi categorie:</p>
  	<?php if (isset($_SESSION['categorie'])) {
  	    $output="";
  	    $interogare = "SELECT * FROM inserare_stire WHERE categorie='".$_SESSION['categorie']."' 
            AND id_articol !='".$_GET['id_articol']."' ORDER BY data_publicarii DESC LIMIT 3";
  	    $rezultat = mysqli_query($conexiune, $interogare);
  	    
  	    while($row = mysqli_fetch_array($rezultat)) {
  	        $titlu = $row["titlu"];
  	        $poza = $row["poza"];
  	        $id = $row["id_articol"];
  	        
  	        $output .= '<div class="postare">
                <a href="afisare_articol.php?id_articol='.$id.'">
                <img class="imagine_stanga" src="/poze/'.$poza.'">
                <h1>'.$titlu.'</h1>
                 </a>
                 </div>';
  	    }
  	    
  	        echo $output;
  	  
  	}?>
  	</div>
  </div>

   <?php 	 	
 if(isset($_SESSION['id_utilizator'])){
  echo "<button class='menuBtn'>&minus;</button>
        <div class='main'>
            <div class='main-nav'>";
   
                $id = $_GET['id_articol'];
                $id_utilizator = $_SESSION['id_utilizator'];
                $query = "SELECT * FROM inserare_stire WHERE id_articol='$id'";
                $result = mysqli_query($conexiune, $query);
                
                while($row = mysqli_fetch_array($result)){
                    $titlu = $row["titlu"];
                }
                if(isset($_POST['btn'])){
                    $query1 = "INSERT INTO adauga_la_favorite_utilizatori (id_utilizator,id_articol,titlu) VALUES ('$id_utilizator','$id','$titlu')";
                    $result1 = mysqli_query($conexiune, $query1);
                }    
                    $query2 = "SELECT DISTINCT id_articol, titlu FROM adauga_la_favorite_utilizatori WHERE id_utilizator='$id_utilizator'";
                    $result2 = mysqli_query($conexiune, $query2);
                    while($row = mysqli_fetch_array($result2)){
                        $titlu = $row["titlu"];
                        $id_articol = $row["id_articol"];
                        
                    
                echo "<a href='afisare_articol.php?id_articol=$id_articol'>$titlu</a>";
             }
     
         	echo "</div>
         </div>";


    }?>
<div class="cont-wrapper">

<?php if(isset($_SESSION['id_utilizator'])) {?>
<form method="post" action="">
<button class = "btn" type="submit" name="btn">Adauga la Favorite</button>
</form>
<?php }?>
 	 	
  	   <?php 
  	   if (isset($_SESSION['administrator'])){
  	       $id_articol = $_GET['id_articol'];
  	             $query = "SELECT * FROM inserare_stire WHERE id_articol='$id_articol'";
  	             $result = mysqli_query($conexiune, $query);
  	             while ($row = mysqli_fetch_array($result)){
  	                 $titlu = $row["titlu"];
  	                 $categorie = $row["categorie"];
  	                 $continut = $row["continut"];
  	             }
  	             
  	             if(isset($_POST['submit'])) {
  	                 $titlu_subiect = $_POST['titlu_articol'];
  	                 $categorie_subiect = $_POST['categorie_articol'];
  	                 $continut_subiect = $_POST['continut_articol'];
  	                 
  	                 $query = "UPDATE inserare_stire SET titlu='$titlu_subiect', categorie='$categorie_subiect', continut='$continut_subiect' WHERE id_articol='$id_articol'";
  	                
  	                 $result = mysqli_query($conexiune, $query);
  	          
  	                 
  	                 echo "<script>window.open('index.php','_self')</script>";
  	             }
  	         
            echo "<a href='#modal'><button class='editeaza'>Editeaza articolul</button></a>
                    <div id='modal'>
                        <div class='modal'>
                            <a class='close' href='#'>Close</a>
                            
                            <form method='post' action=''>
                            <input type='text' name='titlu_articol' value ='$titlu' size='60' required />
                            <input type='text' name='categorie_articol' value ='$categorie' size='60' required />
                            <textarea name='continut_articol'>$continut</textarea>
                            <input name='submit' type='submit' id='submit' value='OK' />
                            </form>
                        </div>
                    </div>";
            
         
  	   }
       ?>
  <div class="post">
  	<?php afiseaza_articol();?>
 <?php if (isset($_SESSION['categorie'])) {
     echo '<input type="hidden" value="'. $_SESSION["categorie"].'" id="categorie"/>';
 }?>
  </div>
  
  
  <div id="comments">
          <h2>Comentarii</h2>
        <?php afiseaza_comentarii();?>
  </div>
       
  
  <h2>Scrie un comentariu</h2>
        <div id="raspuns">
			<form method="post" action="" onsubmit="return post();">
            <p>
              <input type="text" name="nume" id="nume" value="<?php if(isset($_SESSION['id_utilizator'])) { echo $_SESSION['utilizator']; }?>" size="22" />
              <label for="nume"><small>Name (required)</small></label>
            </p>
            <p>  
              <input type="text" name="email" id="email" value="<?php if(isset($_SESSION['id_utilizator'])) { echo $_SESSION['email']; }?>" size="22" />
              <label for="email"><small>Mail (required)</small></label>
            </p>
            <p>
              <textarea name="comentariu" id="comentariu" cols="100%" rows="10"></textarea>
              <label for="comentariu" style="display:none;"><small>Comment (required)</small></label>
            </p>
            <p>
              <input name="submit" type="submit" id="submit" value="Posteaza" />
               <input type="hidden" name="id_articol" id="id_articol" value=<?php echo $_GET['id_articol']?>/>

            </p>
          </form>
        </div>

    </div>
</div>
 	 <footer id="footer">
  	 </footer>
  <script type="text/javascript">

  function post() {
		var nume = document.getElementById("nume").value;
		var email = document.getElementById("email").value;
		var comentariu = document.getElementById("comentariu").value;
		var id = document.getElementById("id_articol").value;
	
	
	if(nume!="" && email!="" && comentariu!="")
	{
	  $.ajax
	  ({
	    type: 'post',
	    url: 'posteaza_comentarii.php',
	    data: 
	    {
		   nume_utilizator:nume,
	  	   email_utilizator:email,
	       comentariu_utilizator:comentariu,
	       id_articol:id,
	     

	    },
	    success: function (response) 
	    {
		  document.getElementById("comments").innerHTML=response+document.getElementById("comments").innerHTML;
		  document.getElementById("nume").value="";
	      document.getElementById("email").value="";
	      document.getElementById("comentariu").value="";
	   

	    }
	  });
	}

	return false;
	}
  $("document").ready(function () {
	  $(".menuBtn").click(function () {
		  $(this).next().toggleClass("active");
		  
	  });
	  $(".btn").click(function () {
		 
		  $(this).parent().parent().parent().find(".main").addClass("active");
	  });

  });
  
  window.onload = function() {
    //considering there aren't any hashes in the urls already
    if(!window.location.hash) {
        //setting window location
        window.location = window.location + '#loaded';
        //using reload() method to reload web page
        window.location.reload();
    }
}
 
  </script>
    </body>
</html>
