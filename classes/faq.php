<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Faq {
    private $faq_id;
    private $title;
    private $answer;
    private $admin_id;
    private $date_created;
    private $date_modified;

    /**
     * Constructor to create a new FAQ or retrieve an existing FAQ.
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create an instance of FAQ by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new FAQ
     *      eg - new Faq(null, "What is your return policy?", "Our return policy lasts 30 days.", 1)
     *  2) first argument is filled and rest are null - to retrieve data from database and create a new FAQ 
     *      when the FAQ already exists.
     *      eg - new Faq(1)
     * 
     * @param int|null $faq_id FAQ ID
     * @param string|null $title Title
     * @param string|null $answer Answer
     * @param int|null $admin_id Admin ID
     */
    public function __construct($faq_id = null, $title = null, $answer = null, $admin_id = null) {
        global $conn;
        if ($faq_id === null) {
            $this->title = trim($title);
            $this->answer = trim($answer);
            $this->admin_id = $admin_id;

            // Insert FAQ data
            $stmt = $conn->prepare("INSERT INTO faq (title, answer, admin_id) VALUES (?, ?, ?)");
            $stmt->bindValue(1, $this->title);
            $stmt->bindValue(2, $this->answer);
            $stmt->bindValue(3, $this->admin_id);
            $stmt->execute();
            $this->faq_id = $conn->lastInsertId();
            $stmt = null;

            // Retrieve date created and date modified
            $stmt = $conn->prepare("SELECT date_created, date_modified FROM faq WHERE id = ?");
            $stmt->bindValue(1, $this->faq_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->date_created);
            $stmt->bindColumn(2, $this->date_modified);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        } else {
            $this->faq_id = $faq_id;

            // Retrieve FAQ data
            $stmt = $conn->prepare("SELECT title, answer, admin_id, date_created, date_modified FROM faq WHERE id = ?");
            $stmt->bindValue(1, $this->faq_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->title);
            $stmt->bindColumn(2, $this->answer);
            $stmt->bindColumn(3, $this->admin_id);
            $stmt->bindColumn(4, $this->date_created);
            $stmt->bindColumn(5, $this->date_modified);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    /**
     * Update the title of the FAQ.
     * 
     * @param string $title Title
     */
    public function updateTitle($title) {
        global $conn;
        $this->title = trim($title);
        $stmt = $conn->prepare("UPDATE faq SET title = ? WHERE id = ?");
        $stmt->bindValue(1, $this->title);
        $stmt->bindValue(2, $this->faq_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the answer of the FAQ.
     * 
     * @param string $answer Answer
     */
    public function updateAnswer($answer) {
        global $conn;
        $this->answer = trim($answer);
        $stmt = $conn->prepare("UPDATE faq SET answer = ? WHERE id = ?");
        $stmt->bindValue(1, $this->answer);
        $stmt->bindValue(2, $this->faq_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Delete the FAQ.
     */
    public function deleteFaq() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM faq WHERE id = ?");
        $stmt->bindValue(1, $this->faq_id);
        $stmt->execute();
        $stmt = null;

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /**
     * Get the title of the FAQ.
     * 
     * @return string Title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Get the answer of the FAQ.
     * 
     * @return string Answer
     */
    public function getAnswer() {
        return $this->answer;
    }

    /**
     * Get the admin ID of the FAQ.
     * 
     * @return int Admin ID
     */
    public function getAdminId() {
        return $this->admin_id;
    }

    /**
     * Get the date created of the FAQ.
     * 
     * @return string Date created
     */
    public function getDateCreated() {
        return $this->date_created;
    }

    /**
     * Get the date modified of the FAQ.
     * 
     * @return string Date modified
     */
    public function getDateModified() {
        return $this->date_modified;
    }

    /**
     * Get the FAQ ID.
     * 
     * @return int FAQ ID
     */
    public function getFaqId() {
        return $this->faq_id;
    }

    /**
     * Get the total number of FAQs.
     * 
     * @return int Total FAQs
     */
    public static function getNoOfTotalFaqs() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM faq");
        $stmt->execute();
        $total_faqs = $stmt->fetchColumn();
        $stmt = null;
        return $total_faqs;
    }

    /**
     * Use to delete the instance of FAQ
     */
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
}
?>
