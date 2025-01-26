# CartItem Class

The `CartItem` class is used to manage items in a shopping cart. It provides methods to create, retrieve, update, and delete cart items.

## Methods

### `__construct($cartItem_id = null, $cart_id = null, $item_id = null, $quantity = null)`
Constructor to create a new cart item or retrieve an existing cart item.

### `updateQuantity($quantity)`
Update the quantity of the cart item.

### `delete()`
Delete the cart item.

### `getQuantity()`
Get the quantity of the cart item.

### `getItemId()`
Get the item ID.

### `getCartId()`
Get the cart ID.

### `getImage()`
Get the image of the item.

### `__destruct()`
Destructor to unset all properties.
