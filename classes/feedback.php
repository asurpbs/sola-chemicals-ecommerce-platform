<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Feedback {
    private $feedback_id;
    private $user_id;
    private $comment;
    private $date_created;

    /**
     * Constructor to create a new feedback or retrieve an existing feedback.
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create an instance of Feedback by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new feedback
     *      eg - new Feedback(null, 1, "Great product!")
     *  2) first argument is filled and rest are null - to retrieve data from database and create a new feedback 
     *      when the feedback already exists.
     *      eg - new Feedback(1)
     * 
     * @param int|null $feedback_id Feedback ID
     * @param int|null $user_id User ID
     * @param string|null $comment Comment
     */
    public function __construct($feedback_id = null, $user_id = null, $comment = null) {
        global $conn;
        if ($feedback_id === null) {
            $this->user_id = $user_id;
            $this->comment = trim($comment);

            // Insert feedback data
            $stmt = $conn->prepare("INSERT INTO feedback (user_id, comment) VALUES (?, ?)");
            $stmt->bindValue(1, $this->user_id);
            $stmt->bindValue(2, $this->comment);
            $stmt->execute();
            $this->feedback_id = $conn->lastInsertId();
            $stmt = null;

            // Retrieve date created
            $stmt = $conn->prepare("SELECT date_created FROM feedback WHERE id = ?");
            $stmt->bindValue(1, $this->feedback_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->date_created);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        } else {
            $this->feedback_id = $feedback_id;

            // Retrieve feedback data
            $stmt = $conn->prepare("SELECT user_id, comment, date_created FROM feedback WHERE id = ?");
            $stmt->bindValue(1, $this->feedback_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->user_id);
            $stmt->bindColumn(2, $this->comment);
            $stmt->bindColumn(3, $this->date_created);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    /**
     * Update the comment of the feedback.
     * 
     * @param string $comment Comment
     */
    public function updateComment($comment) {
        global $conn;
        $this->comment = trim($comment);
        $stmt = $conn->prepare("UPDATE feedback SET comment = ? WHERE id = ?");
        $stmt->bindValue(1, $this->comment);
        $stmt->bindValue(2, $this->feedback_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Delete the feedback.
     */
    public function deleteFeedback() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
        $stmt->bindValue(1, $this->feedback_id);
        $stmt->execute();
        $stmt = null;

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /**
     * Get the user ID of the feedback.
     * 
     * @return int User ID
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * Get the comment of the feedback.
     * 
     * @return string Comment
     */
    public function getComment() {
        $this->setStatus(1);
        return $this->comment;
    }

    /**
     * Get the date created of the feedback.
     * 
     * @return string Date created
     */
    public function getDateCreated() {
        return $this->date_created;
    }

    /**
     * Get the feedback ID.
     * 
     * @return int Feedback ID
     */
    public function getFeedbackId() {
        return $this->feedback_id;
    }

    /**
     * Get the total number of feedbacks.
     * 
     * @return int Total feedbacks
     */
    public static function getNoTotalFeedbacks() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM feedback");
        $stmt->execute();
        $total_feedbacks = $stmt->fetchColumn();
        $stmt = null;
        return $total_feedbacks;
    }

    /**
     * Get the total count of unread feedbacks.
     * 
     * @return int Total unread feedbacks
     */
    public static function getNoOfTotalUnreadFeedbacks() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM feedback WHERE status = 0");
        $stmt->execute();
        $total_unread_feedbacks = $stmt->fetchColumn();
        $stmt = null;
        return $total_unread_feedbacks;
    }

    /**
     * Set the status of the feedback.
     * 
     * @param int $status Status (0 or 1)
     */
    public function setStatus($status) {
        global $conn;
        $stmt = $conn->prepare("UPDATE feedback SET status = ? WHERE id = ?");
        $stmt->bindValue(1, $status, PDO::PARAM_INT);
        $stmt->bindValue(2, $this->feedback_id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Get the status of the feedback.
     * 
     * @return int Status
     */
    public function getStatus() {
        global $conn;
        $stmt = $conn->prepare("SELECT status FROM feedback WHERE id = ?");
        $stmt->bindValue(1, $this->feedback_id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->bindColumn(1, $status);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
        return $status;
    }

    /**
     * Use to delete the instance of Feedback
     */
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
}
?>
