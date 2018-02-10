<?php
  class Artist{
    private $id;
    private $connect;

    public function __construct($connect,$id){
      $this->connect = $connect;
      $this->id = $id;
    }
    
    public function getName(){
      $artistQuery = mysqli_query($this->connect,"SELECT * FROM artist WHERE id = $this->id");
      $artist = mysqli_fetch_array($artistQuery);
      return $artist['name'];
    }
    public function getId(){
      return $this->id;
    }
    public function getSongId(){
      $query = mysqli_query($this->connect,"SELECT id FROM songs WHERE artist = $this->id ORDER BY plays ASC");
      $array = array();
      while($row = mysqli_fetch_array($query)){
        array_push($array,$row['id']);
      }
      return $array;
    }
  }

?>
