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
                <h5>Product List</h5>
              
              </div>
              <div class="card-body">
                <div class="dt-responsive table-responsive">


                <p align="right">



</div>
              </p>
</div>
             <div class="card-body">
 <table id="example1" class="table table-bordered table-striped">
  <thead>
<tr>
                     <th>id</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Thumbnail</th>
                    <th>Action</th>    
                    </tr>
                </thead>
                <tbody>
                     @php
                     $i = 1;
                     @endphp
   
                     @foreach($mark as $key)
   <tr>
       <td>{{ $i }}</td>
       <td>{{$key->product_code}}</td>
       <td>{{$key->product_name}}</td>
       <td>{{ $key->category }}</td>     

       <td>        <img src="{{ asset('/images/products/'.$key->thumbnail) }}" alt="" width="200" height="100" />
       </td>

   
           <td>
               <i class="fa fa-edit edit_product" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>
            
   </td>
   <td style="width: 50px;">

<a href="{{ route('varients', ['productId' => $key->id, 'productname' => $key->product_name]) }}" class="btn btn-success btn-sm order_trans">Add Varients</a>

</td>
 
    </tr>
       @php
       $i++;
       @endphp
       @endforeach
   </tbody>
                
              <tfoot>

                  <tr>
                  <th>id</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Thumbnail</th>
                    <th>Action</th>      

                  </tr>

                  </tfoot>

                </table>
				
                <div class="modal" id="editproduct_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <form method="POST" action="{{url('productedit')}}" enctype="multipart/form-data" name="productedit">

@csrf
      <div class="modal-body row">
<input type="hidden" name="id" id="productid">
<div class="form-group col-sm-12">
                <label class="exampleModalLabel">Main Category</label>
                <select name="category" id="category_name" class="form-control categorylist" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach($markk as $key)
                        <option value="{{ $key->id }}">{{ $key->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-12">
                <label class="exampleModalLabel">SubCategory</label>
                <select name="subcategory" id="subcategory_name" class="form-control" required>
                    <option value="" disabled selected>Select Subcategory</option>
                </select>
            </div>
            <div class="form-group col-sm-12">
  <label>Product Category</label>
  <select name="productcategory" id="productcategory" class="form-control" required>
    <option value="0">Select Product Category</option>
  </select>
</div>


<div class="form-group col-sm-12">
              <label>Product Code</label>
              <input class="form-control" name="product_code" id="product_code" placeholder="Enter Product Code" required>
            </div>

            <div class="form-group col-sm-12">
              <label>Product Name</label>
              <textarea class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" required></textarea>
            </div>
            <div class="form-group col-sm-12">
              <label>Thumbnail</label>
              <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
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