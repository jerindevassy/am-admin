<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Auth;
use App\Models\Carts;
use App\Models\Wishlists;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addtobag(Request $request){
        $userId = Auth::user()->id;
        $product_id=$request->id;
        $cart = Carts::where('customer_id', $userId)
            ->where('product_id', $product_id)
            ->first();

if ($cart) {
    // Product already exists in cart, increase quantity
    $cart->increment('qty', 1); // Increments qty by 1
} else {
    // Product is not in cart, create a new entry
    $cart = new Carts();
    $cart->customer_id = $userId;
    $cart->product_id = $product_id;
    $cart->qty = 1;
    $cart->save();
}
$count=DB::table('carts')->where('customer_id',$userId)->count();
return response()->json([
    'message' => 'Cart updated successfully',
    'cart_count' => $count
]);
    }

    public function minusToBag(Request $request)
{
    $userId = Auth::id(); // Cleaner way to get user ID
    $productId = $request->id;

    $cart = Carts::where('customer_id', $userId)
        ->where('product_id', $productId)
        ->first();

    if ($cart) {
        if ($cart->qty > 1) {
            // Reduce quantity by 1 if greater than 1
            $cart->decrement('qty', 1);
        }
    }

    // Get updated cart count
    $cartCount = Carts::where('customer_id', $userId)->count();

    return response()->json([
        'message' => 'Cart updated successfully',
        'cart_count' => $cartCount
    ]);
}


    public function addtowishlist(Request $request){
        $userId = Auth::user()->id;
        $product_id=$request->id;
        $wishlist = Wishlists::where('customer_id', $userId)
            ->where('product_id', $product_id)
            ->first();

if ($wishlist) {
    return response()->json([
        'message' => 'Already In wishlist'
        
    ]);
} else {
    // Product is not in cart, create a new entry
    $wishlist = new Wishlists();
    $wishlist->customer_id = $userId;
    $wishlist->product_id = $product_id;
    $wishlist->qty = 1;
    $wishlist->save();
}
$count=DB::table('wishlists')->where('customer_id',$userId)->count();
return response()->json([
    'message' => 'wishlist updated successfully',
    'wishlist_count' => $count
]);
    }
    public function cartlist(){
        $userId = Auth::user()->id;
        $categories=DB::table('categories')->where('cat_id',0)->get();
        $shipping_Address = DB::table('customers')
        ->join('shipping_address', 'customers.shipping_addrees_id', '=', 'shipping_address.id') // Join customers with shipping_address
        ->join('districts', 'shipping_address.district_id', '=', 'districts.id') // Join shipping_address with districts
        ->where('customers.user_id', $userId)
        ->select(
            'customers.*',
            'shipping_address.landmark',
            'shipping_address.area',
            'shipping_address.zipcode',
            'districts.district as district_name'
        )
        ->first();
    

        $delivery_Address=DB::table('shipping_address')
        ->join('districts', 'shipping_address.district_id', '=', 'districts.id')
        ->where('customer_id',$userId)
        ->select(
            'shipping_address.*',
            'districts.district as district_name'
        )
        ->get();
        $cart = DB::table('carts')
        ->join('product_variants', 'carts.product_id', '=', 'product_variants.id') // Join with product_variants
        ->join('products', 'product_variants.product_id', '=', 'products.id') // Join with products
        ->where('carts.customer_id', $userId)
        ->select(
            'carts.*',
            'product_variants.id as variant_id',
            'products.product_code',
            'product_variants.mrp',
            'product_variants.selling_rate',
            'products.id as product_id',
            'products.product_name',
            'products.thumbnail'
        ) // Select necessary fields
        ->get();
    
        return view('web.cart',compact('categories','cart','delivery_Address','shipping_Address'));
    }
    public function removecart(Request $request)
{
    $userId = Auth::id(); // Get authenticated user ID
    $productId = $request->id;

    // Check if the item exists in the cart
    $cartItem = DB::table('carts')->where('customer_id', $userId)->where('product_id', $productId)->first();

    if ($cartItem) {
        // Delete the item from the cart
        DB::table('carts')->where('customer_id', $userId)->where('product_id', $productId)->delete();
        
        // Get updated cart count
        $cartCount = DB::table('carts')->where('customer_id', $userId)->count();

        return response()->json([
            'message' => 'Item removed successfully',
            'cart_count' => $cartCount // Return updated cart count
        ]);
    }

    return response()->json([
        'message' => 'Item not found in cart'
    ], 404);
}

public function checkout(){
   
    $userId = Auth::user()->id;
    $categories=DB::table('categories')->where('cat_id',0)->get();
    $shipping_Address = DB::table('customers')
    ->join('users', 'customers.user_id', '=', 'users.id')
    ->join('shipping_address', 'customers.shipping_addrees_id', '=', 'shipping_address.id') // Join customers with shipping_address
    ->join('districts', 'shipping_address.district_id', '=', 'districts.id') // Join shipping_address with districts
    ->where('customers.user_id', $userId)
    ->select(
        'customers.*',
        'shipping_address.landmark',
        'shipping_address.area',
        'shipping_address.zipcode',
        'shipping_address.phone_number',
        'districts.district as district_name',
        'users.email'
    )
    ->first();


    $delivery_Address=DB::table('shipping_address')
    ->join('districts', 'shipping_address.district_id', '=', 'districts.id')
    ->where('customer_id',$userId)
    ->select(
        'shipping_address.*',
        'districts.district as district_name'
    )
    ->get();
    $cart = DB::table('carts')
    ->join('product_variants', 'carts.product_id', '=', 'product_variants.id') // Join with product_variants
    ->join('products', 'product_variants.product_id', '=', 'products.id') // Join with products
    ->where('carts.customer_id', $userId)
    ->select(
        'carts.*',
        'product_variants.id as variant_id',
        'products.product_code',
        'product_variants.mrp',
        'product_variants.selling_rate',
        'products.id as product_id',
        'products.product_name',
        'products.thumbnail'
    ) // Select necessary fields
    ->get();
    return view('web.checkout',compact('categories','cart','delivery_Address','shipping_Address'));
}
public function ordernow(){

}

public function updateShippingAddress(Request $request)
{
    $userId = Auth::id(); // Get logged-in user ID
    $addressId = $request->id; // New shipping address ID

    // Update the customer's shipping_address_id
    DB::table('customers')
        ->where('user_id', $userId)
        ->update(['shipping_addrees_id' => $addressId]);

    return response()->json([
        'message' => 'Shipping address updated successfully'
    ]);
}
public function removeShippingAddress(Request $request){
    $userId = Auth::id(); // Get logged-in user ID
    $addressId = $request->id; // New shipping address ID

    // Update the customer's shipping_address_id
    DB::table('shipping_address')
        ->where('id', $addressId)
        ->delete();

    return response()->json([
        'message' => 'Shipping address deleted successfully'
    ]);
}
public function profile(){
    $userId = Auth::user()->id;
    $categories=DB::table('categories')->where('cat_id',0)->get();
    $district=DB::table('districts')->get();
    $shipping_Address = DB::table('customers')
    ->join('users', 'customers.user_id', '=', 'users.id')
    ->join('shipping_address', 'customers.shipping_addrees_id', '=', 'shipping_address.id') // Join customers with shipping_address
    ->join('districts', 'shipping_address.district_id', '=', 'districts.id') // Join shipping_address with districts
    ->where('customers.user_id', $userId)
    ->select(
        'customers.*',
        'shipping_address.landmark',
        'shipping_address.area',
        'shipping_address.zipcode',
        'shipping_address.phone_number',
        'districts.district as district_name',
        'users.email'
    )
    ->first();
    $delivery_Address=DB::table('shipping_address')
    ->join('districts', 'shipping_address.district_id', '=', 'districts.id')
    ->where('customer_id',$userId)
    ->select(
        'shipping_address.*',
        'districts.district as district_name'
    )
    ->get();
    return view('web.profile',compact('categories','shipping_Address','delivery_Address','district'));
}



}
