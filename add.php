<!DOCTYPE html>
<html>
<head>
  <?php include "html_head.php"; ?>
  
  <script>
  $(function() {
    $( "#title" ).autocomplete({
        source: 'autocomplete_fulltext.php'
    });
  });
  </script>
     
  <title>Add new | Vocabio</title>
</head>
 
<body>
  <header>
    <a href="/home.php"><button>Home</button></a>
    <a href="/flashcards.php"><button>Play</button></a>
  </header>
  
  <div id="content">     
    <form id="addForm" action="added.php" method="GET">
      <div class="ui-widget">
        <input type="text" name="title" id="title" placeholder="Title" autofocus><br>
        <input type="text" name="synonyms" id="synonyms" placeholder="Synonyms"><br>
        <input type="submit" id="btn_submit" value="Save">
     </div> 
    </form>      
    
  </div>
  
</body>
</html> 
