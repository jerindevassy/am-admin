@extends('layouts.mainlayout')

@section('content')
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

      <div class="row">
          <!-- [ form-element ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Order Items List</h5>
              
              </div>

              <div class="card-body">
                <div class="dt-responsive table-responsive">
                  <table id="simpletable" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                      <th>Id</th>

            <th>Product Name</th>
            <th>Quantity</th>
           
            <th>Price</th>
            <th>Tax Amount</th>
           
            <th>Total Amount</th>
           
        </tr>
                     
                      </tr>
                    </thead>
                    <tbody>
                    @php
                     $i = 1;
                     @endphp
                      @foreach($order as $key)
                      <tr>
                      <td>{{$i}}</td>

                        <td>{{$key->product_name}}</td>
                        <td>{{$key->qty}}</td>
                        <td>{{$key->price}}</td>
                        <td>{{$key->tax}}</td>

                        <td>{{$key->total_amount}}</td>
                        

                      </tr>
                      @php
       $i++;
       @endphp
       @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>Id</th>

                      <th>Product Name</th>
            <th>Quantity</th>
           
            <th>Price</th>
            <th>Tax Amount</th>
           
            <th>Total Amount</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- [ form-element ] end -->
        </div>

      </div>
      @endsection