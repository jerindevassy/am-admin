<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Agents;
use App\Models\User;
use App\Models\Customers;
use App\Models\sizes;
use App\Models\occasians;
use App\Models\order_items;
use App\Models\order_masters;
use App\Models\categories;
use App\Models\Banner;
use App\Models\products;
use App\Models\product_images;
use App\Models\Subbanner;
use App\Models\product_variant;

use Hash;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }
    public function agent(){
        $disctrict=DB::table('districts')->get();
        return view('agent.list',compact('disctrict'));
    }
    public function agentlist(){
        $agentList = DB::table('agents')
        ->join('districts', 'agents.district_id', '=', 'districts.id')
        ->select('agents.*', 'districts.district_name')
        ->orderBy('agents.id', 'desc')
        ->get();
    

        return view('agent.agentlist',compact('agentList'));
    }
    public function agentcreate(Request $request)
    {
        // Validate the request
        $request->validate([
            'agentname' => 'required|string|max:255',
            'phonenumber' => 'required|digits:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:30',
            'districtid' => 'required|integer',
            'area' => 'required|string|max:255',
            'adhar' => 'required|digits:12',
            'account_number' => 'required|numeric',
            'ifsc' => 'required|string|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'branch_name' => 'required|string|max:255',
        ]);
    
        // Create User
        $user = User::create([
            'name' => $request->agentname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Create Agent
        $agent = Agents::create([
            'name' => $request->agentname,
            'phone_number' => $request->phonenumber,
            'district_id' => $request->districtid,
            'address' => $request->area,
            'adhar_number' => $request->adhar,
            'account_number' => $request->account_number,
            'ifsc' => $request->ifsc,
            'branch_name' => $request->branch_name,
            'user_id' => $user->id,
            'join_date' => date('Y-m-d')
        ]);
    
        return redirect()->back();
    }
    public function customer(){
        $customer=DB::table('customers')
        ->leftJoin("users", "customers.user_id", "=", "users.id")
        ->select("customers.*", "users.name")
        ->orderBy('customers.id', 'DESC')
        ->get();
        return view('customers.customer',compact('customer'));
    }
  
    public function occasions(){
        $occasians=DB::table('occasians')
        ->orderBy('occasians.id', 'DESC')
        ->get();
        return view('Master.occasions',compact('occasians'));
    }
    public function occasiansinsert(Request $request){
        $validatedData = $request->validate([
            'occasians' => 'required',
            
        ]);
        $occasians=new occasians;
        $occasians->occasians=$request->occasians;
        
        $occasians->save();
        return redirect('occasions')->with('success', 'Occasian Added successfully!');
    }
    public function occasiansfetch(Request $request){
        $id=$request->id;
        $occasians=occasians::find($id);
        print_r(json_encode($occasians));
    }
    public function occasiansedit(Request $request){
        $validatedData = $request->validate([
            'occasians' => 'required',
            
        ]);
        $id=$request->id;
        $occasians=occasians::find($id);
       
        $occasians->occasians=$request->occasians;
        
        $occasians->save();
        return redirect('occasions')->with('success', 'Occasian Edited successfully!');;
    }
    public function size(){
        $size=DB::table('sizes')
        ->orderBy('sizes.id', 'DESC')
        ->get();
        return view('Master.size',compact('size'));
    }
    public function sizeinsert(Request $request){
        $validatedData = $request->validate([
            'size' => 'required',
            
        ]);
        $size=new sizes;
        $size->size=$request->size;
        
        $size->save();
        return redirect('size')->with('success', 'Size Added successfully!');
    }
    public function sizefetch(Request $request){
        $id=$request->id;
        $size=sizes::find($id);
        print_r(json_encode($size));
    }
    public function sizeedit(Request $request){
        $validatedData = $request->validate([
            'size' => 'required',
            
        ]);
        $id=$request->id;
        $size=sizes::find($id);
       
        $size->size=$request->size;
        
        $size->save();
        return redirect('size')->with('success', 'Size Edited successfully!');;
    }
    public function orders()
    {
        $order = DB::table('order_masters')
            ->leftJoin('shipping_addresses', 'order_masters.address_id', '=', 'shipping_addresses.id')
            ->leftJoin('order_items', 'order_masters.order_id', '=', 'order_items.id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'order_masters.*',
                'order_items.price',
                'shipping_addresses.landmark',
                'products.product_name'
            )
            ->orderBy('order_masters.id', 'DESC')
            ->get();
    
        return view('order.orders', compact('order'));
    }
    
    public function orderstatusfetch(Request $request)
    {
        $id = $request->id;
        $status = order_masters::find($id);

        print_r(json_encode($status));
    }
    public function orderstatusedit(Request $request)
    {
        $id = $request->id;
        $status = order_masters::find($id);
        $status ->order_status = $request->order_status;
        $status ->save();

        return redirect("orders")->with("success", "Edited successfully");
    }
    public function vieworderitems($orderId)
    {
        $order = DB::table('order_masters')
            ->leftJoin('order_items', 'order_masters.id', '=', 'order_items.order_master_id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->where("order_masters.id", $orderId)

            ->select(
                'order_masters.*',
                'order_items.price',
                'order_items.qty',
                'order_items.total_amount',

                'products.product_name'
            )
            ->get();
    
        return view('order.vieworderitems', compact('order'));
    }
    
    public function subcategory($catId, $categoryname)
    {
       
        $markk = DB::table("categories")
        ->where("cat_id", $catId)
        ->orderBy("categories.id", "desc")
        ->get();
        

        return view("subcategory",compact('markk', "catId", "categoryname"));
    }
    public function subcategoryinsert(Request $request)
    {
        $mark = new categories();
        $mark->category_name = $request->subcategory_name;
        $mark->cat_id = $request->input("catid");
        if ($files = $request->file("subcategoryimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/categories/", $name);

            $mark->category_image = $name;
            $mark->save();}
            return back()->with(
                "success",
                "Subcategory inserted successfully."
            );
    }
    public function subcategoryfetch(Request $request)
    {
        $id = $request->id;
        $app = categories::find($id);
        print_r(json_encode($app));
    }

    public function subcategoryedit(Request $request)
    {
        $id = $request->id;
        $markk = categories::find($id);
        $markk->category_name = $request->subcategory_name;

        if ($files = $request->file("subcategoryimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/categories/", $name);
            $markk->category_image = $name;

        }
        $markk->save();

        return back()->with(
            "success",
            "Subcategory Edited successfully."
        );    }
    public function category()
    {
        $mark = DB::table("categories")
        ->where("cat_id",0)
        ->orderby('categories.id','DESC')->get();

        return view("category",compact('mark'));
    }
    public function categoryinsert(Request $request)
    {
        $mark = new categories();
        $mark->cat_id = 0;

        $mark->category_name = $request->category_name;
        if ($files = $request->file("categoryimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/categories/", $name);

            $mark->category_image = $name;
            $mark->save();}
            return redirect("category")->with(
                "success",
                "category inserted successfully."
            );
    }
    public function categoryfetch(Request $request)
    {
        $id = $request->id;
        $app = categories::find($id);
        print_r(json_encode($app));
    }

    public function categoryedit(Request $request)
    {
        $id = $request->id;
        $markk = categories::find($id);
        $markk->category_name = $request->category_name;

        if ($files = $request->file("categoryimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/categories/", $name);
            $markk->category_image = $name;

        }
        $markk->save();

        return redirect("category")->with(
            "success",
            "category edited successfully."
        );    }

        public function productcategory()
        {
            $mark = DB::table("categories")
                ->where("cat_id", 0) 
                ->get();
        
           
            $market = DB::table("categories as product_cat")
                ->join("categories as sub_cat", "product_cat.cat_id", "=", "sub_cat.id")
                ->join("categories as cat", "sub_cat.cat_id", "=", "cat.id")
                ->select(
                    "product_cat.id",
                    "product_cat.category_name as product_category_name",
                    "product_cat.category_image",
                    "sub_cat.category_name as subcategory_name",
                    "cat.category_name as category_name"
                )
                ->orderBy("product_cat.id", "desc")
                ->get();
        
            return view("productcategory", compact('mark', 'market'));
        }
        
        public function fetchsubcategory(Request $request)
        {
            $categoryId = $request->categoryId;
            $categorys = DB::table("categories")
                ->where("cat_id", $categoryId)
                ->select("id", "category_name")
                ->get();
            return response()->json($categorys);
        }
        public function fetchProductCategory(Request $request)
       {
        $subCategoryId = $request->subcategoryId;
        $productCategories = DB::table('categories')->where('cat_id', $subCategoryId)->get();
        return response()->json($productCategories);
        }

        public function productcategoryinsert(Request $request)
       {
        $request->validate([
                 'subcategory' => 'required|numeric|min:1',
                 'productcategory_name' => 'required|string|max:255',
                 'productcategoryimage' => 'required|image',
              ]);
        $mark = new categories();
        $mark->category_name = $request->productcategory_name;
        $mark->cat_id = $request->subcategory;
        if ($files = $request->file("productcategoryimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/categories/", $name);

            $mark->category_image = $name;
            $mark->save();}
            return back()->with(
                "success",
                "Product Category inserted successfully."
            );
        }
    
        public function getmarketsubcatlist(Request $request)
        {
            $subcatlist = DB::table("categories")
                ->where("cat_id", $request->cid)
                ->get();
    
            if ($subcatlist) {
                $namelist = "";
                foreach ($subcatlist as $key => $single) {
                    $namelist .=
                        '<option value="' .
                        $single->id .
                        '">' .
                        $single->category_name .
                        "</option>";
                }
            }
            return Response($namelist);
        }
        public function productcategoryfetch(Request $request)
        {
            $product = DB::table("categories")
                ->where("id", $request->id)
                ->first();
        
            if (!$product) {
                return response()->json(['error' => 'Product category not found.'], 404);
            }
        
            $subcategory = DB::table("categories")
                ->where("id", $product->cat_id)
                ->first();
        
            $maincat = $subcategory ? DB::table("categories")->where("id", $subcategory->cat_id)->first() : null;
        
            return response()->json([
                'id' => $product->id,
                'productcategoryname' => $product->category_name,
                'category_id' => $maincat ? $maincat->id : null,
                'subcategory_id' => $subcategory ? $subcategory->id : null,
                'image' => $product->category_image,
            ]);
        }
        public function productcategoryupdate(Request $request)
        {
            $request->validate([
                'id' => 'required|exists:categories,id',
                'category' => 'required|exists:categories,id',
                'subcategory' => 'required|exists:categories,id',
                'productcategoryname' => 'required|string|max:255',
                'productcategoryimage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        
            $updateData = [
                'cat_id' => $request->subcategory,
                'category_name' => $request->productcategoryname,
            ];
        
            if ($request->hasFile('productcategoryimage')) {
                $file = $request->file('productcategoryimage');
                $name = time() . '_' . $file->getClientOriginalName(); 
                $file->move(public_path('images/categories'), $name);
                $updateData['category_image'] = $name;
            }
        
            DB::table('categories')->where('id', $request->id)->update($updateData);
        
            return redirect()->back()->with('success', 'Product category updated successfully!');
        }
        
        public function banner()
        {
        $mark = DB::table("banners")
        ->orderby('banners.id','DESC')->get();
        return view("banner",compact('mark'));
        }
        public function bannerinsert(Request $request)
        {
        $mark = new Banner();
        if ($files = $request->file("bannerimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/Banner/", $name);
            $mark->banner_image = $name;
        }
        $mark->save();
            return redirect("banner")->with(
                "success",
                "Banner inserted successfully."
            );
          }
        public function bannerfetch(Request $request)
       {
        $id = $request->id;
        $app = Banner::find($id);
        print_r(json_encode($app));
       }

       public function banneredit(Request $request)
       {
        $id = $request->id;
        $markk = Banner::find($id);
        if ($files = $request->file("bannerimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/Banner/", $name);
            $markk->banner_image = $name;

        }
        $markk->save();

        return redirect("banner")->with(
            "success",
            "Banner edited successfully."
        );    }
        public function subbanner()
        {
            $mark = DB::table("subbanners")->orderBy('id', 'DESC')->get();
            $subBannerCount = count($mark); 
        
            return view("subbanner", compact('mark', 'subBannerCount'));
        }
        
        public function subbannerinsert(Request $request)
        {
        $mark = new Subbanner();
        if ($files = $request->file("subbannerimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/Banner/", $name);
            $mark->image = $name;
        }
        $mark->save();
            return redirect("subbanner")->with(
                "success",
                "Sub-Banner inserted successfully."
            );
          }
        public function subbannerfetch(Request $request)
       {
        $id = $request->id;
        $app = Subbanner::find($id);
        print_r(json_encode($app));
       }

       public function subbanneredit(Request $request)
       {
        $id = $request->id;
        $markk = Subbanner::find($id);
        if ($files = $request->file("subbannerimage")) {
            $name = $files->getClientOriginalName();
            $files->move("images/Banner/", $name);
            $markk->image = $name;

        }
        $markk->save();

        return redirect("subbanner")->with(
            "success",
            "Sub-Banner edited successfully."
        );    }
        
        public function product()
        {
            $markk = DB::table("occasians")
            ->get();
            $mark = DB::table("categories")
            ->where("cat_id", 0)
            ->get();
    
            return view("product",compact('mark','markk'));
        }
 
        
        public function productinsert(Request $request)
        {
          
            $brandprod = new Products();
            $brandprod->product_name = $request->product_name;
            $brandprod->product_code = $request->product_code;
            $brandprod->product_desc = $request->description;
            $brandprod->cat_id = $request->productcategory;
            $brandprod->best_sellers = $request->bestseller ?? 0;
            $brandprod->occasions = implode(',', $request->occasions ?? []);
        
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/products/'), $name);
                $brandprod->thumbnail = $name;
            }
        
            $brandprod->save(); 
        
            if ($request->hasFile('product_image')) {
                foreach ($request->file('product_image') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/products/'), $imageName);
                    DB::table('product_images')->insert([
                        'product_id' => $brandprod->id,
                        'product_image' => $imageName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        
            return redirect('product')->with('success', 'Product added successfully.');
        }
        
        public function productlist()
        {
            $markk = DB::table("categories")
            ->where("cat_id", 0) 
            ->get();
    
            $mark = DB::table("products")
            ->leftJoin('categories as pc', 'products.cat_id', '=', 'pc.id')         
            ->leftJoin('categories as sc', 'pc.cat_id', '=', 'sc.id')                
            ->leftJoin('categories as c', 'sc.cat_id', '=', 'c.id')                  
            ->orderBy("products.id", "desc")
            ->select(
                'products.*',
                'pc.category_name as product_category',
                'sc.category_name as subcategory',
                'c.category_name as category'
            )
            ->get();
    
            return view("productlist",compact('mark','markk'));
        }
 
        public function productfetch(Request $request)
        {
            $id = $request->id;
        
            $product = DB::table('products')
                ->leftJoin('categories as pc', 'products.cat_id', '=', 'pc.id')          
                ->leftJoin('categories as sc', 'pc.cat_id', '=', 'sc.id')              
                ->leftJoin('categories as c', 'sc.cat_id', '=', 'c.id')                  
                ->where('products.id', $id)
                ->select(
                    'products.*',
                    'pc.id as product_category_id',
                    'pc.category_name as product_category_name',
                    'sc.id as subcategory_id',
                    'sc.category_name as subcategory_name',
                    'c.id as category_id',
                    'c.category_name as category_name'
                )
                ->first();
        
            return response()->json($product);
        }   
        
        public function productedit(Request $request)
        {
         $id = $request->id;
         $markk = products::find($id);
         $markk->product_name = $request->product_name;
         $markk->cat_id = $request->productcategory;
         $markk->product_code = $request->product_code;
         if ($files = $request->file("thumbnail")) {
             $name = $files->getClientOriginalName();
             $files->move("images/products/", $name);
             $markk->thumbnail = $name;
 
         }
         $markk->save();
 
         return redirect("productlist")->with(
             "success",
             "Product edited successfully."
         );    }
         public function varients($productId, $productname)
         {
            
            $metal = DB::table("metals")
            ->get();
            $size= DB::table("sizes")
            ->get();
            $diamond= DB::table("diamond_types")
            ->get();
             $markk = DB::table("product_variants")
             ->leftJoin('sizes', 'product_variants.size_id', '=', 'sizes.id')          
             ->leftJoin('diamond_types', 'product_variants.diamond_type_id', '=', 'diamond_types.id')              
             ->leftJoin('metals', 'product_variants.metal_id', '=', 'metals.id')    
             ->where("product_id", $productId)
             ->orderBy("product_variants.id", "desc")
             ->select(
                'product_variants.*',
                'diamond_types.type',
                'metals.name',
                'sizes.size'
             )
             ->get();
            return view("varients",compact("markk", "productId", "productname",'diamond', "metal", "size"));
         }
         public function variantsfetch(Request $request)
         {
             $id = $request->id;
             $product =product_variant::find($id);
             print_r(json_encode($product));
         }   
         public function variantsedit(Request $request){
             $id=$request->id;
             $product=product_variant::find($id);  
             $product->mrp = $request->mrp;
             $product->selling_rate = $request->selling_rate;
             $product->product_id = $request->productid;
             $product->metal_id= $request->metal;
             $product->size_id= $request->size;
             $product->diamond_type_id = $request->diamond_type;
             $product->save();
             return redirect('productlist')->with('success','Product Variants Edited Successfully');
         } 

    
    public function logout(){
        Auth::logout();
        return redirect('index');
    }
}
