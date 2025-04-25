<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.html5.min.js')}}"></script>
  <!-- [Page Specific JS] start -->
  <script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/js/pages/dashboard-default.js')}}"></script>
  <!-- [Page Specific JS] end -->
  <!-- Required Js -->
  <script src="{{asset('assets/js/plugins/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/fonts/custom-font.js')}}"></script>
  <script src="{{asset('assets/js/pcoded.js')}}"></script>
  <script src="{{asset('assets/js/plugins/feather.min.js')}}"></script>

  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  <script>
  $(document).on('click', '.edit_size', function () {
    var id = $(this).data('id');
    if(id){
      $.ajax({
					type: "POST",
                    url: "{{ route('sizefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
		  $('#sizeid').val(obj.id); 
          $('#size').val(obj.size);
		
					},
					});	
		}
		$('#editsize_modal').modal('show');
	});
  $(document).on('click', '.close, .btn-secondary', function () {
    $('#editsize_modal').modal('hide');
});

 
  $(document).on('click', '.edit_occasians', function () {
    var id = $(this).data('id');
    if(id){
      $.ajax({
					type: "POST",
                    url: "{{ route('occasiansfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
		  $('#occasiansid').val(obj.id); 
          $('#occasians').val(obj.occasians);
		
					},
					});	
		}
		$('#editoccasians_modal').modal('show');
	});
  $(document).on('click', '.close, .btn-secondary', function () {
    $('#editoccasians_modal').modal('hide');
});


  $('.edit_return').click(function(){
        var id = $(this).data('id');
        if(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('orderstatusfetch') }}",
                data: {  
                    "_token": "{{ csrf_token() }}",
                    id: id 
                },
                success: function (res) {
                    console.log(res);
                    var obj = JSON.parse(res);
                    $('#return_id').val(obj.id);
                    $('#order_status').val(obj.order_status);
                },
            }); 
        }
        $('#editreturn_modal').modal('show');
    });

	
    $(document).on('click', '.close, .btn-secondary', function () {
    $('#editreturn_modal').modal('hide');
});

$('.edit_subcategory').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('subcategoryfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          //$('#image').val(obj.name);
		  $('#subcategoryid').val(obj.id);
          $('#subcategory_name').val(obj.category_name);

         
					},
					});	
		}
		$('#editsubcategory_modal').modal('show');
	});
  
  $(document).on('click', '.close, .btn-secondary', function () {
    $('#editsubcategory_modal').modal('hide');
});

$('.edit_category').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('categoryfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
		  $('#categoryid').val(obj.id);
          $('#category_name').val(obj.category_name);

         
					},
					});	
		}
		$('#editcategory_modal').modal('show');
	});
  
  $(document).on('click', '.close, .btn-secondary', function () {
    $('#editcategory_modal').modal('hide');
});


$('.subcategoryadd').on('change', function () {
    var categoryId = $(this).val();

    if (categoryId) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('fetchsubcategory') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                categoryId: categoryId
            },
            success: function (res) {
                console.log(res);
                $('#subcategory').empty();
				
                var html_each = "<option value='0'>Select subcategory</option>";
                $.each(res, function (key, value) {
                    html_each += '<option value=' + value.id + '>' + value.category_name + '</option>';
                });
                $('#subcategory').append(html_each);
				
            },
        });
     }
 });

$(document).ready(function () {

    $('.edit_productcategory').click(function () {
        let id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: "{{ route('productcategoryfetch') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            success: function (res) {
              
                $('#marketproid').val(res.id);
                $('#productcategoryname').val(res.productcategoryname);
                $('#category_name').val(res.category_id).trigger('change');
                 const subcategoryInterval = setInterval(function () {
                    if ($('#subcategory_name option').length > 1) {
                        $('#subcategory_name').val(res.subcategory_id);
                        clearInterval(subcategoryInterval);
                    }
                }, 100);

               
                $('#editproductcategory_modal').modal('show');
            }
        });
    });

   
    $('#category_name').on('change', function () {
        let categoryId = $(this).val();
        $('#subcategory_name').html('<option value="">Loading...</option>');

        $.ajax({
            type: "POST",
            url: "{{ route('getmarketsubcatlist') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                cid: categoryId
            },
            success: function (subcat) {
                $('#subcategory_name').html('<option value="">Select Subcategory</option>' + subcat);
            }
        });
    });

});


$(document).on('click', '.close, .btn-secondary', function () {
    $('#editproductcategory_modal').modal('hide');
});

$('.edit_banner').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('bannerfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
		  $('#bannerid').val(obj.id);
         
					},
					});	
		}
		$('#editbanner_modal').modal('show');
	});
  
  $(document).on('click', '.close, .btn-secondary', function () {
    $('#editbanner_modal').modal('hide');
});

$('.edit_subbanner').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('subbannerfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
		  $('#subbannerid').val(obj.id);
         
					},
					});	
		}
		$('#editsubbanner_modal').modal('show');
	});
  
  $(document).on('click', '.close, .btn-secondary', function () {
    $('#editsubbanner_modal').modal('hide');
});
    </script>