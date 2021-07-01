<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index() {
        session()->put('page-title','Admin');
        return view('admin');
    }

    public function order_user_item_count(Request $request) {
        $users = User::all();
        $products = Product::all();
        $orders = Order::all();

        $userCount = count($users);
        $productCount = count($products);
        $orderCount = count($orders);
        $jsonArray = array(
            "userCount" => $userCount,
            "productCount" => $productCount,
            "orderCount" => $orderCount
        );
        return response()->json($jsonArray);
    }

    public function show_users(Request $request) {
        $users = User::orderBy('created_at','DESC')->get();

        $response = "";
        foreach ($users as $user) {
            $response .= '<tr>
                            <td>'.$user->id.'</td>
                            <td>'.$user->name.'</td>
                            <td>
                                <button  value="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        <tr>  
                        ';
        }
        exit($response);
    }

    public function show_orders(Request $req) {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        $response = "";
        foreach($orders as $order) {
            $id = $order->id;
            $name = $order->name;
            $mobile = $order->mobile_no;
            $address = $order->address;
            $date = $order->created_at;

            $response .= '<tr>
                            <td id="order_'.$id.'">'.$id.'</td>
                            <td>'.$name.'</td>
                            <td>'.$mobile.'</td>
                            <td>'.$address.'</td>
                            <td>'.$date.'</td>
                            <td>
                                <button onclick="viewOrder('.$id.')" class="btn btn-success"><i class="fa fa-eye"></i></button>
                            </td>
                           <tr>  
                        ';
        }
        exit($response);
    }

    public function show_items(Request $req) {
        $products = Product::orderBy('created_at','DESC')->get();

        $response = "";
        foreach ($products as $product) {
            $id = $product->id;
            $image = $product->image;
            $name = $product->name;
            $price = $product->price;
            $category = $product->category;
            
            $response .= '<tr>
                            <td>'.$id.'</td>
                            <td><img src="'.asset("images").'/'.$image.'"  style="width:100px; height: 10vh"></td>
                            <td>'.$name.'</td>
                            <td>'.$price.'</td>
                            <td>'.$category.'</td>
                            <td>
                                <button onclick="viewItem('.$id.')" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                                <button onclick="delete_item('.$id.')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                            <tr>  
                        ';
        }
        exit($response);
    }

    public function add_items(Request $req) {
        $image = $req->file('file');
        
        $imageName = time().'.'.$image->extension();
      
        $image->move(public_path('images'),$imageName);

        $product = new Product();
        $product->name = $req->post('title');
        $product->image = $imageName;
        $product->price = $req->post('price');
        $product->description = $req->post('description');
        $product->category = $req->post('category');
        $create = $product->save();
        if($create) {
            $response = "Product Added Successfully";
        } else {
            $response = "Error";
        }
        exit($response);
        $response = $req->post['name'];
        exit($response);
    }

    public function view_order(Request $req) {
        $order_id = $req->orderID;
        /* if( Cart::where('order_id', $order_id)->where('status', '0')->exists()) {
            $items = Cart::where('order_id', $order_id)->where('status', '0')->get();
        } */
        $items = Cart::where('order_id', $order_id)->where('status', '0')->get();
        //exit($order_id);
        $response = "";
        $i=0;
        $len = count($items);
        $total_price = 0;
        $output = "";

        foreach($items as $item) {
            $price = $item->price;
            $quantity = $item->quantity;
            $total_price += $item->total_price;
            $item = $item->item_name;
            
            if($i == $len-1) {
                $output = '<tr>
                            <td colspan="2" align="right">Total Amount: Rs:'.$total_price.' /=</td>
                            </tr>';
            }

            $response .= '<tr>
                            <td>'.$item.'</td>
                            <td>Rs '.$price.'/= X '.$quantity.'</td>
                            </tr>
                            '.$output.'
                        ';
            $i++;
        }
        exit($response);
    }

    public function complete_order(Request $req) {
        $order_id = $req->orderID;

        $order = Order::find($order_id);
        $deleted = $order->delete();
        if($deleted) {
            $items = Cart::where('order_id', $order_id)->where('status', '0')->delete();
            if($items) {
                exit("Order is successfully completed!");
            }
        }
    }

    public function view_item(Request $req) {
        $id = $req->itemID;
        $product = Product::find($id);

        return response()->json($product);
    }

    public function update_item(Request $req) {
        $id = $req->itemid;
        $product = Product::find($id);

        if($_FILES['file']['name'] != "" && $_FILES['file']['error'] == 0) {
            $image = $req->file('file');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);
            $product->image = $imageName;
        }
        elseif($_FILES['file']['error'] == 1) {
            exit("This file could not be uploaded!");
        }
        $product->name = $req->title;
        $product->price = $req->price;
        $product->category = $req->category;
        $product->description = $req->description;
        $created = $product->save();
        if($created) {
            exit("Successfully Updated!");
        }
    }

    public function delete_item(Request $req) {
        $id = $req->itemID;
        $product = Product::find($id);
        unlink(public_path('images').'/'.$product->image);
        $deleted = $product->delete();
        if($deleted) {
            exit("Item deleted successfully!");
        }
    }
}
