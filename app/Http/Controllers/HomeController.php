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
                'shipping_addresses.area',
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
    public function logout(){
        Auth::logout();
        return redirect('index');
    }
}
