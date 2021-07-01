{{View::make('header')}}

<!-- Page Content -->
<div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new arrivals</h4>
              <h2>E-MART .LK products</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

<div id="page-scroll"></div>
<div class="products">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="filters"><?php $url = route('product.category',['category' => 'sa'])?>
            <ul>
                <a href="/product"><li class="@if($title == 'all') ? active : '' @endif">All Products</li></a>
                <a href="/product-category/{{'Grocerries'}}"><li class="@if($title == 'Grocerries') ? active : '' @endif">Grocerries</li></a>
                <a href="/product-category/{{'Vegitables-Fruits'}}"><li li class="@if($title == 'Vegitables-Fruits') ? active : '' @endif">Vegitables/Fuits</li></a>
                <a href="/product-category/{{'Meat-foods'}}"><li li class="@if($title == 'Meat-foods') ? active : '' @endif">Meat Foods</li></a>
            </ul>
        </div>
        </div>
        <div class="col-md-12">
        <div class="filters-content">
            <div class="row grid">
                @if ($products)
                
                @foreach ($products as $product)
                    
                    <div class="col-lg-4 col-md-4 all {{ $product->category }}">
                    <div class="product-item">
                        <a href="/single-page/{{ $product->id }}"><img src="{{asset('images')}}/{{$product->image}}" alt=""></a>
                        <div class="down-content">
                        <a href="/single-page/{{ $product->id }}"><h4>{{ $product->name }}</h4></a>
                        <h6>RS:{{ $product->price }}/=</h6>
                        <p>{{ $product->description }}</p>
                        <a href="/single-page/{{ $product->id }}"><button id="form-submit" class="btn btn-outline-info"><i class="fa fa-eye"></i> See Item</button></a>
                        </div>
                    </div>
                    </div>
                
                @endforeach
                @endif
    
            </div>
        </div>
        </div>
        <div class="col-md-12">
            <span>{{ $products->links('pagination') }}</span>
        </div>
    </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

{{View::make('cart-btn')}}

<script type="text/javascript">
    $(document).ready(function() {
    $("html,body").animate({
        scrollTop: $('#page-scroll').offset().top
    },500);
    
    });
</script>

<style>
    .w-5{
        display: none;
    }
</style>

{{View::make('footer')}}