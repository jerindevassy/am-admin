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

	
    </script>