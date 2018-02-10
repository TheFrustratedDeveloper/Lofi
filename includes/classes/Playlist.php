<?php 
	class Playlist{
	    private $connect;
	    private $id;
	    private $name;
	    private $owner;

	    public function __construct($connect, $data){
	    	if(!(is_array($data))){
	    		$query = mysqli_query($connect,"SELECT * FROM playlists WHERE id = $data");
	    		$data = mysqli_fetch_array($query);
	    	}
	      $this->connect = $connect;
	      $this->id = $data['id'];
	      $this->name = $data['name'];
	      $this->owner = $data['owner'];
	    }

	    public function getId(){
	    	return $this->id;
	    }
	    public function getName(){
	    	return $this->name;
	    }
	    public function getOwner(){
	    	return $this->owner;
	    }
	    public function getNumberofSongs(){
	    	$query = mysqli_query($this->connect,"SELECT songId FROM playlistsongs WHERE playlistid = $this->id ");
	    	return mysqli_num_rows($query);
	    }
		public function getSongId(){
			$query = mysqli_query($this->connect,"SELECT songId FROM playlistsongs WHERE playlistid = $this->id ORDER BY playlistOrder ASC");
			$array = array();
			while($row = mysqli_fetch_array($query)){
				array_push($array,$row['songId']);
			}
			return $array;
		}
		public static function getPlaylistDropdown($connect,$username){
			$dropdown = "
				<select name='' id='' class='item playlist'>
				<option value='' hidden selected>Add to Playlist</option>";

			$query = mysqli_query($connect,"SELECT id, name FROM playlists WHERE owner = '$username' ");
			while($row = mysqli_fetch_array($query)){
				$id = $row['id'];
				$name = $row['name'];

				$dropdown = $dropdown . "<option class='item' value='$id'>$name</option>";
			}	
			return $dropdown."</select>";
		}
	}

?>