<?php
  include "db_config.php";
  
  //Check connection
  if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
  }  
    
  $allIDs_sql = "SELECT id FROM phrases";    
  $allIDs = $db->query($allIDs_sql);
  $allIDs_array = $allIDs->fetch_all();
  $allIDs_length = $allIDs->num_rows;
  $rand_num = mt_rand(0,$allIDs_length-1);
  $rand_selectedID = $allIDs_array[$rand_num][0];
  $allIDs->close();
  
  
  $randDetail_sql = "SELECT id, title, synonyms FROM phrases WHERE id=".$rand_selectedID." LIMIT 10";
  $randDetail = $db->query($randDetail_sql);           
  if ($randDetail->num_rows > 0) {     
    $fetched_rows = $randDetail->fetch_all();
    $title = $fetched_rows[0][1];
    $synonyms = $fetched_rows[0][2];
    $id = $fetched_rows[0][0];                         
  }
  $randDetail->close();
  
  $db->close();  
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
  
  <title>Flashcards | Vocabio</title>
</head>
 
<body>
  <header>
    <a href="/home.php"><button>Home</button></a>
    <a href="/add.php"><button>Add</button></a>    
    <?php include "searchForm.php"; ?>
  </header>
  
  <div id="content">
         
    <?php            
      echo "<h1>".$title."</h1>";
      echo "<p>".$synonyms."</p>";
    ?>       
    
  </div>
  
  <div id="bottom_nav">
     <a href="/edit.php?id=<?php echo $id; ?>"><button>Edit</button></a>     
     <a href="/flashcards.php"><button>Next</button></a>
  </div>
  
</body>
</html> 