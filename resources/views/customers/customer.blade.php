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
                <h5>Customers List</h5>
              
              </div>
              <div class="card-body">
                <div class="dt-responsive table-responsive">
                  <table id="simpletable" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>User Name</th>
                     
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($customer as $key)
                      <tr>
                        <td>{{$key->customer_name}}</td>
                        <td>{{$key->phone_number}}</td>
                        <td>{{$key->name}}</td>
                        
                      </tr>
                     @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>User Name</th>
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