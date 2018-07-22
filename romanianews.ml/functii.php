<?php
include 'db.php';
session_start();

function obtine_articole(){
    $output='';
    global $conexiune;
    
    if (isset($_GET['categorie'])){
     
        
        $interogare = "SELECT * FROM inserare_stire WHERE categorie='".$_GET['categorie']."'";
        $rezultat = mysqli_query($conexiune, $interogare);
        
        while($row = mysqli_fetch_array($rezultat)) {
            $titlu = $row["titlu"];
            $poza = $row["poza"];
            $id = $row["id_articol"];
            
            
            $output .= '<div class="postare_singulara">
                
                <a href="afisare_articol.php?id_articol='.$id.'">
                    
                <div class="resize_center" style="background-image:url(poze/'.$poza.');"></div>
                <div class="titlu">    
                    <h1>'.$titlu.'</h1>
                </div>  
                 </a>
                 </div>';
        }
        echo $output;
    }else{
        $limit = 9;
        if (isset($_GET["page"])) { 
            $page  = $_GET["page"]; 
        } else { 
            $page=1; 
        };
        $start_from = ($page-1) * $limit;
        
        $interogare = "SELECT * FROM inserare_stire ORDER BY data_publicarii DESC LIMIT $start_from, $limit";
        $rezultat = mysqli_query($conexiune, $interogare);
        
        while($row = mysqli_fetch_array($rezultat)) {
            $titlu = $row["titlu"];
            $poza = $row["poza"];
            $id = $row["id_articol"];
            
            
            echo'<div class="postare_singulara">
                
        <a href="afisare_articol.php?id_articol='.$id.'">
                
       <div class="resize_center" style="background-image:url(poze/'.$poza.');"></div>
         <div class="titlu">       
            <h1>'.$titlu.'</h1>
         </div>  
           
        </a>
        </div>';
            
        }
     
        
        $interogare = "SELECT COUNT(id_articol) FROM inserare_stire";
        $rezulatat = mysqli_query($conexiune, $interogare);
        $row = mysqli_fetch_row($rezulatat);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);
        $pagLink = "<div class='pagination'>";
        for ($i=1; $i<=$total_pages; $i++) {
            $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>";
        };
        echo $pagLink . "</div>"; 
    }
    

}

function afiseaza_articol(){
    global $conexiune;
    
    if (isset($_GET['id_articol'])){
        $id = $_GET['id_articol'];
        
        $interogare = "SELECT * FROM inserare_stire where id_articol=$id";
        $rezultat = mysqli_query($conexiune, $interogare);
    
    while($row = mysqli_fetch_array($rezultat)) {
        $titlu = $row["titlu"];
        $poza = $row["poza"];
        $continut = $row["continut"];
        $_SESSION["categorie"]=$row["categorie"];
        
        $data_publicarii = date('j F, Y', strtotime($row["data_publicarii"]));
        echo " <div class='postare_articol'>
        
      
       <img class='resize_left' src='/poze/$poza'>
       
       <h1>$titlu</h1>
       
       <p>$continut</p>
       <p class='data_postarii'>$data_publicarii</p>
       
        </div>
       
   ";
    }
}
}

function afiseaza_comentarii(){
    global $conexiune;

        $id = $_GET['id_articol'];
    
    
    $query = "SELECT * FROM comentarii_utilizatori WHERE id_articol LIKE '%$id%' order by data_postare asc";
    $rezultat=mysqli_query($conexiune,$query);
    
    while($row=mysqli_fetch_array($rezultat))
    {
        $nume=$row['nume'];
        $comentariu=$row['comentariu'];
        $email=$row['email'];
        $data_postare=$row['data_postare'];
        
        
        echo "<ul class='commentlist'>
            <li class='comment'>
              <div class='author'><img class='avatar' src='data:image/png;base64,' width='32' height='32' alt='' />
                 <span class='name'><a href='#'>$nume</a></span> <span class='wrote'>wrote:</span></div>
              <div class='submitdate'><a href='#'>$data_postare</a></div>
              <p>$comentariu</p>
            </li>
             ".sterge_comentariu_administrator()."
            </ul>";
      
        }
}       
   function sterge_comentariu_administrator(){
       if (isset($_GET['id_articol'])){
           $id = $_GET['id_articol'];
       }
        $query = "SELECT * FROM comentarii_utilizatori WHERE id_articol LIKE '%$id%'";
    $rezultat=mysqli_query($conexiune,$query);
    
    while($row=mysqli_fetch_array($rezultat))
    {
        $hash=$row['comment_hash'];
    }
       if(isset($_SESSION['administrator'])){
           echo "<div class='delete_comment'>
			    <a href='sterge_comentariu.php?id_articol=$id&hash=$hash'style='background-color: #008CBA;padding: 15px 32px; cursor: pointer; text-decoration: none;color: white;'>Sterge comentariu</a>
			   </div>";
   }
   }
        function incarcare_poza_utilizator(){
            
   
            global $conexiune; 
 
            if(isset($_POST['submit']))
            {
                  if(isset($_SESSION['id_utilizator'])){
            $id_utilizator = $_SESSION['id_utilizator'];
    
                $imagine = $_FILES['imagine']['tmp_name'];
                $nume = $_FILES['imagine']['name'];
                $continut_imagine = file_get_contents($imagine);
                $encodare_imagine = base64_encode($continut_imagine);
                
                $query ="UPDATE utilizatori_inscrisi SET poza_profil=$encodare_imagine WHERE id_utilizator=$id_utilizator";
                $result = mysqli_query($conexiune, $query);
                
            }
            
                    }
            $query1 = "SELECT * FROM utilizatori_inscrisi WHERE id_utilizator='$id_utilizator'";
            $result1 = mysqli_query($conexiune, $query1);
            while($row = mysqli_fetch_array($result1)){
                
                $poza_profil = $row['poza_profil'];
                echo '<img src="data:image/png;base64,'.$poza_profil.'"/>';
                
                
            }

        }
       
              
              function schimbare_parola(){
               
                  global $conexiune;
                  $id_utilizator = $_SESSION['id_utilizator'];
                  
                  if(isset($_POST['submit_parola'])){
               
                      $parola_veche = $_POST['parola_veche'];
                      $parola_noua = $_POST['parola_noua'];
                      
                      $query1 ="SELECT * FROM utilizatori_inscrisi WHERE id_utilizator=$id_utilizator";
                      $result1 = mysqli_query($conexiune, $query1);
                      
                      
                      if (mysqli_affected_rows($conexiune)>0){
                          while($row = mysqli_fetch_array($result1)){
                              $old_password = $row['parola_utilizator'];
                              
                              if ($parola_veche==$old_password) {
                                  $query2 = "UPDATE utilizatori_inscrisi SET parola_utilizator=$parola_noua WHERE id_utilizator=$id_utilizator";
                                  $result2 = mysqli_query($conexiune, $query2);
                                  
                                  if ($result2){
                                      if (mysqli_affected_rows($conexiune)>0){
                                          echo '<p>'.'Parola a fost schimbata'.'</p>';
                                          
                                      }else{
                                          echo '<p>'.'Parola nu a fost schimbata'.'</p>';
                                          
                                      }
                                  }
                              }
                              
                          }
                      }
                  }
              }
              
?>