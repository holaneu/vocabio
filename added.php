<?php
  include "db_config.php";
  
  //Check connection
  if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
  } 
  
  if (isset($_GET['title'])) {
    $title = strtolower(htmlspecialchars($_GET['title']));    
  } else {
    $title = "";
  }
  if (isset($_GET['synonyms'])) {
    $synonyms = strtolower(htmlspecialchars($_GET['synonyms']));    
  } else {
    $synonyms = "";
  }
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
     
  <title><?php echo $title; ?> - added | Vocabio</title>
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

    $sql = "INSERT INTO phrases (title, synonyms) VALUES ('".$title."', '".$synonyms."')";
    
    if ($title != "") {
      if ($db->query($sql) === TRUE) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $db->error;
      }
    } else {
      echo "Title has to be filled";
    }
    
    $db->close();
    ?> 
       
    
  </div>
</body>
</html> 
