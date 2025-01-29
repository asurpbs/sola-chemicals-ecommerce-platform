<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Company {
    private $admin_id;
    private $address1;
    private $address2;
    private $city;
    private $email;
    private $facebook_url;
    private $instagram;
    private $daraz;
    private $whatsapp;
    private $youtube;
    private $tele_number1;
    private $tele_number2;

    /**
     * Constructor to retrieve company contact information.
     * 
     */
    public function __construct() {
        global $conn;
        $this->admin_id = 1;

        // Retrieve company contact info
        $stmt = $conn->prepare("SELECT address1, address2, city, email, facebook_url, instagram, daraz, whatsapp, youtube, tele_number1, tele_number2 FROM company_contact_info WHERE admin_id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->execute();
        $stmt->bindColumn(1, $this->address1);
        $stmt->bindColumn(2, $this->address2);
        $stmt->bindColumn(3, $this->city);
        $stmt->bindColumn(4, $this->email);
        $stmt->bindColumn(5, $this->facebook_url);
        $stmt->bindColumn(6, $this->instagram);
        $stmt->bindColumn(7, $this->daraz);
        $stmt->bindColumn(8, $this->whatsapp);
        $stmt->bindColumn(9, $this->youtube);
        $stmt->bindColumn(10, $this->tele_number1);
        $stmt->bindColumn(11, $this->tele_number2);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
    }

    /**
     * Update the address of the company.
     * 
     * @param string $address1 Address line 1
     * @param string $address2 Address line 2
     * @param string $city City
     */
    public function updateAddress($address1, $address2, $city) {
        global $conn;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $stmt = $conn->prepare("UPDATE company_contact_info SET address1 = ?, address2 = ?, city = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->address1);
        $stmt->bindValue(2, $this->address2);
        $stmt->bindValue(3, $this->city);
        $stmt->bindValue(4, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the contact details of the company.
     * 
     * @param string $email Email
     * @param string $tele_number1 Telephone number 1
     * @param string $tele_number2 Telephone number 2
     */
    public function updateContactDetails($email, $tele_number1, $tele_number2) {
        global $conn;
        $this->email = $email;
        $this->tele_number1 = $tele_number1;
        $this->tele_number2 = $tele_number2;
        $stmt = $conn->prepare("UPDATE company_contact_info SET email = ?, tele_number1 = ?, tele_number2 = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->email);
        $stmt->bindValue(2, $this->tele_number1);
        $stmt->bindValue(3, $this->tele_number2);
        $stmt->bindValue(4, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the social media links of the company.
     * 
     * @param string $facebook_url Facebook URL
     * @param string $instagram Instagram URL
     * @param string $daraz Daraz URL
     * @param string $whatsapp WhatsApp number
     * @param string $youtube YouTube URL
     */
    public function updateSocialMedia($facebook_url, $instagram, $daraz, $whatsapp, $youtube) {
        global $conn;
        $this->facebook_url = $facebook_url;
        $this->instagram = $instagram;
        $this->daraz = $daraz;
        $this->whatsapp = $whatsapp;
        $this->youtube = $youtube;
        $stmt = $conn->prepare("UPDATE company_contact_info SET facebook_url = ?, instagram = ?, daraz = ?, whatsapp = ?, youtube = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->facebook_url);
        $stmt->bindValue(2, $this->instagram);
        $stmt->bindValue(3, $this->daraz);
        $stmt->bindValue(4, $this->whatsapp);
        $stmt->bindValue(5, $this->youtube);
        $stmt->bindValue(6, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the first address line of the company.
     * 
     * @param string $address1 Address line 1
     */
    public function updateAddress1($address1) {
        global $conn;
        $this->address1 = $address1;
        $stmt = $conn->prepare("UPDATE company_contact_info SET address1 = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->address1);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the second address line of the company.
     * 
     * @param string $address2 Address line 2
     */
    public function updateAddress2($address2) {
        global $conn;
        $this->address2 = $address2;
        $stmt = $conn->prepare("UPDATE company_contact_info SET address2 = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->address2);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the city of the company.
     * 
     * @param string $city City
     */
    public function updateCity($city) {
        global $conn;
        $this->city = $city;
        $stmt = $conn->prepare("UPDATE company_contact_info SET city = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->city);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the email of the company.
     * 
     * @param string $email Email
     */
    public function updateEmail($email) {
        global $conn;
        $this->email = $email;
        $stmt = $conn->prepare("UPDATE company_contact_info SET email = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->email);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the Facebook URL of the company.
     * 
     * @param string $facebook_url Facebook URL
     */
    public function updateFacebookUrl($facebook_url) {
        global $conn;
        $this->facebook_url = $facebook_url;
        $stmt = $conn->prepare("UPDATE company_contact_info SET facebook_url = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->facebook_url);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the Instagram URL of the company.
     * 
     * @param string $instagram Instagram URL
     */
    public function updateInstagram($instagram) {
        global $conn;
        $this->instagram = $instagram;
        $stmt = $conn->prepare("UPDATE company_contact_info SET instagram = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->instagram);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the Daraz URL of the company.
     * 
     * @param string $daraz Daraz URL
     */
    public function updateDaraz($daraz) {
        global $conn;
        $this->daraz = $daraz;
        $stmt = $conn->prepare("UPDATE company_contact_info SET daraz = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->daraz);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the WhatsApp number of the company.
     * 
     * @param string $whatsapp WhatsApp number
     */
    public function updateWhatsapp($whatsapp) {
        global $conn;
        $this->whatsapp = $whatsapp;
        $stmt = $conn->prepare("UPDATE company_contact_info SET whatsapp = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->whatsapp);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the YouTube URL of the company.
     * 
     * @param string $youtube YouTube URL
     */
    public function updateYoutube($youtube) {
        global $conn;
        $this->youtube = $youtube;
        $stmt = $conn->prepare("UPDATE company_contact_info SET youtube = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->youtube);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the first telephone number of the company.
     * 
     * @param string $tele_number1 Telephone number 1
     */
    public function updateTeleNumber1($tele_number1) {
        global $conn;
        $this->tele_number1 = $tele_number1;
        $stmt = $conn->prepare("UPDATE company_contact_info SET tele_number1 = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->tele_number1);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the second telephone number of the company.
     * 
     * @param string $tele_number2 Telephone number 2
     */
    public function updateTeleNumber2($tele_number2) {
        global $conn;
        $this->tele_number2 = $tele_number2;
        $stmt = $conn->prepare("UPDATE company_contact_info SET tele_number2 = ? WHERE admin_id = ?");
        $stmt->bindValue(1, $this->tele_number2);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    // Getters for company contact info

    /**
     * Get the first address line of the company.
     * 
     * @return string Address line 1
     */
    public function getAddress1() {
        return $this->address1;
    }

    /**
     * Get the second address line of the company.
     * 
     * @return string Address line 2
     */
    public function getAddress2() {
        return $this->address2;
    }

    /**
     * Get the city of the company.
     * 
     * @return string City
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Get the email of the company.
     * 
     * @return string Email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get the Facebook URL of the company.
     * 
     * @return string Facebook URL
     */
    public function getFacebookUrl() {
        return $this->facebook_url;
    }

    /**
     * Get the Instagram URL of the company.
     * 
     * @return string Instagram URL
     */
    public function getInstagram() {
        return $this->instagram;
    }

    /**
     * Get the Daraz URL of the company.
     * 
     * @return string Daraz URL
     */
    public function getDaraz() {
        return $this->daraz;
    }

    /**
     * Get the WhatsApp number of the company.
     * 
     * @return string WhatsApp number
     */
    public function getWhatsapp() {
        return $this->whatsapp;
    }

    /**
     * Get the YouTube URL of the company.
     * 
     * @return string YouTube URL
     */
    public function getYoutube() {
        return $this->youtube;
    }

    /**
     * Get the first telephone number of the company.
     * 
     * @return string Telephone number 1
     */
    public function getTeleNumber1() {
        return $this->tele_number1;
    }

    /**
     * Get the second telephone number of the company.
     * 
     * @return string Telephone number 2
     */
    public function getTeleNumber2() {
        return $this->tele_number2;
    }
}
?>
