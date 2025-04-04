<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Auth;
use App\Models\Carts;
use App\Models\Wishlists;
use App\Models\Shipping_address;
use App\Models\Order_masters;
use App\Models\Order_items;

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
    public function movetobag(Request $request){
        $userId = Auth::user()->id;
        $product_id=$request->id;
        $wid=$request->wid;
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
$wcount=DB::table('wishlists')->where('customer_id',$userId)->count();
DB::table('wishlists')->where('id',$wid)->delete();

return response()->json([
    'message' => 'Cart updated successfully',
    'cart_count' => $count,
    'wishlist_count'=>$wcount
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
        ->join('shipping_addresses', 'customers.shipping_addrees_id', '=', 'shipping_addresses.id') // Join customers with shipping_address
        ->join('districts', 'shipping_addresses.district_id', '=', 'districts.id') // Join shipping_address with districts
        ->where('customers.user_id', $userId)
        ->select(
            'customers.*',
            'shipping_addresses.landmark',
            'shipping_addresses.area',
            'shipping_addresses.zipcode',
            'districts.district as district_name'
        )
        ->first();
    

        $delivery_Address=DB::table('shipping_addresses')
        ->join('districts', 'shipping_addresses.district_id', '=', 'districts.id')
        ->where('customer_id',$userId)
        ->select(
            'shipping_addresses.*',
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
        if (Auth::check()) {
            $userId = Auth::id(); // Shorter way to get user ID
            $wishlist = DB::table('wishlists')
                ->join('product_variants', 'wishlists.product_id', '=', 'product_variants.id')
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->select([
                    'wishlists.*',
                    'product_variants.id as variant_id',
                    'products.product_code',
                    'product_variants.mrp',
                    'product_variants.selling_rate',
                    'products.id as product_id',
                    'products.product_name',
                    'products.thumbnail'
                ])
                ->where('wishlists.customer_id', $userId)
                ->get();
        }else{
            $wishlist=0;
        }
    
        return view('web.cart',compact('categories','cart','delivery_Address','shipping_Address','wishlist'));
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

public function removewishlist(Request $request){
    $userId = Auth::id(); // Get authenticated user ID
    $wishlistId = $request->id;

    // Check if the item exists in the cart
    $wishlistItem = DB::table('wishlists')->where('id', $wishlistId)->first();

    if ($wishlistItem) {
        // Delete the item from the cart
        DB::table('wishlists')->where('id', $wishlistId)->delete();
        
        // Get updated cart count
        $wishlistCount = DB::table('wishlists')->where('customer_id', $userId)->count();

        return response()->json([
            'message' => 'Item removed successfully',
            'count' => $wishlistCount // Return updated cart count
        ]);
    }

    return response()->json([
        'message' => 'Item not found in Wishlist'
    ], 404);
}

public function checkout(){
   
    $userId = Auth::user()->id;
    $categories=DB::table('categories')->where('cat_id',0)->get();
    $shipping_Address = DB::table('customers')
    ->join('users', 'customers.user_id', '=', 'users.id')
    ->join('shipping_addresses', 'customers.shipping_addrees_id', '=', 'shipping_addresses.id') // Join customers with shipping_address
    ->join('districts', 'shipping_addresses.district_id', '=', 'districts.id') // Join shipping_address with districts
    ->where('customers.user_id', $userId)
    ->select(
        'customers.*',
        'shipping_addresses.landmark',
        'shipping_addresses.area',
        'shipping_addresses.zipcode',
        'shipping_addresses.phone_number',
        'districts.district as district_name',
        'users.email'
    )
    ->first();


    $delivery_Address=DB::table('shipping_addresses')
    ->join('districts', 'shipping_addresses.district_id', '=', 'districts.id')
    ->where('customer_id',$userId)
    ->select(
        'shipping_addresses.*',
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
    if (Auth::check()) {
        $userId = Auth::id(); // Shorter way to get user ID
        $wishlist = DB::table('wishlists')
            ->join('product_variants', 'wishlists.product_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select([
                'wishlists.*',
                'product_variants.id as variant_id',
                'products.product_code',
                'product_variants.mrp',
                'product_variants.selling_rate',
                'products.id as product_id',
                'products.product_name',
                'products.thumbnail'
            ])
            ->where('wishlists.customer_id', $userId)
            ->get();
    }else{
        $wishlist=0;
    }
    return view('web.checkout',compact('categories','cart','delivery_Address','shipping_Address','wishlist'));
}
public function ordernow(Request $request)
{
    $userId = Auth::id(); 
    $userId = Auth::user()->id;
    $categories=DB::table('categories')->where('cat_id',0)->get();
    if (Auth::check()) {
        $userId = Auth::id(); // Shorter way to get user ID
        $wishlist = DB::table('wishlists')
            ->join('product_variants', 'wishlists.product_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select([
                'wishlists.*',
                'product_variants.id as variant_id',
                'products.product_code',
                'product_variants.mrp',
                'product_variants.selling_rate',
                'products.id as product_id',
                'products.product_name',
                'products.thumbnail'
            ])
            ->where('wishlists.customer_id', $userId)
            ->get();
    }else{
        $wishlist=0;
    }

    // Get customer details
    $customer = DB::table('customers')->where('user_id', $userId)->first();
    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Fetch cart items
    $cart = DB::table('carts')
        ->join('product_variants', 'carts.product_id', '=', 'product_variants.id')
        ->join('products', 'product_variants.product_id', '=', 'products.id')
        ->where('carts.customer_id', $userId)
        ->select([
            'carts.*',
            'product_variants.id as variant_id',
            'products.product_code',
            'product_variants.mrp',
            'product_variants.selling_rate',
            'products.id as product_id',
            'products.product_name',
            'products.thumbnail'
        ])
        ->get();

    // Calculate total amount
    $total_amount = $cart->sum(fn($item) => $item->qty * $item->selling_rate);

    // Ensure cart is not empty
    if ($cart->isEmpty()) {
        return response()->json(['error' => 'Cart is empty'], 400);
    }

    // Start transaction to ensure data consistency
    DB::beginTransaction();
    try {
        // Create order
        $order = new Order_masters;
        $order->order_id = uniqid('ORD_'); // Unique Order ID
        $order->address_id = $customer->shipping_addrees_id;
        $order->total_amount = $total_amount;
        $order->tax = 0;
        $order->shipping_charge = 0;
        $order->final_amount = $total_amount;
        $order->payment_mode = 1; // 1 - COD, 2 - Online
        $order->payment_status = 0;
        $order->order_status = 0;

        if ($order->save()) {
            foreach ($cart as $item) {
                $orderItem = new Order_items;
                $orderItem->order_master_id = $order->id;
                $orderItem->product_id = $item->product_id;
                $orderItem->price = $item->selling_rate;
                $orderItem->qty = $item->qty;
                $orderItem->total_amount = $item->qty * $item->selling_rate;
                $orderItem->save();
            }

            // Clear the user's cart after placing the order
            DB::table('carts')->where('customer_id', $userId)->delete();

            // Commit transaction if everything is successful
            DB::commit();

            return redirect('payment-success');
         
            // return view('web.websucess',compact('categories','wishlist'));
        }
    } catch (\Exception $e) {
        DB::rollback();
        return view('web.websucess',compact('categories','wishlist'));
       // return response()->json(['error' => 'Order placement failed', 'details' => $e->getMessage()], 500);
    }
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
    DB::table('shipping_addresses')
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
    ->join('shipping_addresses', 'customers.shipping_addrees_id', '=', 'shipping_addresses.id') // Join customers with shipping_address
    ->join('districts', 'shipping_addresses.district_id', '=', 'districts.id') // Join shipping_address with districts
    ->where('customers.user_id', $userId)
    ->select(
        'customers.*',
        'shipping_addresses.landmark',
        'shipping_addresses.area',
        'shipping_addresses.zipcode',
        'shipping_addresses.phone_number',
        'districts.district as district_name',
        'users.email'
    )
    ->first();
    $delivery_Address=DB::table('shipping_addresses')
    ->join('districts', 'shipping_addresses.district_id', '=', 'districts.id')
    ->where('customer_id',$userId)
    ->select(
        'shipping_addresses.*',
        'districts.district as district_name'
    )
    ->get();
    if (Auth::check()) {
        $userId = Auth::id(); // Shorter way to get user ID
        $wishlist = DB::table('wishlists')
            ->join('product_variants', 'wishlists.product_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select([
                'wishlists.*',
                'product_variants.id as variant_id',
                'products.product_code',
                'product_variants.mrp',
                'product_variants.selling_rate',
                'products.id as product_id',
                'products.product_name',
                'products.thumbnail'
            ])
            ->where('wishlists.customer_id', $userId)
            ->get();
    }else{
        $wishlist=0;
    }
    return view('web.profile',compact('categories','shipping_Address','delivery_Address','district','wishlist'));
}
public function addDelivery(Request $request)
{
    $request->validate([
        'district' => 'required|integer|exists:districts,id',
        'landmark' => 'nullable|string|max:255',
        'area' => 'required|string|max:255',
        'zipcode' => 'required|string|max:10',
        'phonenumber' => 'required|string|max:15',
    ]);

    try {
        $userId = Auth::id();

        $address = Shipping_address::create([
            'customer_id' => $userId,
            'district_id' => $request->district,
            'landmark' => $request->landmark,
            'area' => $request->area,
            'zipcode' => $request->zipcode,
            'phone_number' => $request->phonenumber,
        ]);

        return response()->json([
            'message' => 'Delivery address added successfully',
            'data' => $address
        ], 201);
        
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to add delivery address',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function paymentsuccess(){
    $userId = Auth::user()->id;
    $categories=DB::table('categories')->where('cat_id',0)->get();
    if (Auth::check()) {
        $userId = Auth::id(); // Shorter way to get user ID
        $wishlist = DB::table('wishlists')
            ->join('product_variants', 'wishlists.product_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select([
                'wishlists.*',
                'product_variants.id as variant_id',
                'products.product_code',
                'product_variants.mrp',
                'product_variants.selling_rate',
                'products.id as product_id',
                'products.product_name',
                'products.thumbnail'
            ])
            ->where('wishlists.customer_id', $userId)
            ->get();
    }else{
        $wishlist=0;
    }
    return view('web.websucess',compact('categories','wishlist'));
}



}
