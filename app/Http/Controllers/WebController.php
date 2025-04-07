<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Customers;
use App\Models\Carts;
use Hash;
use Auth;


class WebController extends Controller
{
   public function index()
    {  
        $categories=DB::table('categories')->where('cat_id',0)->get();
        $subcat=DB::table('categories')->where('cat_id','!=',0)->get();
        $products = DB::table('products')
    ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
    ->select(
        'products.id',
        'products.product_name',
        'products.product_desc',
        'products.thumbnail', // Include thumbnail
        DB::raw('MIN(product_variants.mrp) as mrp'), 
        DB::raw('MIN(product_variants.selling_rate) as selling_rate')
    )
    ->where('products.best_sellers',1)
    ->groupBy('products.id', 'products.product_name', 'products.product_desc', 'products.thumbnail') // Include all non-aggregated columns
    ->get();

    
    

        //echo "<pre>";print_r($categories);exit;
        return view('web.index',compact('categories','subcat','products'));
    }
    public function productlist($id){
        $categories=DB::table('categories')->where('cat_id',0)->get();
        $subcat=DB::table('categories')->where('cat_id',$id)->get();
        $products = DB::table('products')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('categories', 'products.cat_id', '=', 'categories.id')
        ->select(
            'products.id',
            'products.product_name',
            'products.product_desc',
            'products.thumbnail',
            DB::raw('MIN(product_variants.mrp) as mrp'),
            DB::raw('MIN(product_variants.selling_rate) as selling_rate')
        )
        ->where('categories.cat_id', $id)
        ->groupBy('products.id', 'products.product_name', 'products.product_desc', 'products.thumbnail')
        ->get();
    
        $metal=DB::table('metals')->get();
        $occasians=DB::table('occasians')->get();
        return view('web.productlist',compact('categories','subcat','products','metal','occasians'));
    }
    public function productdetails($id){
        $categories=DB::table('categories')->where('cat_id',0)->get();
        $products = DB::table('products')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
        ->join('metals', 'product_variants.metal_id', '=', 'metals.id')
        ->join('diamond_types', 'product_variants.diamond_type_id', '=', 'diamond_types.id') // Join diamond_types table
        ->select(
            'products.*', 
            'sizes.size as size', 
            'metals.name as metal', 
            'diamond_types.type as diamond_type', // Fetch diamond type name
            'product_variants.id as productId',
            'product_variants.mrp', 
            'product_variants.selling_rate'
        )
        ->where('products.id',$id)
        ->first();

        $properties = DB::table('product_properties')
        ->join('metals', 'product_properties.metal_id', '=', 'metals.id') // Join metals table
        ->where('product_properties.product_id', $products->id)
        ->select(
            'product_properties.*', // Select all columns from product_properties
            'metals.name as metal_name' // Fetch metal name
        )
        ->get();
    
    
    
        return view('web.productdetails',compact('categories','products','properties'));
    }
    
    public function userLogin(){
        $categories=DB::table('categories')->where('cat_id',0)->get();
        return view('web.login',compact('categories'));
    }
    public function userRegister(){
        $categories=DB::table('categories')->where('cat_id',0)->get();
        return view('web.register',compact('categories'));
    }
    public function createUser(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
    
       
        DB::beginTransaction();
        try {
            // Create User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            // Create Customer Linked to User
            $customer = Customers::create([
                'customer_name' => $request->name,
                'user_id' => $user->id,
            ]);
    
            DB::commit(); 

            Auth::login($user);

            return redirect('/index');
        
    
           // return redirect('userLogin')->with('success', 'User registered successfully!');
            
        } catch (\Exception $e) {
            DB::rollBack(); 
    
            return redirect('userRegister')->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()]);
        }
      
    }
    public function checkauth(){
        return response()->json(['authenticated' => Auth::check()]);
    }

    public function ulogin(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            
            return redirect('/index');
        }
    
      //  return response()->json(['message' => 'Invalid credentials'], 401);
      return redirect('/userLogin');
       
    }
}
