# Order Class

The `Order` class is used to manage orders in the system. It provides methods to create, retrieve, update, and delete orders.

## Methods

### `__construct($order_id = null, $item_id = null, $user_id = null, $quantity = null, $delivery_method_id = null, $status = null, $total = null, $delivered_date = null)`
Constructor to create a new order or retrieve an existing order.

### `updateQuantity($quantity)`
Update the quantity of the order.

### `updateStatus($status)`
Update the status of the order.

### `updateTotal($total)`
Update the total of the order.

### `updateDeliveredDate($delivered_date)`
Update the delivered date of the order.

### `deleteOrder()`
Delete the order and set related foreign key references to null.

### `getItemName()`
Get the name of the item in the order.

### `getDeliveryMethodName()`
Get the name of the delivery method for the order.

### `getUserName()`
Get the name of the user who placed the order.

### `getQuantity()`
Get the quantity of the order.

### `getStatus()`
Get the status of the order.

### `getTotal()`
Get the total of the order.

### `getDeliveredDate()`
Get the delivered date of the order.

### `getOrderId()`
Get the order ID.

### `calculateTotal()`
Calculate the total of the order based on item price and quantity.

### `getOrders()`
Retrieve all orders as an array of Order instances.
