function AddData() {
    var name = $('#item-name');
    var Desc = $('#description');
    var price = $('#item-price');
    var itemID = $('#item-id');
    var quantity = $('#qty');
    
    
        $.ajax({
            url: "http://localhost/scripts/PHP/fashion_club/public/cart/add_items",
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'Add_cart',
                name: name.val(),
                Desc: Desc.val(),
                price: price.val(),
                itemID: itemID.val(),
                quantity: quantity.val(),
            },
            success: function (response) {
                    if(response == "Successfully added to the cart") {
                        $('.alert').fadeIn(1000);
                        $('.alert').fadeOut(4000);
                    } else if(response == "Please login to add items!") {
                        window.location = "<?=ROOT?>login";
                    }
                    else {
                        alert(response);
                    }
                }
            
        })
    
}

function get_related_products() {
    var category = "<?= $data['post']->category ?>";
    var id = "<?= $data['post']->id ?>";
    
    $.ajax({
        url: 'http://localhost/scripts/PHP/fashion_club/public/single_page/get_products',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'get_related_products',
            category: category,
            id: id
        },
        success: function (response) {
            if(response == ""){
                $('.alert-secondary').fadeOut();
            } else {
                document.getElementById('related-products').innerHTML += response;
            }
        }
    })
}
