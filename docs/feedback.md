# Feedback Class

The `Feedback` class is used to manage feedbacks in the system. It provides methods to create, retrieve, update, and delete feedbacks.

## Methods

### `__construct($feedback_id = null, $user_id = null, $comment = null)`
Constructor to create a new feedback or retrieve an existing feedback.

### `updateComment($comment)`
Update the comment of the feedback.

### `deleteFeedback()`
Delete the feedback.

### `getUserId()`
Get the user ID of the feedback.

### `getComment()`
Get the comment of the feedback.

### `getDateCreated()`
Get the date created of the feedback.

### `getFeedbackId()`
Get the feedback ID.

### `getNoTotalFeedbacks()`
Static method to retrieve the total number of feedbacks.

### `getNoOfTotalUnreadFeedbacks()`
Static method to retrieve the total count of unread feedbacks.

### `setStatus($status)`
Set the status of the feedback.

### `getStatus()`
Get the status of the feedback.

### `__destruct()`
Use to delete the instance of the feedback.
