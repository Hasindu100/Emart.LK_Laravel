{{View::make('header')}}

<div class="products" style="margin-top:100px">
    <div class="container">
        <div class="result-title" style="text-align:center;border:1px solid #000;border-radius: 75px 75px"><h4>Search Results: {{$title}}</h4></div>
        <h6 style="margin-top:10px;margin-bottom:20px">Showing all {{($products) ? count($products) : 0 }} results</h6>
        <div class="row">
            <div class="col-md-12">
                <div class="filters-content">
                    <div class="row grid">

                        @if($products)
                            @foreach ($products as $product)

                            <div class="col-lg-4 col-md-4 all ">
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
                        @else
                            <div class="alert alert-info"><strong>No results!</strong></div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{View::make('footer')}}