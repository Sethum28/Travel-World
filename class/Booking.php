<?php
class Booking {
    // Class implementation

    public $id;
    public $name;
    public $email;
    public $mobile;
    public $country;
    public $package_name;
    public $airport_pickup;
    public $arrival_date;
    public $departure_date;
    public $adults;
    public $children;
    public $message;
    public $booking_date;
    

// constructor to initialize the Admin object with data from the database if an ID is provided
    public function __construct($id = null)
    {
        if ($id) {

           $query = "SELECT * FROM 'booking' WHERE id = " . (int)$id;
        
           $db = Database::getInstance();
           $result = mysqli_fetch_array($db->readQuery($query));

           if ($result) {
               $this->id = $result['id'];
               $this->name = $result['name'];
               $this->email = $result['email'];
               $this->mobile = $result['mobile'];
               $this->country = $result['country'];
               $this->package_name = $result['package_name'];
               $this->airport_pickup = $result['airport_pickup'];
               $this->arrival_date = $result['arrival_date'];
               $this->departure_date = $result['departure_date'];
               $this->adults = $result['adults'];
               $this->children = $result['children'];
               $this->message = $result['message'];
               $this->booking_date = $result['booking_date'];
               
            
               

            }
        }
    }

    //create funtion
    public function create() {
        $query = "INSERT INTO `booking` (`name`, `email`, `mobile`, `country`, `package_name`, `airport_pickup`, `arrival_date`, `departure_date`, `adults`, `children`, `message`, `booking_date`) VALUES ('" .
         $this->name . "', '" . $this->email . "', '" . $this->mobile . "', '" . $this->country . "', '" . $this->package_name . "', '" . $this->airport_pickup . "', '" . $this->arrival_date . "', '" . $this->departure_date . "', '" . $this->adults . "', '" . $this->children . "', '" . $this->message . "', '" . $this->booking_date . "')";
        
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

        $query = "SELECT * FROM `booking` ORDER BY name ASC";
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
        $query = "DELETE FROM `booking` WHERE `id` = '" . $this->id . "'";
        $db = Database::getInstance();
        return $db->readQuery($query);
    }

     // Update an existing bank record
    public function update()
    {
        $query = "UPDATE `packages` SET
            `name` = '$this->name'
            `email` = '$this->email'
            `mobile` = '$this->mobile'
            `country` = '$this->country'
            `package_name` = '$this->package_name'
            `airport_pickup` = '$this->airport_pickup'
            `arrival_date` = '$this->arrival_date'
            `departure_date` = '$this->departure_date'
            `adults` = '$this->adults'
            `children` = '$this->children'
            `message` = '$this->message'
            `booking_date` = '$this->booking_date'
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