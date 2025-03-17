# PublicContact Class

The `PublicContact` class is used to manage public contacts in the system. It provides methods to create, retrieve, update, and delete public contacts.

## Methods

### `__construct($contact_id = null, $name = null, $email = null, $message = null)`
Constructor to create a new public contact or retrieve an existing public contact.

### `getUnreadMessages()`
Static method to retrieve all unread messages.

### `getAllPublicContacts()`
Static method to retrieve all public contacts as an object array.

### `getNoOfTotalPublicContacts()`
Static method to retrieve the total number of public contacts.

### `getNoOfTotalUnreadMessagesCount()`
Static method to retrieve the total count of unread messages.

### `getName()`
Get the name of the public contact.

### `getEmail()`
Get the email of the public contact.

### `getMessage()`
Get the message of the public contact.

### `setStatus($status)`
Set the status of the public contact.

### `getStatus()`
Get the status of the public contact.

### `getDateCreated()`
Get the date created of the public contact.

### `getContactId()`
Get the contact ID.

### `__destruct()`
Use to delete the instance of PublicContact.
