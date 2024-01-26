// cart.js
$(document).ready(function() {
    // Function to update the cart item quantity
    function updateCartItemQuantity(itemId, quantity) {
        $.ajax({
            url: '/cart/update',
            method: 'PUT',
            data: {
                itemId:itemId,
                quantity: quantity
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success response (e.g., update the UI)
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    }

    // Function to remove a cart item
    function removeCartItem(itemId) {
        $.ajax({
            url: '/remove-from-cart/' + itemId,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                loadCartItems()
                // Handle success response (e.g., update the UI)
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    }

    // Function to load cart items
function loadCartItems() {
    $.ajax({
        url: '/cart/load', // Replace with the actual URL to load cart items
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {

        loadCartCount();
        $('#cart-items').empty(); // Clear the existing cart items
        response.cartItems.forEach(function(item) {
            var cartItemHtml = `
                <div class="cart-item">
                    <img src="${item.book.photo}" height="100" width="100" alt="Book Image" class="book-image">
                    <div class="item-details">
                        <h3>${item.book.title}</h3>
                        <p>Price: $${item.book.price}</p>
                        <div class="quantity-controls">
                            <button class="decrease-quantity" data-item-id="${item.id}">-</button>
                            <input type="number" class="quantity-input" value="${item.quantity}" min="1">
                            <button class="increase-quantity" data-item-id="${item.id}">+</button>
                        </div>
                        <button class="update-btn" data-item-id="${item.id}">Update</button>
                        <button class="remove-btn" data-item-id="${item.id}">Remove</button>
                    </div>
                </div>
            `;
            $('#cart-items').append(cartItemHtml); // Append the new cart item
        });

        },
        error: function(xhr, status, error) {
            // Handle error
        }
    });
}

// Example: Attach event listeners to update, remove, increase, and decrease buttons
$('#cart-items').on('click', '.update-btn', function() {
    var itemId = $(this).data('item-id');
    var newQuantity = $(this).closest('.cart-item').find('.quantity-input').val();
    updateCartItemQuantity(itemId, newQuantity);
});

$('#cart-items').on('click', '.remove-btn', function() {
    var itemId = $(this).data('item-id');
    removeCartItem(itemId);
});

$('#cart-items').on('click', '.increase-quantity', function() {
    var itemId = $(this).data('item-id');
    var input = $(this).siblings('.quantity-input');
    input.val(parseInt(input.val()) + 1);
});

$('#cart-items').on('click', '.decrease-quantity', function() {
    var itemId = $(this).data('item-id');
    var input = $(this).siblings('.quantity-input');
    var newValue = parseInt(input.val()) - 1;
    if (newValue >= 1) {
        input.val(newValue);
    }
});

// Load cart items when the page is ready
loadCartItems();



$('#order-now-btn').on('click', function() {
    $.ajax({
        url: 'add-to-order',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Handle success response (e.g., display success message)
            // alert('Order placed successfully!');
            swal({
                text: 'Order placed successfully!',
                icon: "success",
            });

            setTimeout(() => {
                window.location.href = '/orders'
            }, 2000);
            // Optionally, you can redirect the user to the order success page
            // window.location.href = '/order/success/' + response.orderId;
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(error);
        }
    });
});


function loadCartCount() {
    $.ajax({
        url: '/cart/count', // Replace with the actual URL to load cart items count
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $("#order_button").hide()
            $('#cart-Count').text(response.cartICount); // Update the cart count in the DOM
            if(response.cartICount > 0){
                $("#order_button").show()
            }
        },
        error: function(xhr, status, error) {
            // Handle error
        }
    });
}
});
