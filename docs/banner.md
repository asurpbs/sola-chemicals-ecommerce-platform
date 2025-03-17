# Banner Class

The `Banner` class is used to manage banners in the system. It provides methods to create, retrieve, update, and delete banners.

## Methods

### `__construct($banner_id = null, $admin_id = null, $image = null, $description = null, $status = null)`
Constructor to create a new banner or retrieve an existing banner.

### `updateImage()`
Update the image of the banner.

### `updateDescription($description)`
Update the description of the banner.

### `updateStatus($status)`
Update the status of the banner.

### `deleteBanner()`
Delete the banner and all related data.

### `getAdminId()`
Get the admin ID of the banner.

### `getImage()`
Get the image of the banner.

### `getDescription()`
Get the description of the banner.

### `getStatus()`
Get the status of the banner.
