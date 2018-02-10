<?php
  class Song {
    private $connect;
    private $id;

    private $mysqliData;

    private $title;
    private $artistId;
    private $albumId;
    private $genreId;
    private $duration;
    private $path;
    private $albumOrder;
    private $plays;

    public function __construct($connect,$id){
      $this->connect = $connect;
      $this->id = $id;
      $query = mysqli_query($this->connect,"SELECT * FROM songs WHERE id = $this->id");
      $this->mysqliData = mysqli_fetch_assoc($query);

       $this->title = $this->mysqliData['title'];
       $this->artistId = $this->mysqliData['artist'];
       $this->albumId = $this->mysqliData['album'];
       $this->genreId = $this->mysqliData['genre'];
       $this->duration = $this->mysqliData['duration'];
       $this->path = $this->mysqliData['path'];
       $this->albumOrder = $this->mysqliData['albumOrder'];
    }
    public function getID(){
      return $this->id;
    }
    public function getTitle(){
      return $this->title;
    }
    public function getArtist(){
      return new Artist($this->connect,$this->artistId);
    }
    public function getAlbum(){
      return new album($this->connect,$this->albumId);
    }
    public function getGenre(){
      return $this->genreId;
    }
    public function getDuration(){
      return $this->duration;
    }
    public function getPath(){
      return $this->path;
    }
    public function getAlbumOrder(){
      return $this->albumOrder;
    }
  }
?>
