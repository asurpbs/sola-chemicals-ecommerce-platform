# Notification Class

The `Notification` class is used to manage notifications in the system. It provides methods to create, retrieve, update, and delete notifications.

## Methods

### `__construct($id = null)`
Constructor to create a new notification or retrieve an existing notification.

### `getStatus()`
Get the status of the notification.

### `setStatus($status)`
Set the status of the notification.

### `getTotalCount($status = null)`
Static method to retrieve the total count of notifications.

### `getAllNotifications()`
Static method to retrieve all notifications as an object array.

### `deleteNotification()`
Delete the notification.

### `__destruct()`
Use to delete the instance of Notification.
