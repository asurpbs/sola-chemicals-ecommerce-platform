# Admin Class

The `Admin` class is used to manage admin users in the system. It provides methods to create, retrieve, update, and delete admin users.

## Methods

### `__construct($admin_id = null, $first_name = null, $last_name = null, $image = null, $gender = null, $email = null, $password = null, $tele_number = null, $role = null)`
Constructor to create a new admin or retrieve an existing admin.

### `updateFirstName($first_name)`
Update the first name of the admin.

### `updateLastName($last_name)`
Update the last name of the admin.

### `updateEmail($email)`
Update the email of the admin.

### `updatePassword($password)`
Update the password of the admin.

### `updateTeleNumber($tele_number)`
Update the telephone number of the admin.

### `updateRole($role)`
Update the role of the admin.

### `updateImage()`
Update the image of the admin.

### `deleteAdmin()`
Delete the admin and all related data.

### `getFirstName()`
Get the first name of the admin.

### `getLastName()`
Get the last name of the admin.

### `getImage()`
Get the image of the admin.

### `getGender()`
Get the gender of the admin.

### `getEmail()`
Get the email of the admin.

### `getTeleNumber()`
Get the telephone number of the admin.

### `getRole()`
Get the role of the admin.

### `getAdminId()`
Get the admin ID.

### `getTotalUsers()`
Get the total number of admins.

### `__destruct()`
Use to delete the instance of admin.

### `getAllAdmins()`
Get all admins.