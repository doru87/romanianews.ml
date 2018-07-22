<?php
include 'db.php';

$output = '';

if(isset($_POST["query"]))
{
    $cautare = mysqli_real_escape_string($conexiune, $_POST["query"]);
    $interogare = "SELECT * FROM inserare_stire WHERE titlu LIKE '%".$cautare."%' OR continut LIKE '%".$cautare."%'";
}
  else
  {
    $interogare = "SELECT * FROM inserare_stire ORDER BY data_publicarii";
  }
  
    $rezultat = mysqli_query($conexiune, $interogare);

    while($row = mysqli_fetch_array($rezultat))
    {
        $titlu = $row["titlu"];
        $poza = $row["poza"];
        $id = $row["id_articol"];
        
        $output .= '
          <div class="postare_singulara">

              <a href="afisare_articol.php?id_articol='.$id.'">
       
                  <img class="resize_center" src="/poze/'.$poza.'">
              <div class="titlu">
                  <h1>'.$titlu.'</h1>
             </div>
             </a>
           </div>
  ';
    }
    echo $output;



?>