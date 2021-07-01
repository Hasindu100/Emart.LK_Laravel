{{View::make('header')}}

<style>
.container {
    width: 80%;  
}
.cart {
    margin-top:200px
}
.cart-box {
  width: 100%;
    display: flex;
}
.cart-box img{
  width:100px;
  height: 10vh
}
.detail-box {
  width: 50%;
  margin-left: 20px;

  line-height: 30px;
}
.detail-box .price {
    font-weight: bold;
}
.delete i {
  color: red;
  font-size: 30px
}

.delete i:hover {
    cursor: pointer;
    color: #000;
}

@media screen and (max-width: 768px) {
    .container { 
        font-size: 10px;
        width: 100%;
    }
    .cart {
        margin-top:100px
    }
    .btn {
        font-size: 8px;
    }
    .cart-box {
        display: inline;
    }
    .detail-box {
        width: 100%;
        font-size:10px;
        margin-left: 0px;
        line-height: 20px;
    }
    .detail-box .price {
        font-size: 12px;
    }
    .delete i {
        font-size: 20px;
    }
}
</style>

<div id="tableManager" class="modal fade" style="z-index:1000000">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Enter Your details</h2>
            </div>
            <div class="modal-body">
                <div id="editContent">
                    <input type="text" class="form-control" placeholder="name" id="name" required><br>
                    <input type="text" class="form-control" id="mobile-num" placeholder="Mobile Number"></textarea><br>
                    <textarea class="form-control" id="address" placeholder="Address"></textarea><br>
                    <input type="hidden" id="editRowID" value="0">
                    <span id="error" style="color:red"></span>
                </div>

            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Close" onclick="close()" id="closeBtn" >
                <input type="button" id="manageBtn" value="Place Order" onclick="order_items()" class="btn btn-success">
            </div>
        </div>
        </div>
    </div>
</div>



<div class="container cart">
    <!-- <a href="{{route('cart.remove_item')}}">Click</a> -->
    <div class="alert alert-info" style="display:none"><strong>Your cart is empty!</strong></div>
    <table class="table"  id="cart_table">
        <thead class="thead-dark">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price(Rs)</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody id="table_body"></tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        getexistingdata();
    });

    function show_model() {
        $("#tableManager").modal('show');
    }

    function goBack() {
        window.history.back();
    }

    function getexistingdata() {

        $.ajax({
            url:"{{route('cart.get_data')}}",
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: "getExistingData",
            },
            success: function (response) {
                $('#table_body').append(response);
            }
        });
    }

    function remove_item(ItemID) {
        if(confirm('Are you sure ?')) {
            $.ajax({
                url: "{{route('cart.remove_item')}}",
                type: "POST",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    key: 'deleteItem',
                    ItemID: ItemID
                },
                success: function (response) {
                    $("#country_"+ItemID).parent().remove();
                    alert(response);
                    total_amount_calculator();
                }
            });
        }
    }

    function update_item(ItemID) {
        var quantity = $('#qty_'+ItemID);
        
        $.ajax({
            url: "{{route('cart.update_item')}}",
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: 'update_item',
                ItemID: ItemID,
                quantity: quantity.val()
            },
            success: function (response) {
                $("#total_"+ItemID).html(response.total_price);
                total_amount_calculator();
            }
        })
    }

    function total_amount_calculator() {
        var rows = document.getElementById('cart_table').getElementsByTagName('tr');
        var count = rows.length;
        var i = 2;
        var x = 0;
        for(i=1; i < count-4; i++) {
            x += parseFloat(document.getElementById('cart_table').rows[i].cells.item(2).innerHTML);
        }
        document.getElementById('cart_table').rows[i].cells.item(1).innerHTML = "Rs:" + x + "/=";
    }

    function order_items() {
        var name = $("#name");
        var mobile_no = $("#mobile-num");
        var address = $("#address");
        
        if(name.val() == "" || mobile_no.val() == "" || address.val() == "") {
            document.getElementById('error').innerHTML = "Please fill all the fields!";
        } else {
            document.getElementById('error').innerHTML = "";
            
            if(confirm("Are you sure to order items?")) {
                $.ajax({
                    url: "{{route('cart.order_items')}}",
                    type: "POST",
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        key: "order_items",
                        name: name.val(),
                        mobile_no: mobile_no.val(),
                        address: address.val()
                    },
                    success: function (response) {
                        alert(response);
                        $("#tableManager").modal('hide');
                        $("#table_body").remove();
                    }
                });
            }
        }
    }

</script>

{{View::make('footer')}}