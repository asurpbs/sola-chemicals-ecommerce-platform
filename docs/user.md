# User Class

The `User` class is used to manage users in the system. It provides methods to create, retrieve, update, and delete users.

## Methods

### `__construct($user_id = null, $first_name = null, $last_name = null, $image = null, $gender = null, $birth_date = null, $password = null, $email = null, $address1 = null, $address2 = null, $postal_code = null, $city_id = null, $telephone1 = null, $telephone2 = null)`
Constructor to create a new user or retrieve an existing user.

### `updateFirstName($first_name)`
Update the first name of the user.

### `updateLastName($last_name)`
Update the last name of the user.

### `updateAddress1($address1)`
Update the first address line of the user.

### `updateAddress2($address2)`
Update the second address line of the user.

### `updateTelephone1($telephone1)`
Update the first telephone number of the user.

### `updateTelephone2($telephone2)`
Update the second telephone number of the user.

### `updatePostalCode($postal_code)`
Update the postal code of the user.

### `updateCityId($city_id)`
Update the city ID of the user.

### `updateEmail($email)`
Update the email of the user.

### `updatePassword($password)`
Update the password of the user.

### `updateImage()`
Update the image of the user.

### `getOrderIds()`
Retrieve all orders done by the user as an array.

### `deleteUser()`
Delete the user and all related data.

### `getFirstName()`
Get the first name of the user.

### `getLastName()`
Get the last name of the user.

### `getImage()`
Get the image of the user.

### `getGender()`
Get the gender of the user.

### `getBirthDate()`
Get the birth date of the user.

### `getEmail()`
Get the email of the user.

### `getAddress1()`
Get the first address line of the user.

### `getAddress2()`
Get the second address line of the user.

### `getTelephone1()`
Get the first telephone number of the user.

### `getTelephone2()`
Get the second telephone number of the user.

### `getCity()`
Get the city name of the user.

### `getDistrict()`
Get the district name of the user based on the city ID.

### `getProvince()`
Get the province name of the user based on the city ID.

### `getPostalCode()`
Get the postal code of the user.

### `getUserId()`
Get the user ID.

### `getTotalUsers()`
Get the total number of users.

### `getCartId()`
Get the cart ID of the user.

### `__destruct()`
Use to delete the instance of user.

### `getAllUsers()`
Get all users as an array.
