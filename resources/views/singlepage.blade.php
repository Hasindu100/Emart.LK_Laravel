{{View::make('header')}}

<style>
.item-info{
    margin-top:200px;
}
.image img {
    width: 500px;
    height: 40vh;
}
.item-name {
    font-size: 30px;
    color: #f33f3f;
}
.details {
    color: green;
}
.description {
    color: #aaa;
}

.item-price {
    font-size: 30px;
}

.quantity {
    color: #aaa;
}

.filled-button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 30%;
  border: 0;
  padding: 15px;
  margin-top: 10px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.alert-success {
    z-index:100000;
    top:0;
    position:fixed;
    width:30%;
    display:none
}

form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}

@media screen and (max-width: 768px) {
    .item-info{
        margin-top:100px;
    }
    .filled-button {
        width: 40%;
    }
    .image img {
        width: 300px;
        height: 30vh;
    }
    .filled-button {
        width: 60%;
    }
    .alert-success {
        width: 90%
    }
}

</style>

<div class="container item-info">
    <div class="row">
        <div class="col-md-6" style="text-align:center">
            <div class="image">
                <img src="{{asset('images')}}/{{$product->image}}" />
            </div>
        </div>
        <div class="col-md-6" style="text-align:center">
        <div class="alert alert-success" style="position:fixed"><strong>Successfully added to the cart!</strong></div>
            <div class="item-name" id="item-name">{{ $product->name }}</div>
            <div class="details">Delivery within 2-4 hours.</div>
            <div class="description" id="description">{{ $product->description }}</div>
            <div class="item-price" id="item-price">Rs:{{ $product->price }}/=</div>
            <div class="description" id="description">CATEGORY:{{ $product->category }}</div>
            <p class="quantity">Select Quantity</p>
            
                <input type="hidden" name="id" value="{{ $product->id }}" id="item-id">
                <select name="qty" id="qty">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><hr>
                <button type="submit" id="form-submit" class="filled-button" onclick="add_to_cart()"><i class="fa fa-cart-plus"></i> Add to cart</button>
        </div> 
    </div>
</div>

<div class="container" style="margin-top:50px">
    <div class="alert alert-secondary"><strong>RELATED PRODUCTS</strong></div>
    <div class="row" id="related-products"> 

    </div>
    <div class="alert alert-secondary">
    <div class="input-group">
        <input type="search" class="form-control rounded" id="item" placeholder="Search Products" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary" onclick="search_Item()">search</button>
      </div>
    </div>
</div>

<div class="container">
    <div class="alert alert-secondary"><h6>Select category</h6></div>
    <!-- <h4>Select category</h4> -->
    <div class="row"> 
        <div class="col-md-3">
            <a href="/product">
            <div class="category-btn">
                ALL PRODUCTS<i class="fa fa-chevron-right"></i>
            </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/product-category/{{'Grocerries'}}">
            <div class="category-btn">
                GROCERRIES<i class="fa fa-chevron-right"></i>
            </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/product-category/{{'Vegitables-Fruits'}}">
            <div class="category-btn">
                VEGITABLES/FRUITS<i class="fa fa-chevron-right"></i>
            </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/product-category/{{'Gas'}}">
            <div class="category-btn">
                MEAT FOODS<i class="fa fa-chevron-right"></i>
            </div>
            </a>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

{{View::make('cart-btn')}}

<script type="text/javascript">
    $(document).ready(function () {
        get_related_products();
    });

    function get_related_products() {
        var category = "{{ $product->category }}";
        var id = "{{ $product->id }}";
        
        $.ajax({
            url: "{{route('product.related_products')}}",
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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

    function search_Item() {
        const item = document.getElementById("item");
        const search_input = item.value;
        if(search_input != "") {
        location.replace("/get_search_item/"+search_input);
        }
    }

    function add_to_cart() {
        var name = $('#item-name');
        var Desc = $('#description');
        var price = $('#item-price');
        var itemID = $('#item-id');
        var quantity = $('#qty');
        var nam = document.getElementById('item-price').value;
        
        $.ajax({
            url: "{{route('cart.add_to_cart')}}",
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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
                        $('.alert-success').fadeIn(1000);
                        $('.alert-success').fadeOut(4000);
                        cartCount();
                    } else if(response == "Please login to add items!") {
                        window.location = "/login";
                    }
                    else {
                        alert(response);
                    }
                }    
        });      
    }

</script>

{{View::make('footer')}}