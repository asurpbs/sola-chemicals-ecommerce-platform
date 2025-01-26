<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Branch {
    private $branch_id;
    private $address1;
    private $address2;
    private $latitude;
    private $longitude;
    private $email;
    private $city_id;
    private $admin_id;
    private $date_created;
    private $telephone1;
    private $telephone2;

    /**
     * Constructor to create a new branch or retrieve an existing branch.
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create an instance of Branch by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new branch
     *      eg - new Branch(null, "576/2", "Siyambalape Road", "6.9745769", "79.4002846", "hei@sola.com", 501, 1, "0112401709", "")
     *  2) first argument is filled and rest are null - to retrieve data from database and create a new branch 
     *      when the branch already exists.
     *      eg - new Branch(1)
     * 
     * @param int|null $branch_id Branch ID
     * @param string|null $address1 Address line 1
     * @param string|null $address2 Address line 2
     * @param string|null $latitude Latitude
     * @param string|null $longitude Longitude
     * @param string|null $email Email
     * @param int|null $city_id City ID
     * @param int|null $admin_id Admin ID
     * @param string|null $telephone1 Telephone 1
     * @param string|null $telephone2 Telephone 2
     */
    public function __construct($branch_id = null, $address1 = null, $address2 = null, $latitude = null, $longitude = null, $email = null, $city_id = null, $admin_id = null, $telephone1 = null, $telephone2 = null) {
        global $conn;
        if ($branch_id === null) {
            $this->address1 = $address1;
            $this->address2 = $address2;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->email = $email;
            $this->city_id = $city_id;
            $this->admin_id = $admin_id;
            $this->telephone1 = $telephone1;
            $this->telephone2 = $telephone2;

            // Insert branch data
            $stmt = $conn->prepare("INSERT INTO branch (address1, address2, latitude, longitude, email, city_id, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $this->address1);
            $stmt->bindValue(2, $this->address2);
            $stmt->bindValue(3, $this->latitude);
            $stmt->bindValue(4, $this->longitude);
            $stmt->bindValue(5, $this->email);
            $stmt->bindValue(6, $this->city_id);
            $stmt->bindValue(7, $this->admin_id);
            $stmt->execute();
            $this->branch_id = $conn->lastInsertId();
            $stmt = null;

            // Insert telephone data
            $stmt = $conn->prepare("INSERT INTO branch_telephone (branch_id, number1, number2) VALUES (?, ?, ?)");
            $stmt->bindValue(1, $this->branch_id);
            $stmt->bindValue(2, $this->telephone1);
            $stmt->bindValue(3, $this->telephone2);
            $stmt->execute();
            $stmt = null;

            // Retrieve date created
            $stmt = $conn->prepare("SELECT date_created FROM branch WHERE id = ?");
            $stmt->bindValue(1, $this->branch_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->date_created);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        } else {
            $this->branch_id = $branch_id;

            // Retrieve branch data
            $stmt = $conn->prepare("SELECT address1, address2, latitude, longitude, email, city_id, admin_id, date_created FROM branch WHERE id = ?");
            $stmt->bindValue(1, $this->branch_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->address1);
            $stmt->bindColumn(2, $this->address2);
            $stmt->bindColumn(3, $this->latitude);
            $stmt->bindColumn(4, $this->longitude);
            $stmt->bindColumn(5, $this->email);
            $stmt->bindColumn(6, $this->city_id);
            $stmt->bindColumn(7, $this->admin_id);
            $stmt->bindColumn(8, $this->date_created);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;

            // Retrieve telephone data
            $stmt = $conn->prepare("SELECT number1, number2 FROM branch_telephone WHERE branch_id = ?");
            $stmt->bindValue(1, $this->branch_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->telephone1);
            $stmt->bindColumn(2, $this->telephone2);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    /**
     * Update the address line 1 of the branch.
     * 
     * @param string $address1 Address line 1
     */
    public function updateAddress1($address1) {
        global $conn;
        $this->address1 = $address1;
        $stmt = $conn->prepare("UPDATE branch SET address1 = ? WHERE id = ?");
        $stmt->bindValue(1, $this->address1);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the address line 2 of the branch.
     * 
     * @param string $address2 Address line 2
     */
    public function updateAddress2($address2) {
        global $conn;
        $this->address2 = $address2;
        $stmt = $conn->prepare("UPDATE branch SET address2 = ? WHERE id = ?");
        $stmt->bindValue(1, $this->address2);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the latitude of the branch.
     * 
     * @param string $latitude Latitude
     */
    public function updateLatitude($latitude) {
        global $conn;
        $this->latitude = $latitude;
        $stmt = $conn->prepare("UPDATE branch SET latitude = ? WHERE id = ?");
        $stmt->bindValue(1, $this->latitude);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the longitude of the branch.
     * 
     * @param string $longitude Longitude
     */
    public function updateLongitude($longitude) {
        global $conn;
        $this->longitude = $longitude;
        $stmt = $conn->prepare("UPDATE branch SET longitude = ? WHERE id = ?");
        $stmt->bindValue(1, $this->longitude);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the email of the branch.
     * 
     * @param string $email Email
     */
    public function updateEmail($email) {
        global $conn;
        $this->email = $email;
        $stmt = $conn->prepare("UPDATE branch SET email = ? WHERE id = ?");
        $stmt->bindValue(1, $this->email);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the city ID of the branch.
     * 
     * @param int $city_id City ID
     */
    public function updateCityId($city_id) {
        global $conn;
        $this->city_id = $city_id;
        $stmt = $conn->prepare("UPDATE branch SET city_id = ? WHERE id = ?");
        $stmt->bindValue(1, $this->city_id);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the admin ID of the branch.
     * 
     * @param int $admin_id Admin ID
     */
    public function updateAdminId($admin_id) {
        global $conn;
        $this->admin_id = $admin_id;
        $stmt = $conn->prepare("UPDATE branch SET admin_id = ? WHERE id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the first telephone number of the branch.
     * 
     * @param string $telephone1 Telephone 1
     */
    public function updateTelephone1($telephone1) {
        global $conn;
        $this->telephone1 = $telephone1;
        $stmt = $conn->prepare("UPDATE branch_telephone SET number1 = ? WHERE branch_id = ?");
        $stmt->bindValue(1, $this->telephone1);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the second telephone number of the branch.
     * 
     * @param string $telephone2 Telephone 2
     */
    public function updateTelephone2($telephone2) {
        global $conn;
        $this->telephone2 = $telephone2;
        $stmt = $conn->prepare("UPDATE branch_telephone SET number2 = ? WHERE branch_id = ?");
        $stmt->bindValue(1, $this->telephone2);
        $stmt->bindValue(2, $this->branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Delete the branch and all related data.
     */
    public function deleteBranch() {
        global $conn;

        // Delete telephone data
        $stmt = $conn->prepare("DELETE FROM branch_telephone WHERE branch_id = ?");
        $stmt->bindValue(1, $this->branch_id);
        $stmt->execute();
        $stmt = null;

        // Delete branch data
        $stmt = $conn->prepare("DELETE FROM branch WHERE id = ?");
        $stmt->bindValue(1, $this->branch_id);
        $stmt->execute();
        $stmt = null;

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /**
     * Delete a branch by its ID.
     * 
     * @param int $branch_id Branch ID
     */
    public static function deleteBranchById($branch_id) {
        global $conn;

        // Delete telephone data
        $stmt = $conn->prepare("DELETE FROM branch_telephone WHERE branch_id = ?");
        $stmt->bindValue(1, $branch_id);
        $stmt->execute();
        $stmt = null;

        // Delete branch data
        $stmt = $conn->prepare("DELETE FROM branch WHERE id = ?");
        $stmt->bindValue(1, $branch_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Get the address line 1 of the branch.
     * 
     * @return string Address line 1
     */
    public function getAddress1() {
        return $this->address1;
    }

    /**
     * Get the address line 2 of the branch.
     * 
     * @return string Address line 2
     */
    public function getAddress2() {
        return $this->address2;
    }

    /**
     * Get the latitude of the branch.
     * 
     * @return string Latitude
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Get the longitude of the branch.
     * 
     * @return string Longitude
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Get the email of the branch.
     * 
     * @return string Email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get the city name of the branch.
     * 
     * @return string City name
     */
    public function getCity() {
        global $conn;
        $stmt = $conn->prepare("SELECT name_en FROM city WHERE id = ?");
        $stmt->bindValue(1, $this->city_id);
        $stmt->execute();
        $city_name = $stmt->fetchColumn();
        $stmt = null;
        return $city_name;
    }

    /**
     * Get the district name of the branch based on the city ID.
     * 
     * @return string District name
     */
    public function getDistrict() {
        global $conn;
        $stmt = $conn->prepare("SELECT d.name_en FROM district d JOIN city c ON d.id = c.district_id WHERE c.id = ?");
        $stmt->bindValue(1, $this->city_id);
        $stmt->execute();
        $district_name = $stmt->fetchColumn();
        $stmt = null;
        return $district_name;
    }

    /**
     * Get the province name of the branch based on the city ID.
     * 
     * @return string Province name
     */
    public function getProvince() {
        global $conn;
        $stmt = $conn->prepare("SELECT p.name_en FROM province p JOIN district d ON p.id = d.province_id JOIN city c ON d.id = c.district_id WHERE c.id = ?");
        $stmt->bindValue(1, $this->city_id);
        $stmt->execute();
        $province_name = $stmt->fetchColumn();
        $stmt = null;
        return $province_name;
    }

    /**
     * Get the date created of the branch.
     * 
     * @return string Date created
     */
    public function getDateCreated() {
        return $this->date_created;
    }

    /**
     * Get the first telephone number of the branch.
     * 
     * @return string Telephone 1
     */
    public function getTelephone1() {
        return $this->telephone1;
    }

    /**
     * Get the second telephone number of the branch.
     * 
     * @return string Telephone 2
     */
    public function getTelephone2() {
        return $this->telephone2;
    }

    /**
     * Get the branch ID.
     * 
     * @return int Branch ID
     */
    public function getBranchId() {
        return $this->branch_id;
    }

    /**
     * Get the total number of branches.
     * 
     * @return int Total branches
     */
    public static function getTotalBranches() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM branch");
        $stmt->execute();
        $total_branches = $stmt->fetchColumn();
        $stmt = null;
        return $total_branches;
    }

    /**
     * Get all branches as an array of Branch objects.
     * 
     * @return array Array of Branch objects
     */
    public static function getAllBranches() {
        global $conn;
        $branches = [];
        $stmt = $conn->prepare("SELECT id FROM branch");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $branches[] = new self($row['id']);
        }
        $stmt = null;
        return $branches;
    }

    /**
     * Get the count of all branches.
     * 
     * @return int Count of all branches
     */
    public static function getNoOfAllBranches() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM branch");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        $stmt = null;
        return $count;
    }

    /**
     * Use to delete the instance of Branch
     */
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
}
?>
