<?php
    include "db_config.php";
    
    //get search term
    //if GET param exists
    if (isset($_GET['term'])) {
      $searchTerm = htmlspecialchars($_GET['term']);
      //get matched data from table
      $query = $db->query("SELECT * FROM phrases WHERE title LIKE '%".$searchTerm."%' ORDER BY title ASC LIMIT 6");
      while ($row = $query->fetch_assoc()) {
          $data[] = $row['title'];
      }
    
      //return json data
      header("Content-type: application/json;charset=utf8");
      echo json_encode($data);
    }   
    
    
?>