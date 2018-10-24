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
  <title>Vocabio</title>
</head>
 
<body>
  <div id="header">
    <a href="/add.php"><button>Add</button></a>
    <a href="/flashcards.php"><button>Play</button></a>
    <?php include "searchForm.php"; ?>
  </div>
  
  <div id="content">
    <?php
      include "db_config.php";
      
      // Check connection
      if ($db->connect_error) {
          die("Connection failed: " . $db->connect_error);
      } 
      
      //$sql = "SELECT * FROM phrases WHERE id=(SELECT related_to FROM related where id=1)";
      $sql = "SELECT * FROM phrases";
      $result = $db->query($sql);
      
      if ($result->num_rows > 0) {
          echo "<ul>";
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<li><a href=\"edit.php?id=".$row["id"]."\">".$row["title"]."</a> <span>".$row["synonyms"]."</span></li>";
          }
          echo "</ul>";
      } else {
          echo "0 results";
      }
      $result->close();
      
      $db->close();    
    ?>
  </div>
</body>
</html>