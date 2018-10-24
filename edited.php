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
  if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);    
  } else {
    $id = "";
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
     
  <title><?php echo $title; ?> - edited | Vocabio</title>
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
    //$sql = "INSERT INTO phrases (title, synonyms) VALUES ('".$title."', '".$synonyms."')";
    $sql = "UPDATE phrases SET title='".$title."', synonyms='".$synonyms."' WHERE id=".$id;
    
    if ($title != "") {
            
      //$result = $db->query($sql);
      //if ($result === TRUE) {
      if ($db->query($sql) === TRUE) {
          echo "Record edited successfully";
      } else {
          echo "Error: " . $sql . "<br>" . $db->error;
      }
      //restul->close();
    } else {
      echo "Title has to be filled";
    }
    
    $db->close();
    ?> 
       
    
  </div>
</body>
</html> 
