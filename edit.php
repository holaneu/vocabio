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
    $result = $db->query($sql);           
    if ($result->num_rows > 0) {     
      $row = $result->fetch_all();
      $title = $row[0][1];
      $synonyms = $row[0][2];
      $id = $row[0][0];                         
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
    $( "#title" ).autocomplete({
        source: 'autocomplete_fulltext.php'
    });
  });
  </script>
  
  <title><?php echo $title; ?> - edit | Vocabio</title>
</head>
 
<body>
  <header>
    <a href="/home.php"><button>Home</button></a>
    <a href="/add.php"><button>Add</button></a>
    <a href="/flashcards.php"><button>Play</button></a>    
    <?php include "searchForm.php"; ?>
  </header>
  
  <div id="content">     
    <form id="addForm" action="edited.php" method="GET">
      <div class="ui-widget">
        <input type="text" name="title" id="title" value="<?php echo $title; ?>" autofocus><br>
        <input type="text" name="synonyms" id="synonyms" value="<?php echo $synonyms; ?>"><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" id="btn_submit" value="Save">
     </div> 
    </form> 
      
      
<?php      
  } else {
    echo 'You are editing empty detail ID.';
  }    
  
  $db->close();    
?>      
    
  </div>
</body>
</html> 
