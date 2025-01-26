# Faq Class

The `Faq` class is used to manage frequently asked questions (FAQs) in the system. It provides methods to create, retrieve, update, and delete FAQs.

## Methods

### `__construct($faq_id = null, $title = null, $answer = null, $admin_id = null)`
Constructor to create a new FAQ or retrieve an existing FAQ.

### `updateTitle($title)`
Update the title of the FAQ.

### `updateAnswer($answer)`
Update the answer of the FAQ.

### `deleteFaq()`
Delete the FAQ.

### `getTitle()`
Get the title of the FAQ.

### `getAnswer()`
Get the answer of the FAQ.

### `getAdminId()`
Get the admin ID of the FAQ.

### `getDateCreated()`
Get the date created of the FAQ.

### `getDateModified()`
Get the date modified of the FAQ.

### `getFaqId()`
Get the FAQ ID.

### `getNoOfTotalFaqs()`
Get the total number of FAQs.

### `__destruct()`
Destructor to unset all properties.
