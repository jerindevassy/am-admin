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
                <h5>Varients</h5>
              
              </div>
              <div class="card-body">
                <div class="dt-responsive table-responsive">


                <p align="right">

 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Varients</button>
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<form method="POST"  id="form1" action="{{url('variantsedit')}}"  enctype="multipart/form-data">

@csrf

<div class="modal-dialog" role="document" style="width:80%;">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title" id="exampleModalLabel">Add Varients</h5>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button>

</div>

<div class="modal-body row">
<input type="hidden" value="{{$productId}}" name="productid">


                      <div class="form-group col-sm-12">
                                       <label class="exampleModalLabel">SubCategory Name</label>
                                       <input type="text" class="form-control" name="subcategory_name" placeholder="Enter SubCategory Name" required>
                                    </div> 
                      <div class="form-group col-sm-6">
                                       <label class="exampleModalLabel">SubCategory Image</label>
                                       <input type="file" name="subcategoryimage" accept="image/*" required>
                                       <small class="form-text text-muted">Recommended size: 500 × 300 pixels</small>
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
            <th colspan="7" style="text-align: center; background-color: white;">
                <h4 style="color: black;">Product Name: {{ $productname }}</h4>
            </th>
        </tr>
<tr>
                     <th>sl</th>
                    <th>Size</th>
                    <th>Metal</th>
                    <th>Diamond</th>
                    <th>MRP</th>
                    <th>Selling Rate</th>

                    <th>Action</th>    
                  </tr>
                </thead>
                <tbody>
                     @php
                     $i = 1;
                     @endphp
   
                     @foreach($markk as $key)
   <tr>
       <td>{{ $i }}</td>
      
       <td>{{$key->size}}</td>
       <td>{{$key->name}}</td>
       <td>{{$key->type}}</td>
       <td>{{$key->mrp}}</td>
       <td>{{$key->selling_rate}}</td>
       <td>
               <i class="fa fa-edit edit_variant" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
            
   </td>
  
    </tr>
       @php
       $i++;
       @endphp
       @endforeach
   </tbody>
                  <tfoot>

                  <tr>
                  
                  <th>sl</th>
                    <th>Size</th>
                    <th>Metal</th>
                    <th>Diamond</th>
                    <th>MRP</th>
                    <th>Selling Rate</th>

                    <th>Action</th>    

                  </tr>

                  </tfoot>

                </table>
				
                <div class="modal" id="editvariant_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit variant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <form method="POST" action="" enctype="multipart/form-data" name="variantedit">

@csrf
      <div class="modal-body row">
<input type="hidden" name="id" id="variantid">
<div class="form-group col-sm-12">
<label class="exampleModalLabel">Size</label>
<select name="size" id="size" class="form-control" required>
<option value=""disabled selected>Select Size</option>
@foreach($size as $sizee)
            <option value="{{ $sizee->id }}">{{ $sizee->size }}</option>
        @endforeach
</select>
</div>
<div class="form-group col-sm-12">
<label class="exampleModalLabel">Metal</label>
<select name="metal" id="metal" class="form-control" required>
<option value=""disabled selected>Select Metal</option>
@foreach($metal as $metals)
            <option value="{{ $metals->id }}">{{ $metals->name }}</option>
        @endforeach
</select>
</div><div class="form-group col-sm-12">
<label class="exampleModalLabel">Diamond Type</label>
<select name="diamond_type" id="diamond_type" class="form-control" required>
<option value=""disabled selected>Select Diamond Type</option>
@foreach($diamond as $types)
            <option value="{{ $types->id }}">{{ $types->type }}</option>
        @endforeach
</select>
</div>
<div class="form-group col-sm-12">
    <label class="exampleModalLabel">MRP</label>
    
    <input class="form-control" name="mrp" id="mrp" placeholder="Enter MRP" required>
 
</div><div class="form-group col-sm-12">
    <label class="exampleModalLabel">Selling Rate</label>
    
    <input class="form-control" name="selling_rate" id="selling_rate" placeholder="Enter Selling Rate" required>
 
</div>
</div>
  <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
   <!-- /.card-body -->

            </div>

            <!-- /.card -->

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->

      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div> @endsection