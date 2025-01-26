# Cart Class

The `Cart` class is used to manage shopping carts in the system. It provides methods to create, retrieve, update, and delete cart items.

## Methods

### `__construct($cart_id = null, $user_id = null)`
Constructor to create a new cart or retrieve an existing cart.

### `getNoOfItems()`
Get the number of items in the cart.

### `addItem($item_id, $quantity)`
Add an item to the cart.

### `deleteItem($cartItem_id)`
Delete an item from the cart.

### `updateItem($cartItem_id, $quantity)`
Update the quantity of an item in the cart.

### `getItems()`
Get all items in the cart.

### `getCartId()`
Get the cart ID.

### `getUserId()`
Get the user ID.

### `__destruct()`
Destructor to unset all properties.
