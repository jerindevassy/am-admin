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
<div class="text-right mb-3">
  <a href="{{ url('productlist') }}" class="btn btn-info btn-sm">
    View Product List
  </a>
</div>

  <!-- [ form-element ] start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Add Product</h5>
      </div>
      <div class="card-body">
        <form method="POST" id="form1" action="{{url('productinsert')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="form-group col-sm-4">
              <label>Category</label>
              <select name="category" id="category" class="form-control subcategoryadd" required>
                <option value="0">Select Category</option>
                @foreach($mark as $key)
                <option value="{{ $key->id }}">{{ $key->category_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-sm-4">
              <label>Sub Category</label>
              <select name="subcategory" id="subcategory" class="form-control" required>
                <option value="0">Select Subcategory</option>
              </select>
            </div>

            <div class="form-group col-sm-4">
  <label>Product Category</label>
  <select name="productcategory" id="productcategory" class="form-control" required>
    <option value="0">Select Product Category</option>
  </select>
</div>


            <div class="form-group col-sm-6">
              <label>Product Code</label>
              <input class="form-control" name="product_code" placeholder="Enter Product Code" required>
            </div>

            <div class="form-group col-sm-6">
              <label>Product Name</label>
              <textarea class="form-control" name="product_name" placeholder="Enter Product Name" required></textarea>
            </div>

            <div class="form-group col-sm-12">
              <label>Product Description</label>
              <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
            </div>

            <div class="form-group col-sm-12">
  <label>Occasions</label>
  <div class="border p-3 rounded" style="background: #f8f9fa;">
    <div class="form-row">
      @foreach($markk as $key)
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="occasions[]" value="{{ $key->id }}" id="occasion{{ $key->id }}">
          <label class="form-check-label" for="occasion{{ $key->id }}">
            {{ $key->occasians }}
          </label>
        </div>
      @endforeach
    </div>
  </div>
</div>

<div class="form-group col-sm-12">
  <label>Best Seller</label>
  <div class="border p-3 rounded" style="background: #f8f9fa;">
    <div class="d-flex align-items-center">
      <span class="mb-0 mr-2">Best Seller</span>
      <input type="hidden" name="bestseller" value="0">
      <input type="checkbox" class="ml-2" name="bestseller" value="1" id="bestseller" style="width: 20px; height: 20px; margin-top: 0;">
    </div>
  </div>
</div>

<div class="form-group col-sm-6">
              <label>Thumbnail</label>
              <input type="file" name="thumbnail" accept="image/*" required>
            </div>

            <div class="form-group col-sm-12" id="image-upload-section">
  <label>Images</label>
  <div class="input-group mb-2">
    <input class="form-control" type="file" name="product_image[]" accept="image/*" required>
    <button type="button" class="btn btn-success add-more-image" style="margin-left:5px;">Add</button>
  </div>
</div>


          </div>
          <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
  
</div>
              </p>
</div>
          
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

  </div> 
  <script>
  $(document).on('click', '.add-more-image', function() {
    var imageField = `
      <div class="input-group mb-2">
        <input class="form-control" type="file" name="product_image[]" accept="image/*" required>
        <button type="button" class="btn btn-danger remove-image" style="margin-left:5px;">Remove</button>
      </div>
    `;
    $('#image-upload-section').append(imageField);
});

// Remove the added image field
$(document).on('click', '.remove-image', function() {
    $(this).closest('.input-group').remove();
});
</script>@endsection