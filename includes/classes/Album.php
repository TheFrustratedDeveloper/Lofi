<?php
  class Album{
    private $id;
    private $connect;

    private $title;
    private $artistId;
    private $genreId;
    private $artworkPath;

    public function __construct($connect,$id){
      $this->connect = $connect;
      $this->id = $id;
      $query = mysqli_query($this->connect,"SELECT * FROM album WHERE id = $this->id");
      $album = mysqli_fetch_array($query);

      $this->title = $album['title'];
      $this->artistId = $album['artist'];
      $this->genreId = $album['genre'];
      $this->artworkPath = $album['artworkPath'];

    }
    public function getNumberOfSongs(){
      $query = mysqli_query($this->connect,"SELECT * FROM songs WHERE album = $this->id");
      return mysqli_num_rows($query);
    }
    public function getTitle(){
      return $this->title;
    }
    public function getArtist(){
      //returning whole artist object
      return new Artist($this->connect,$this->artistId);
    }
    public function getArtwork(){
      return $this->artworkPath;
    }
    public function getGenre(){
      return $this->genreId;
    }
    public function getSongId(){
      $query = mysqli_query($this->connect,"SELECT id FROM songs WHERE album = $this->id ORDER BY albumOrder ASC");
      $array = array();
      while($row = mysqli_fetch_array($query)){
        array_push($array,$row['id']);
      }
      return $array;
    }
  }
 ?>
