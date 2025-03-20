@extends('layouts.mainlayout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
           
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
      @if(session('success'))



<h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3>
@endif
      <div class="row">
          <!-- [ form-element ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Orders</h5>
              
              </div>
              <div class="card-body">
                <div class="dt-responsive table-responsive">


                <p align="right">

 <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Occasians</button> -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<form method="POST"  id="form1" action="" enctype="multipart/form-data">

@csrf

<div class="modal-dialog" role="document" style="width:80%;">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title" id="exampleModalLabel">Add Occasian</h5>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button>

</div>

<div class="modal-body row">


<div class="form-group col-sm-12">

<label class="exampleModalLabel">Occasian</label>

<input class="form-control" name="occasians" placeholder="Enter Occasian" required>

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary form1-submit">Add</button>
</div>
</div>
</div>
</form>
</div>
              </p>
</div>
             <div class="card-body">
 <table id="example1" class="table table-bordered table-striped">
  <thead>
<tr>
                     <th>id</th>
                    <th>Order Id</th>
                    <th>Product Name</th>

                    <th>Address</th>
                     <th>Total Amount</th>
                    <th>Tax</th>
                    <th>Shipping Charge</th>
                    <th>Final Amount</th>
                    <th>Payment Mode</th>
                     <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Action</th>    
                  </tr>
                </thead>
              
                     
                     <tbody>
                     @php
                     $i = 1;
                     @endphp
   
                     @foreach($order as $key)
   <tr>
       <td>{{ $i }}</td>
      
       <td>{{$key->price}}</td>
       <td>{{$key->product_name}}</td>

       <td>{{$key->area}}</td>
       <td>{{$key->total_amount	}}</td>
       <td>{{$key->tax}}</td>
       <td>{{$key->shipping_charge}}</td>
       <td>{{$key->final_amount	}}</td>
       <td>      @if($key->payment_mode==0) Cash on Delivery @else Online @endif
       </td>
       <td>
               @if($key->payment_status==0) Unpaid @else Paid @endif
           </td>  
                  <td>
                    @if ($key->order_status == 0)
                        Pending
                    @elseif ($key->order_status == 1)
                        Confirmed
                    @elseif ($key->order_status == 2)
                        Shipped
                    @elseif ($key->order_status == 3)
                        Delivered
                        @elseif ($key->order_status == 4)
                          Return
                   
                    @else
                    @endif
                </td>   
                <td> 
    <button class="btn btn-primary edit_return" data-toggle="modal" data-id="{{ $key->id }}"
            style="background: linear-gradient(45deg, #28a745, #28a745); color: #fff;">
            Update 
    </button>
 
    </tr>
       @php
       $i++;
       @endphp
       @endforeach
   </tbody>
                
               
                  <tfoot>

                  <tr>
                  <th>id</th>
                    <th>Order Id</th>
                    <th>Product Name</th>

                    <th>Address</th>
                     <th>Total Amount</th>
                    <th>Tax</th>
                    <th>Shipping Charge</th>
                    <th>Final Amount</th>
                    <th>Payment Mode</th>
                     <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Action</th>    
                  </tr>

                  </tfoot>

                </table>
				
              

<div class="modal" id="editreturn_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('orderstatusedit')}}" enctype="multipart/form-data" name="exeedit">

@csrf
      <div class="modal-body row">


      
<input type="hidden" name="id" id="return_id">



                    <div class="form-group col-sm-12">
                        <label class="exampleModalLabel">Order Status</label>
                        <select name="order_status" id="order_status" class="form-control" required>
                            <option value="0">Pending</option>
                            <option value="1">Confirmed</option>
                            <option value="2">Shipped</option>
                            <option value="3">Delivered</option>
                            <option value="4">Return</option> 
                        </select>
                    </div>

</div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

         

        <!-- /.row -->

      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div> @endsection