<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    //
    public function index() {
        session()->put('page-title', 'Products');
        //$products = Product::orderBy('created_at','DESC')->get();
        $products = Product::paginate(6);
        
        return view('product', compact('products'), ['title' => 'all']);
    }

    public function product_category($cat="") {
        $products = Product::where('category',$cat)->paginate(6);
        return view('product', compact('products'), ['title' => $cat]);
    }

    public function single_page($id){
        $product = Product::find($id);
        return view('singlepage', compact('product'));
    }

    public function get_related_products(Request $req) {
        $products = Product::where('category',$req->category)->get();

        $response = "";
        $i = 0;
        foreach ($products as $product) {
            if($i == 3) break;
            $response .= '<div class="col-md-4">
            <div class="product-item">
                <a href="/single-page/'.$product->id.'"><img src="'.asset("images").'/'.$product->image.'" alt="" class="item-img"></a>
                <div class="down-content">
                <a href="/single-page/'.$product->id.'"><h4 style="width:70%">'.substr($product->name,0,20).'</h4></a>
                <h6 style="width:20%">Rs:'.$product->price.'/=</h6>
                
                <button type="submit" id="form-submit" class="btn btn-outline-primary" onclick="AddData()"><i class="fa fa-cart-plus"></i> Add to cart</button>
                
                </div>
            </div>
            </div>';
            $i++;
        }
        exit($response);
    }

    public function get_search_item($item) {
        $products = Product::where('name', 'like', '%' . $item . '%')->get();
        return view('search', compact('products'), ['title' => $item]);
    }
}
