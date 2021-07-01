{{View::make('header')}}

<style>
    .box {
        display: border-box;
        padding: 20px 20px 40px 20px;
    }
    .box i {
        color: #fff;
        font-size: 80px;
        float: right;
    }
    .title {
        color: #fff;
        font-size: 20px;
       
    }
    .count {
        color: #fff;
        font-size: 30px;
        font-weight: bold;
    }
    .order {
        background: green;
    }
    .user {
        background: blue;
    }
    .item {
        background: orange;
    }

    @media screen and (max-width:768px) {
        .modal-dialog{
        max-width: 400px;
        }
    }
</style>


<div id="tableManager" class="modal fade" style="z-index:1000000">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modal-title">Order Details</h2>
            </div>
            <div class="modal-body">
                <div id="editContent">
                    
                </div>

            </div>
            <div class="modal-footer" id="modal-footer">
                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Close" id="closeBtn" >
            </div>
        </div>
        </div>
    </div>
</div>


<div class="container">
        <div class="row" style="margin-top:100px">
            <div class="col-md-4" onclick="showOrders()">
                <div class="box order">
                    <i class="fa fa-shopping-cart"></i>
                    <div class="details">
                        <div class="title">New Orders</div>
                        <div class="count" id="order-count">60</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" onclick="showUsers()">
                <div class="box user">
                    <i class="fa fa-users"></i>
                    <div class="details">
                        <div class="title">New Users</div>
                        <div class="count" id="user-count">60</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" onclick="showItems()">
                <div class="box item">
                    <i class="fa fa-th-large"></i>
                    <div class="details">
                        <div class="title">Items</div>
                        <div class="count" id="item-count">60</div>
                    </div>
                </div>
            </div>
        </div>
</div>


<div class="table-responsive">
<div class="container table" id="menu" style="margin-top:30px">

</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        get_order_user_item_count();
        
    });

    function get_order_user_item_count() {
        $.ajax({
            url: "{{route('admin.order_user_item_count')}}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: 'get_order_user_item_count'
            },
            success: function(response) {
                if(response) {
                    document.getElementById('user-count').innerHTML = response.userCount;
                    document.getElementById('item-count').innerHTML = response.productCount;
                    document.getElementById('order-count').innerHTML = response.orderCount;
                }
            }
        });
    }

    function showUsers() {
        document.getElementById('menu').innerHTML = "";
        var str = `<table class="table table-hover table-bordered" style="margin-top:100px" id="cart_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Name</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody id="table_body"></tbody>
                </table>`;
        $('.table').append(str);

        $.ajax({
            url: "{{route('admin.show_users')}}",
            type: "POST",
            dataType: "text",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: 'showUsers'
            },
            success: function (response) {
                //alert(response);
                $('tbody').append(response);
            }
        });
    }

    function showOrders() {
        document.getElementById('menu').innerHTML = "";
        var str = `<table class="table table-hover table-bordered" style="margin-top:100px" id="cart_table">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody id="table_body"></tbody>
                </table>`;
        $('.table').append(str);

        $.ajax({
            url: "{{route('admin.show_orders')}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: 'showOrders'
            },
            success: function (response) {
                $('tbody').append(response);
            }
        })
    }

    function showItems() {
        document.getElementById('menu').innerHTML = "";
        var str = `<div class="add"><button onclick="viewAddItem()" class="btn btn-primary">Add new item</button></div>
                   <table class="table table-hover table-bordered" style="margin-top:10px" id="cart_table">
                    <thead>
                        <tr>
                            <th>Item Id</th>
                            <th>Image</th>
                            <th>Item Name</th>
                            <th>Unit Price(Rs)</th>
                            <th>Category</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody id="table_body"></tbody>
                </table>`;
        $('.table').append(str);

        $.ajax({
            url: "{{route('admin.show_items')}}",
            method: "POST",
            dataType: "text",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: 'showItems'
            },
            success: function (response) {
               // $(".table").DataTable();
                $('tbody').append(response);
            }
        });
    }

    function viewOrder(orderID) {
        document.getElementById('modal-title').innerHTML = "";
        document.getElementById('modal-title').innerHTML = "Order Details";
        document.getElementById('editContent').innerHTML = "";
        var str = `<input type="hidden" id="order_id" value =` + orderID + `>
                <table class="table table-hover table-bordered" id="cart_table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody id="model_table_body"></tbody>
                </table>`;
        $('#editContent').append(str);

        document.getElementById('modal-footer').innerHTML = "";
        var btn = `<input type="button" id="manageBtn" value="Complete Order" onclick="completeOrder()" class="btn btn-success">`;
        $('#modal-footer').append(btn);

        $("#tableManager").modal('show');

        $.ajax({
            url: "{{route('admin.view_order')}}",
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: 'viewOrder',
                orderID: orderID
            },
            success: function (response) {
                $('#model_table_body').append(response);
            }
        });
    }

    function completeOrder() {
        var orderID = $('#order_id');
        if(confirm("Are you sure to complete order?")) {
            $.ajax({
                url: "{{route('admin.complete_order')}}",
                type: "POST",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    key: 'completeOrder',
                    orderID: orderID.val()
                },
                success: function (response) {
                    $("#order_"+orderID.val()).parent().remove();
                    alert(response);
                    $("#tableManager").modal('hide');
                    get_user_order_item_Count();
                }
            })
        }
    }

    function viewItem(itemID) {
        document.getElementById('modal-title').innerHTML = "";
        document.getElementById('modal-title').innerHTML = "Item Details";
        document.getElementById('modal-footer').innerHTML = "";
        document.getElementById('editContent').innerHTML = "";
        var str =  `<div class="contact-form">
                        <form id="contact" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                @csrf
                                <fieldset>
                                <input name="itemid" type="hidden" class="form-control" id="itemid" value="` + itemID + `">
                                </fieldset>
                                <fieldset>
                                <input name="title" type="text" class="form-control" id="name" placeholder="Title" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                <input name="file" type="file" class="form-control" id="file">
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                <input name="price" type="text" class="form-control" id="price" placeholder="Price" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <select class="form-control" id="category" name="category" style="margin-bottom:15px" required="">
                                        <option>Select Category</option>
                                        <option>Grocerries</option>
                                        <option>Vegitables-Fruits</option>
                                        <option>Meat-foods</option>
                                        <option>Gas</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                <textarea name="description" rows="6" class="form-control" id="description" placeholder="Description" required=""></textarea>
                                </fieldset>
                            </div>
                            <span id="error" style="color:red"></span>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button onclick="updateItem()" id="form-submit" class="filled-button">Update</button>
                                </fieldset>
                            </div>
                            </div>
                        <form>
                    </div>`;
        $('#editContent').append(str);
        $("#tableManager").modal('show');

        $.ajax({
                url: "{{route('admin.view_item')}}",
                type: "POST",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    key: 'viewItem',
                    itemID: itemID
                },
                success: function (response) {
                    if(response) {
                        $("#name").val(response.name);
                        $("#price").val(response.price);
                        $("#description").html(response.description);
                        $("#category").val(response.category);
                    }
                }
            })

    }

    function viewAddItem() {
        viewItem();
        $("#form-submit").fadeOut();
        $("#form-submit").html('Add Item').attr('onclick', 'addItem()').fadeIn();
    }

    function addItem() {
        event.preventDefault();

        var form = $("#contact")[0];
        var data = new FormData(form);
        var files = $("#file")[0].files[0];
        data.append('file', files);

        $("#btnSubmit").prop("disabled", true);

        $.ajax({
            entype: "multipart/form-data",
            url: "{{route('admin.add_items')}}",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                alert(data);
                $("#tableManager").modal('hide');
                get_order_user_item_count();
                showItems();
            }
        });
    }

    function updateItem() {
        var category = $('#category').val();
        if(category == "Select Category") {
            document.getElementById('error').innerHTML = "Please select a category!";
        } else {
            event.preventDefault();

            var form = $("#contact")[0];
            var data = new FormData(form);
            var files = $('#file')[0].files[0];
            data.append('file', files);
            
            $("#btnSubmit").prop("disabled", true);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{route('admin.update_item')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    alert(data);
                    $("#tableManager").modal('hide');
                    showItems();
                }
            });
        }  
    }

    function delete_item(itemID) {
        if(confirm("Are you sure to delete item?")) {
            $.ajax({
                url: "{{route('admin.delete_item')}}",
                type: "POST",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    key: 'deleteItem',
                    itemID: itemID
                },
                success: function (response) {
                    if(response) {
                        alert(response);
                        showItems();
                    }
                }
            })
        }
    }
</script>

{{View::make('footer')}}