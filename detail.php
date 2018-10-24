<?php
  include "db_config.php";
  
  //Check connection
  if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
  } 
  
  if (isset($_GET['id']) && $_GET['id'] != "") {
    //get search term
    $detailID = htmlspecialchars($_GET['id']);    
    $sql = "SELECT * FROM phrases WHERE id = ".$detailID;
    /*$sql_related = "SELECT phrases.id, phrases.title FROM 
     (SELECT phrases.id, related.phrase_1, related.phrase_2 FROM phrases, related WHERE phrases.id = related.phrase_1 AND phrases.id = ".$detailID.")  as related_list, phrases
      WHERE phrases.id = related_list.phrase_2";*/
    $result = $db->query($sql);           
    if ($result->num_rows > 0) {     
      $row = $result->fetch_all();
      $title = $row[0][1];
      $synonyms = $row[0][2];
      $id = $row[0][0];                 
      //echo "<h1>".$row[0][1]."</h1>";
      //echo "<p>".$row[0][2]."</p>";        
    }
    $result->close();
?>

<!DOCTYPE html>
<html>
<head>
  <?php include "html_head.php"; ?>
  
  <script>
  $(function() {
    $( "#query" ).autocomplete({
        source: 'autocomplete_fulltext.php'
    });
  });
  </script>
  
  <title><?php echo $title; ?> | Vocabio</title>
</head>
 
<body>
  <header>
    <a href="/home.php"><button>Home</button></a>
    <a href="/add.php"><button>Add</button></a>
    <a href="/flashcards.php"><button>Play</button></a>    
    <?php include "searchForm.php"; ?>
  </header>
  
  <div id="content">     
    <?php      
      echo "<h1>".$title."</h1>";
      echo "<p>".$synonyms."</p>";
    ?> 
    <div id="related">      
     <?php      
      /* puvodni kod pro zobrazeni vypisu related frazi k aktualne zobrazene frazi 
      $result2 = $db->query($sql_related);      
      if ($result2->num_rows > 0) {      
        $row2 = $result2->fetch_all();
        echo "<strong>Related (".$result2->num_rows.")</strong>";          
        echo "<ul>"; 
        for ($i = 0; $i < $result2->num_rows; $i++) {
          echo "<li><a href=\"detail.php?id=".$row2[$i][0]."\">".$row2[$i][1]."</a></li>";
        }
        echo "</ul>";
      } else {
          echo "<strong>Related (0)</strong>";
      }
      $result2->close();*/
      
      
    ?>
  </div>
      
      
      
<?php      
  } else {
    echo 'You are requesting empty detail ID.';
  }    
  
  $db->close();    
?> 
  
       
    
  </div>
  <div id="bottom_nav">
     <a href="/edit.php?id=<?php echo $id; ?>"><button>Edit</button></a>
  </div>
</body>
</html> 
