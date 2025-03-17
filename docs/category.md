# Category Class

The `Category` class is used to manage categories in the system. It provides methods to create, retrieve, update, and delete categories.

## Methods

### `__construct($category_id = null, $name = null, $description = null)`
Constructor to create a new category or retrieve an existing category.

### `getAllCategories()`
Get all categories as an array.

### `getNoTotalCategories()`
Get the total number of categories.

### `getCategoryId()`
Get the category ID.

### `getName()`
Get the name of the category.

### `getDescription()`
Get the description of the category.

### `updateName($name)`
Update the name of the category.

### `updateDescription($description)`
Update the description of the category.

### `deleteCategory()`
Delete the category.

### `getItems()`
Get all items under the category as an array of objects.

### `getNoOfItems()`
Get the number of items under the category.

### `getCategoryList()`
Get a list of categories as an array.

### `__destruct()`
Use to delete the instance of category.
