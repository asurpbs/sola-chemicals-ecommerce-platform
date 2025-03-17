<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Notification {
    private $id;
    private $admin_id;
    private $order_id;
    private $public_contact_id;
    private $message;
    private $status;
    private $date_created;
    private $accessed_date;

    public function __construct($id = null) {
        global $conn;
        if ($id !== null) {
            $this->id = $id;
            $stmt = $conn->prepare("SELECT admin_id, order_id, public_contact_id, message, status, date_created, accessed_date FROM notification WHERE id = ?");
            $stmt->bindValue(1, $this->id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->admin_id);
            $stmt->bindColumn(2, $this->order_id);
            $stmt->bindColumn(3, $this->public_contact_id);
            $stmt->bindColumn(4, $this->message);
            $stmt->bindColumn(5, $this->status);
            $stmt->bindColumn(6, $this->date_created);
            $stmt->bindColumn(7, $this->accessed_date);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        global $conn;
        $this->status = $status;
        $stmt = $conn->prepare("UPDATE notification SET status = ?, accessed_date = CURRENT_TIMESTAMP() WHERE id = ?");
        $stmt->bindValue(1, $this->status);
        $stmt->bindValue(2, $this->id);
        $stmt->execute();
        $stmt = null;
    }

    public static function getTotalCount($status = null) {
        global $conn;
        if ($status === null) {
            $stmt = $conn->prepare("SELECT COUNT(id) FROM notification");
        } else {
            $stmt = $conn->prepare("SELECT COUNT(id) FROM notification WHERE status = ?");
            $stmt->bindValue(1, $status);
        }
        $stmt->execute();
        $total_count = $stmt->fetchColumn();
        $stmt = null;
        return $total_count;
    }

    public static function getAllNotifications() {
        global $conn;
        $notifications = [];
        $stmt = $conn->prepare("SELECT id FROM notification");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $notifications[] = new self($row['id']);
        }
        $stmt = null;
        return $notifications;
    }

    public function deleteNotification() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM notification WHERE id = ?");
        $stmt->bindValue(1, $this->id);
        $stmt->execute();
        $stmt = null;
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
}
?>
