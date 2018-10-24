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
      
  <title>Vocabio: search results</title>
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
    include "db_config.php";
    
    //Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    
    if (isset($_GET['query']) && $_GET['query'] != "") {
      //get search term
      $searchTerm = htmlspecialchars($_GET['query']); 
      
      //$sql = "SELECT * FROM phrases WHERE id=(SELECT related_to FROM related where id=1)";
      $sql = "SELECT * FROM phrases WHERE title LIKE '%".$searchTerm."%' ORDER BY title ASC";
      $result = $db->query($sql);
      
      if ($result->num_rows > 0) {
        echo "<h1>".$result->num_rows." results for \"".$searchTerm."\"</h1>";
        echo "<ul>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
           echo "<li><a href=\"edit.php?id=".$row["id"]."\">".$row["title"]."</a> <span>".$row["synonyms"]."</span></li>";
        }
        echo "</ul>";
      } else {
          echo "<h1>".$result->num_rows." results for \"".$searchTerm."\"</h1>";
      }
      
      $result->close();
      
    } else {
      echo 'You are requesting emtpy phrase.';
    }
    
    
    
    $db->close();
    
    ?>    
    
  </div>
</body>
</html> 
