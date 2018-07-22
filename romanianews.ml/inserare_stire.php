<?php
include("db.php");
header('Content-type: text/html; charset=utf-8');
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Inserare Articol</title>
    <script src="//cdn.tinymce.com/4.7/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

    <style>
      body {
        font-family: sans-serif;
        background-color: #c2c8d1;
      }
      table {
          position:relative;
          top:50px;
      }
    </style>
  </head>
  <body>

        <form action="inserare_stire.php" method="post" enctype="multipart/form-data">
          <table align="center" width="700px" bgcolor="#586b89" border="2">
              <tr align="center">
                  <td colspan="7"><h2>Adauga un articol nou</h2></td>
              </tr>

              <tr>
                  <td align="right"><b>Titlul subiectului:</b></td>
                  <td><input type="text" name="titlu_subiect" size="60" required /></td>
              </tr>
              <tr>
                  <td align="right"><b>Categoria subiectului:</b></td>
                  <td>
                      <select name="categorie_subiect" required>
                        <option>Selecteaza o categorie</option>
                        <?php
                          $categorii = "select * from categorii_stiri";
                          $ruleaza = mysqli_query($conexiune, $categorii);
                          while ($lista_categorii = mysqli_fetch_field($ruleaza)) {
                         
                            echo "<option>$lista_categorii->name</option>";
                          }
                        ?>
                      </select>
                  </td>
              </tr>
              
              
              <tr>
                  <td align="right"><b>Utilizator:</b></td>
                  <td>
                    <select name="utilizator" required>
                        <option>Selecteaza utilizatorul</option>
                         <?php
                          $utilizatori = "select * from utilizatori";
                          $ruleaza = mysqli_query($conexiune, $utilizatori);
                          while ($lista_utilizatori = mysqli_fetch_field($ruleaza)) {
                         
                            echo "<option>$lista_utilizatori->name</option>";
                          }
                        ?>
                      </select>
                  </td>
              </tr>
              
              
              <tr>
                  <td align="right"><b>Poza articol:</b></td>
                  <td><input type="file" name="poza_articol" /></td>
              </tr>

              <tr>
                  <td align="right"><b>Continutul articolului:</b></td>
                  <td>
                    <textarea name="continut_articol" rows="10" cols="20"></textarea>
                  </td>
              </tr>
              
			   <tr>
                  <td colspan="7"><input type="submit" name="insereaza_articol" value="Adauga articol" /></td>
              </tr>
          </table>
        </form>
    </script>
  </body>
</html>
<?php
  if(isset($_POST['insereaza_articol'])) {

    $titlu_subiect = $_POST['titlu_subiect'];
    $categorie_subiect = $_POST['categorie_subiect'];
    $continut_articol = $_POST['continut_articol'];
    
    $data_actuala = new DateTime();
    $data_publicarii = $data_actuala->format('Y-m-d H:i:s');

    
    $utilizator = $_POST['utilizator'];

    $folder_poze  = $_SERVER['DOCUMENT_ROOT'].'/poze/';

	$poza_articol = $_FILES['poza_articol']['name'];
	$poza_articol_tmp = $_FILES['poza_articol']['tmp_name'];
    	
	if(move_uploaded_file($poza_articol_tmp,"$folder_poze/$poza_articol")) {
      echo "File uploaded succesfull!";
    } else {
      echo "Failed to upload";
    }
    $insereaza_articol = "insert into inserare_stire
    (titlu, categorie, continut, data_publicarii, utilizator, poza) values
    ('$titlu_subiect','$categorie_subiect','$continut_articol','$data_publicarii','$utilizator','$poza_articol')";
    
    $inserare = mysqli_query($conexiune, $insereaza_articol);
    if($inserare) {
      echo "<script>alert('Articolul a fost adaugat pe site!')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
    else {
        echo "eroare";
    }
  }
 ?>