<div class="container">
    <a href="/cart"><div class="cart-btn"><i class="fa fa-cart-plus"></i><sup id="count"></sup></div></a>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        cartCount();
    });

    function cartCount() {
        $.ajax({
            url: "{{route('cart.cart_count')}}",
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: 'cartCount',
            },
            success: function (response) {
                $('#count').html(response.item_count);
                $('#item-count').html(response.item_count);
            }
        });
    }

</script>

