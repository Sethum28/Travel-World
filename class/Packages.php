<?php
class Packages {
    // Class implementation

    public $id;
    public $title;
    public $subtitle;
    public $type;
    public $color;
    public $image;
    public $price;
    public $highlights;
    public $itinerary;
    public $created_at;
    

// constructor to initialize the Admin object with data from the database if an ID is provided
    public function __construct($id = null)
    {
        if ($id) {

           $query = "SELECT * FROM 'packages' WHERE id = " . (int)$id;
        
           $db = Database::getInstance();
           $result = mysqli_fetch_array($db->readQuery($query));

           if ($result) {
               $this->id = $result['id'];
               $this->title = $result['title'];
               $this->subtitle = $result['subtitle'];
               $this->type = $result['type'];
               $this->color = $result['color'];
               $this->image = $result['image'];
               $this->price = $result['price'];
               $this->highlights = $result['highlights'];
               $this->itinerary = $result['itinerary'];
               $this->created_at = $result['created_at'];
               
            
               

            }
        }
    }

    //create funtion
    public function create() {
        $query = "INSERT INTO `packages` (`title`, `subtitle`, `type`, `color`, `image`, `price`, `highlights`, `itinerary`, `created_at`) VALUES ('" .
         $this->title . "', '" . $this->subtitle . "', '" . $this->type . "', '" . $this->color . "', '" . $this->image . "', '" . $this->price . "', '" . $this->highlights . "', '" . $this->itinerary . "', '" . $this->created_at . "')";
        
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

        $query = "SELECT * FROM `packages` ORDER BY name ASC";
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
        $query = "DELETE FROM `packages` WHERE `id` = '" . $this->id . "'";
        $db = Database::getInstance();
        return $db->readQuery($query);
    }

     // Update an existing bank record
    public function update()
    {
        $query = "UPDATE `packages` SET
            `title` = '$this->title'
            `subtitle` = '$this->subtitle'
            `type` = '$this->type'
            `color` = '$this->color'
            `image` = '$this->image'
            `price` = '$this->price'
            `highlights` = '$this->highlights'
            `itinerary` = '$this->itinerary'
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