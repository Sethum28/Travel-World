<?php
class Slider {
    // Class implementation

    public $id;
    public $title;
    public $image;
    public $created_at;
    
    

// constructor to initialize the Admin object with data from the database if an ID is provided
    public function __construct($id = null)
    {
        if ($id) {

           $query = "SELECT * FROM 'slider' WHERE id = " . (int)$id;
        
           $db = Database::getInstance();
           $result = mysqli_fetch_array($db->readQuery($query));

           if ($result) {
               $this->id = $result['id'];
               $this->title = $result['title'];
               $this->image = $result['image'];
               $this->created_at = $result['created_at'];
              
            }
        }
    }

    //create funtion
    public function create() {
        $query = "INSERT INTO `slider` (`title`, `image`, `created_at`) VALUES ('" .
         $this->title . "', '" . $this->image . "', '" . $this->created_at . "')";
        
        $db = Database::getInstance();
        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return false;
        }
    }

    //get all
      public function all()
    {

        $query = "SELECT * FROM `slider` ORDER BY name ASC";
        $db = Database::getInstance();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }



 // Delete a bank record by ID
    public function delete()
    {
        $query = "DELETE FROM `slider` WHERE `id` = '" . $this->id . "'";
        $db = Database::getInstance();
        return $db->readQuery($query);
    }

     // Update an existing bank record
    public function update()
    {
        $query = "UPDATE `slider` SET
            `type_name` = '$this->title',
            `description` = '$this->image'
            `created_at` = '$this->created_at'
            WHERE `id` = '$this->id'";
 

        $db = Database::getInstance();
        $result = $db->readQuery($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
?>