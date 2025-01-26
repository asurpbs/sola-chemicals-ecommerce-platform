# Item Class

The `Item` class is used to manage items in the system. It provides methods to create, retrieve, update, and delete items.

## Methods

### `__construct($item_id = null, $name = null, $image = null, $category_id = null, $QoH = null, $UP = null, $discount_rate = null, $availability = null, $delivery_method_id = null)`
Constructor to create a new item or retrieve an existing item.

### `updateName($name)`
Update the name of the item.

### `updateImage($image)`
Update the image of the item.

### `updateCategoryId($category_id)`
Update the category ID of the item.

### `updateQoH($QoH)`
Update the quantity on hand of the item.

### `updateUP($UP)`
Update the unit price of the item.

### `updateDiscountRate($discount_rate)`
Update the discount rate of the item.

### `updateAvailability($availability)`
Update the availability of the item.

### `getName()`
Get the name of the item.

### `getImage()`
Get the image of the item.

### `getCategoryId()`
Get the category ID of the item.

### `getQoH()`
Get the quantity on hand of the item.

### `getUP()`
Get the unit price of the item.

### `getDiscountRate()`
Get the discount rate of the item.

### `getAvailability()`
Get the availability of the item.

### `deleteItem()`
Delete the item.

### `getNoTotalItems()`
Static method to retrieve the total number of items.

### `getAllItems()`
Static method to retrieve all items as an object array.

### `__destruct()`
Use to delete the instance of Item.
