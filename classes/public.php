<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class PublicContact {
    private $contact_id;
    private $name;
    private $email;
    private $message;
    private $date_created;

    /**
     * Constructor to create a new public contact or retrieve an existing public contact.
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create an instance of PublicContact by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new public contact
     *      eg - new PublicContact(null, "John Doe", "john.doe@example.com", "Hello!")
     *  2) first argument is filled and rest are null - to retrieve data from database and create a new public contact 
     *      when the public contact already exists.
     *      eg - new PublicContact(1)
     * 
     * @param int|null $contact_id Contact ID
     * @param string|null $name Name
     * @param string|null $email Email
     * @param string|null $message Message
     */
    public function __construct($contact_id = null, $name = null, $email = null, $message = null) {
        global $conn;
        if ($contact_id === null) {
            $this->name = ucwords(trim($name));
            $this->email = strtolower(trim($email));
            $this->message = trim($message);

            // Insert public contact data
            $stmt = $conn->prepare("INSERT INTO public_contact (name, email, message) VALUES (?, ?, ?)");
            $stmt->bindValue(1, $this->name);
            $stmt->bindValue(2, $this->email);
            $stmt->bindValue(3, $this->message);
            $stmt->execute();
            $this->contact_id = $conn->lastInsertId();
            $stmt = null;

            // Retrieve date created
            $stmt = $conn->prepare("SELECT date_created FROM public_contact WHERE id = ?");
            $stmt->bindValue(1, $this->contact_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->date_created);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        } else {
            $this->contact_id = $contact_id;

            // Retrieve public contact data
            $stmt = $conn->prepare("SELECT name, email, message, date_created FROM public_contact WHERE id = ?");
            $stmt->bindValue(1, $this->contact_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->name);
            $stmt->bindColumn(2, $this->email);
            $stmt->bindColumn(3, $this->message);
            $stmt->bindColumn(4, $this->date_created);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    /**
     * Static method to retrieve all unread messages.
     * 
     * @return array Array of unread PublicContact objects
     */
    public static function getUnreadMessages() {
        global $conn;
        $unreadMessages = [];
        $stmt = $conn->prepare("SELECT id FROM public_contact WHERE status = 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $unreadMessages[] = new self($row['id']);
        }
        $stmt = null;
        return $unreadMessages;
    }
    
    /**
     * Static method to retrieve all public contacts as an object array.
     * 
     * @return array Array of PublicContact objects
     */
    public static function getAllPublicContacts() {
        global $conn;
        $contacts = [];
        $stmt = $conn->prepare("SELECT id FROM public_contact");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = new self($row['id']);
        }
        $stmt = null;
        return $contacts;
    }

    /**
     * Static method to retrieve the total number of public contacts.
     * 
     * @return int Total public contacts
     */
    public static function getNoOfTotalPublicContacts() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM public_contact");
        $stmt->execute();
        $total_contacts = $stmt->fetchColumn();
        $stmt = null;
        return $total_contacts;
    }

    /**
     * Static method to retrieve the total count of unread messages.
     * 
     * @return int Total unread messages
     */
    public static function getNoOfTotalUnreadMessagesCount() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM public_contact WHERE status = 0");
        $stmt->execute();
        $total_unread_messages = $stmt->fetchColumn();
        $stmt = null;
        return $total_unread_messages;
    }

    /**
     * Get the name of the public contact.
     * 
     * @return string Name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get the email of the public contact.
     * 
     * @return string Email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get the message of the public contact.
     * 
     * @return string Message
     */
    public function getMessage() {
        $this->setStatus(1);
        return $this->message;
    }

    /**
     * Set the status of the public contact.
     * 
     * @param int $status Status (0 or 1)
     */
    public function setStatus($status) {
        global $conn;
        $stmt = $conn->prepare("UPDATE public_contact SET status = ? WHERE id = ?");
        $stmt->bindValue(1, $status, PDO::PARAM_INT);
        $stmt->bindValue(2, $this->contact_id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Get the status of the public contact.
     * 
     * @return int Status
     */
    public function getStatus() {
        global $conn;
        $stmt = $conn->prepare("SELECT status FROM public_contact WHERE id = ?");
        $stmt->bindValue(1, $this->contact_id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->bindColumn(1, $status);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
        return $status;
    }

    /**
     * Get the date created of the public contact.
     * 
     * @return string Date created
     */
    public function getDateCreated() {
        return $this->date_created;
    }

    /**
     * Get the contact ID.
     * 
     * @return int Contact ID
     */
    public function getContactId() {
        return $this->contact_id;
    }

    /**
     * Use to delete the instance of PublicContact
     */
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    
}
?>
