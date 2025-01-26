# Branch Class

The `Branch` class is used to manage branches in the system. It provides methods to create, retrieve, update, and delete branches.

## Methods

### `__construct($branch_id = null, $address1 = null, $address2 = null, $latitude = null, $longitude = null, $email = null, $city_id = null, $admin_id = null, $telephone1 = null, $telephone2 = null)`
Constructor to create a new branch or retrieve an existing branch.

### `updateAddress1($address1)`
Update the address line 1 of the branch.

### `updateAddress2($address2)`
Update the address line 2 of the branch.

### `updateLatitude($latitude)`
Update the latitude of the branch.

### `updateLongitude($longitude)`
Update the longitude of the branch.

### `updateEmail($email)`
Update the email of the branch.

### `updateCityId($city_id)`
Update the city ID of the branch.

### `updateAdminId($admin_id)`
Update the admin ID of the branch.

### `updateTelephone1($telephone1)`
Update the first telephone number of the branch.

### `updateTelephone2($telephone2)`
Update the second telephone number of the branch.

### `deleteBranch()`
Delete the branch and all related data.

### `deleteBranchById($branch_id)`
Delete a branch by its ID.

### `getAddress1()`
Get the address line 1 of the branch.

### `getAddress2()`
Get the address line 2 of the branch.

### `getLatitude()`
Get the latitude of the branch.

### `getLongitude()`
Get the longitude of the branch.

### `getEmail()`
Get the email of the branch.

### `getCity()`
Get the city name of the branch.

### `getDistrict()`
Get the district name of the branch based on the city ID.

### `getProvince()`
Get the province name of the branch based on the city ID.

### `getDateCreated()`
Get the date created of the branch.

### `getTelephone1()`
Get the first telephone number of the branch.

### `getTelephone2()`
Get the second telephone number of the branch.

### `getBranchId()`
Get the branch ID.

### `getTotalBranches()`
Get the total number of branches.

### `getAllBranches()`
Get all branches as an array of Branch objects.

### `__destruct()`
Use to delete the instance of Branch.
