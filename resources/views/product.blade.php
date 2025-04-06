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
                <h5>Products</h5>
              
              </div>
              <div class="card-body">
                <div class="dt-responsive table-responsive">


                <p align="right">

 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Product</button>
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<form method="POST"  id="form1" action="{{url('productinsert')}}" enctype="multipart/form-data">

@csrf

<div class="modal-dialog modal-lg" role="document" style="width:80%;">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title" id="exampleModalLabel">Add Product</h5>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button>

</div>

<div class="modal-body row">

 
<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Product Name</label>
    
    <input class="form-control" name="product_name" placeholder="Enter Product Name" required>
 
</div>

                                 <div class="form-group col-sm-6">



<label class="exampleModalLabel">Product Code</label>
<input class="form-control" name="product_code" placeholder="Enter Product Code" required>
</div>


<div class="form-group col-sm-12">
    <label class="exampleModalLabel">Description</label>
    <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
</div>

<!-- <div class="form-group col-sm-6">



<label class="exampleModalLabel">Product MRP</label>



<input class="form-control" name="product_mrp" placeholder="Enter Product MRP" required>


</div>
<div class="form-group col-sm-6">



<label class="exampleModalLabel">Product Selling Price</label>



<input class="form-control" name="product_price" placeholder="Enter Product Selling Price" required>


</div> -->

              

<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Category</label>
    <select name="category" id="category" class="form-control subcategoryadd" required>
    <option value="0">Select Category</option>
    @foreach($mark as $key)
    <option value="{{ $key->id }}">{{ $key->category_name }}</option>
    @endforeach
    </select>
    </div>

<div class="form-group col-sm-6">
    <label class="exampleModalLabel">Sub Category</label>
    <select name="subcategory" id="subcategory" class="form-control" required>
        <option value="0">Select Subcategory</option>
    </select>
</div>
<div class="form-group col-sm-12">
<label class="exampleModalLabel">Thumbnail</label>
                <input type="file" name="thumbnail" accept="image/*" required>
              </div>
         
<div class="form-group col-sm-12">
  <label class="exampleModalLabel">Occasions</label>
  <div class="form-check">
    @foreach($markk as $key)
      <input class="form-check-input" type="checkbox" name="occasions[]" value="{{ $key->id }}" id="occasion{{ $key->id }}">
      <label class="form-check-label" for="occasion{{ $key->id }}">
        {{ $key->occasians }}
      </label>
      <br>
    @endforeach
  </div>
</div>

              <div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Image</label>

                    <input class="form-control" type="file" name="product_image[]" accept="image/*" multiple required>
                </div>
             
              
                                 </div>
    <div class="modal-footer">
       <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
                    <th>Category Name</th>
                    <th>Category Image</th>

                    <th>Action</th>    
                    </tr>
                </thead>
                    
               
                  <tfoot>

                  <tr>
                  <th>id</th>
                    <th>Category Name</th>
                    <th>Category Image</th>

                    <th>Action</th>    

                  </tr>

                  </tfoot>

                </table>
				
                <div class="modal" id="editcategory_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <form method="POST" action="" enctype="multipart/form-data" name="categoryedit">

@csrf
      <div class="modal-body row">
<input type="hidden" name="id" id="categoryid">

   
<div class="form-group col-sm-12">

<label class="exampleModalLabel">Category Name</label>



<input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name"  required>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Category Image</label>
                <input type="file" name="categoryimage" accept="image/*" id="categoryimage">
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