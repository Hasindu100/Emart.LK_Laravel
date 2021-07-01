<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index() {
        session()->put('page-title', 'Cart');
        
        return view('cart');
    }

    public function add_to_cart(Request $req) {
        $item_id = $req->itemID;
        $qty = $req->quantity;
        $user_id = session()->get('user-id');
        
        if(!session()->get('user-id')) {
            exit("Please login to add items!");
            die;
        } else {
            $item = Product::find($item_id);
            $item_name = $item->name;
            $price = $item->price;
            
            if(Cart::where('item_name',$item_name)->where('user_id', $user_id)->where('status', '1')->exists()) {
                $cart1 = Cart::where('item_name',$item_name)->where('user_id', $user_id)->where('status', '1')->get();
               
                $quantity = $qty + $cart1[0]->quantity;
                $total_price = $price * $quantity;
                
                $cart1[0]->quantity = $quantity;
                $cart1[0]->total_price = $total_price;
                $updated = $cart1[0]->save();
                if($updated) {
                    exit("Successfully added to the cart");
                    die;
                }
            } else {
                $total_price = $price * $qty;
                $cart2 = new Cart();

                $cart2->user_id = session()->get('user-id');
                $cart2->item_name = $item_name;
                $cart2->price = $price;
                $cart2->quantity = $qty;
                $cart2->total_price = $total_price;
                $cart2->status = 1;
                $cart2->order_id = 0;
                $created = $cart2->save();
                if($created) {
                    exit("Successfully added to the cart");
                }
            }
        }
        
    }

    public function get_data(Request $req) {
        $user_id = session()->get('user-id');
        $response = "";
        
        if(Cart::where('user_id', $user_id)->exists()) {
            $items = Cart::where('user_id', $user_id)->where('status', '1')->get();
            $i=0;
            $len = count($items);
            $total_price = 0;
            $output = "";

            foreach($items as $item) {
                
                $item_image = Product::where('name', $item->item_name)->first();
                $image = $item_image->image;
                $item_id = $item->id;
                $total_price += $item->total_price;
                /* Display Total Amount */
                if($i == $len-1) {
                    $output = '<tr>
                                    <td colspan="3" align="right">Total Amount</td>
                                    <th style="font-size:12px">Rs: '.$total_price.'/=</th>
                                <tr>
                                <tr>
                                    <td colspan="3">
                                        <button onclick="goBack()" class="btn btn-primary"><< Back to Shopping</button>
                                    </td>
                                    <td>
                                        <button onclick="show_model()" value="Order" class="btn btn-success" align="right">Order >></button>
                                    </td>
                                <tr>';
                        }
                        $response .= '
                        <tr>
                            <td id="country_'.$item_id.'">
                                <div class="cart-box">
                                    <div class="img-box">
                                        <img src="'.asset("images").'/'.$image.'" alt="">
                                    </div>
                                    <div class="detail-box">
                                        <div class="title">'.$item->item_name.'</div>
                                        <div class="price">Rs:'.$item->price.'/=</div>
                                    </div>
                                </div>
                            </td>
                            
                            <td style="margin-top:40px;vertical-align:middle">
                                <select name="qty" id="qty_'.$item_id.'" onchange="update_item('.$item_id.')">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td id="total_'.$item_id.'" style="font-size:13px;vertical-align:middle">'.$item->total_price.'</td>
                            <td class="delete" style="vertical-align:middle">
                                <i class="fa fa-trash" onclick="remove_item('.$item_id.')"></i>
                            </td>
                        </tr>
                        '.$output.'
                        <script type="text/javascript">
                        $(document).ready(function() {
                            document.getElementById("qty_'.$item_id.'").value = "'.$item->quantity.'";
                            });
                        </script>
                        ';
                $i++;
            }
            exit($response); 
        } 
    }

    public function remove_item(Request $req) {
        $id = $req->ItemID;
        $user_id = session()->get('user-id');

        $item = Cart::where('user_id',$user_id)->where('id', $id)->first();
        
        $deleted = $item->delete();
        //exit("DF");
        if($deleted) {
            exit("The Item has been deleted!");
        }
    }

    public function update_item(Request $req) {
        $id = $req->ItemID;
        $quantity = $req->quantity;
        $user_id = session()->get('user-id');

        $item = Cart::find($id);
        $item->quantity = "3";
        $item->total_price = $item->price * $quantity;
        $updated = $item->save();
        if($updated) {
            return response()->json($item);
        }
    }

    public function order_items(Request $req) {
        $name = $req->name;
        $mobile_no = $req->mobile_no;
        $address = $req->address;
        $user_id = session()->get('user-id');

        $order = new Order();
        $order->user_id = $user_id;
        $order->name = $name;
        $order->mobile_no = $mobile_no;
        $order->address = $address;
        $created = $order->save();
        if($created) {
            $order2 = Order::orderBy('created_at','DESC')->first();
            $order_id = $order2->id;

            $items = Cart::where('status', '1')->where('user_id', $user_id)->get();
            foreach($items as $item) {
                $item->status = "0";
                $item->order_id = $order_id;
                $item->save();
            }
            exit("Your order is completed!");
        }
    }

    public function remove_item2() {
        //$item_name = "Soya Meat - 100g";
        $id = "14";
        $user_id = session()->get('user-id');

        $item = Cart::where('user_id',$user_id)->where('id', $id)->first();
        $deleted = $item->delete();
        if($deleted) {
            exit("The Item has been deleted!");
        }
    }

    public function cart_count(Request $req) {
        $user_id = session()->get('user-id');
        $cart = Cart::where('user_id', $user_id)->where('status', '1')->get();
        $item_count = count($cart);
        $jsonArray = array(
            "item_count" => $item_count
        );
        return response()->json($jsonArray);
    }
}
