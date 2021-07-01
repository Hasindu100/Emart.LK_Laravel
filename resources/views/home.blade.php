{{View::make('header')}}

<!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <h4>Best Offer</h4>
            <h2>E-MART .LK</h2>
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <h4>Flash Deals</h4>
            <h2>Get your best products</h2>
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <h4>Last Minute</h4>
            <h2>Grab last minute deals</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
    <div class="container" style="margin-top:20px;">
      <div class="input-group" >
          <input type="search" class="form-control rounded" id="item" placeholder="Search Products" aria-label="Search" aria-describedby="search-addon" />
          <button type="button" class="btn btn-outline-primary" onclick="search_Item()">search</button>
      </div>
    </div>
    
    <div class="latest-products">
      <div class="container">
        
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="/product">view all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>

          @foreach ($products as $product)

            <div class="col-md-4">
              <div class="product-item">
                <a href="/single-page/{{ $product->id }}"><img src="{{asset('images')}}/{{$product->image}}" alt="" class="item-img"></a>
                <div class="down-content">
                  <a href="/single-page/{{ $product->id }}"><h4 style="width:70%;">{{ $product->name }}</h4></a>
                  <h6 style="width:20%">Rs:{{ $product->price }}/=</h6>
                  <!-- <p>{{ $product->description }}</p> -->
                  <a href="/single-page/{{ $product->id }}"><button id="form-submit" class="btn btn-outline-info"><i class="fa fa-eye"></i> See Item</button></a>
                </div>
              </div>
            </div>
         
          @endforeach
          

        </div>
      </div>
    </div>

    <div class="container">
      <div class="alert alert-secondary"><h5>Select category</h5></div>
      <!-- <h4>Select category</h4> -->
      <div class="row"> 
        <div class="col-md-3">
          <a href="">
            <div class="category-btn">
              ALL PRODUCTS<i class="fa fa-chevron-right"></i>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="">
            <div class="category-btn">
              GROCERRIES<i class="fa fa-chevron-right"></i>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="">
            <div class="category-btn">
              VEGITABLES/FRUITS<i class="fa fa-chevron-right"></i>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="">
            <div class="category-btn">
              MEAT FOODS<i class="fa fa-chevron-right"></i>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>About E-MART .LK</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4>Looking for the best products?</h4>
              <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">E-MART .LK</a> වෙබ් අඩවිය නිරමාණය කිරීමේ අපගේ ප්‍රධාන අරමුණ වනුයේ පවතින COVID 19 වසංගත තත්වය තුළ ඔබට ආරක්ෂිතව නිවසේ සිටම ඔබට අවශ්‍ය භාණ්ඩ මිලදී ගැනිමට අවස්ථාවක් සැලසීමයි. <a rel="nofollow" href="https://templatemo.com/contact">Contact us</a> for more info. මෙමගින් ඔබට,</p>
              <ul class="featured-list">
                <li><a href="#">ඔබට අවශය භාණ්ඩ පහසුවෙන් තෝරා ගැනීමට හැකිය</a></li>
                <li><a href="#">ඔබට අවශය භාණ්ඩ නිවසටම ගෙන්වා ගැනීමට හැකිය</a></li>
                <li><a href="#">භාණ්ඩ නිවසට ලැබුනු පසුව මුදල් ගෙවීමට හැකිය</a></li>
               
              </ul>
              <a href="about.html" class="filled-button">Read More</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="../images/undraw_shopping_app_flsj.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4><em>COVID 19</em> වෛරසයෙන් ආරක්ෂා වෙමු!</h4>
                  <p>පවතින COVID 19 වසංගත තත්වය තුළදී නිවසටම වී සිට ඔබගේ වගකීම ඉටු කරන්න.</p>
                </div>
                <div class="col-md-4">
                  <a href="#" class="filled-button"><i class="fa fa-arrow-up"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

    {{View::make('cart-btn')}}

    <script type="text/javascript">
      $(document).ready(function () {
        cartCount();
      });

      function search_Item() {
        const item = document.getElementById("item");
        const search_input = item.value;
        if(search_input != "") {
          location.replace("/get_search_item/"+search_input);
        }
      }


    </script>

{{View::make('footer')}}