<?php
include 'functii.php';
include 'db.php';

$query = "select * from utilizatori_inscrisi where lastActiveTime > NOW()-10";
$rezultat = mysqli_query($conexiune, $query);
$count = mysqli_num_rows($rezultat);
$output = "";
while($row=mysqli_fetch_array($rezultat))
{
    $output .= '
  <div class="table-responsive">
  <form method="post" action="dezactiveaza_utilizatori.php" onsubmit="return post();"> 
   <table class="tabel">
    <tr>
     <th>Id utilizator</th>
     <th>Adresa de email</th>
     <th>Imagine profil</th>
     <th>Activeaza utilizator</th>
     <th>Dezactiveaza utilizator</th>
    </tr>
  ';
    
    foreach($rezultat as $row)
    {
        $poza_profil=$row["poza_profil"];
        $id_utilizator=$row["id_utilizator"];
        $output .= '
   <tr>
    <td><a href="vizualizare_profil_utilizatori.php?id_utilizator='.$id_utilizator.'">'.$id_utilizator.'</a></td>
    <td>'.$row["email_utilizator"].'</td>
    <td><img src="data:image/png;base64,'.$poza_profil.'" class="img-thumbnail" width="50" height="50" /></td>
    <input type="hidden" name="id_utilizator" id="id_utilizator" value='.$id_utilizator.'/>
    <td><input type="submit" name="submit1" id="submit1" value="Activare"/></td>
    <td><input type="submit" name="submit2" id="submit2" value="Dezactivare"/></td>
   </tr>
   ';
    }
    $output .= '</table></form></div>';
    }
echo $output;


?>

<script type="text/javascript">
function post() {

	/* event.preventDefault(); stop form from submitting normally */
	/* get the action attribute from the <form action=""> element */
 /* var $form = $(this);
    var input = $form.find('input[name="submit"]').val();
    var url = $form.attr('action');
	document.write(url);*/
	var id_utilizator = document.getElementById("id_utilizator").value;
	if(id_utilizator!=""){
    $.ajax({
           type: "POST",
           url: "dezactiveaza_utilizatori.php",
           data: {id_utilizator:id_utilizator},
           success: function(data)
           {
             
           }
         });

	}
}

</script>

	  