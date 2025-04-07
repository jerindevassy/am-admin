<script src="{{asset('web/js/script.js')}}"></script>
<script src="{{asset('web/js/pdlist.js')}}"></script>
<script src="{{asset('web/js/pdetail.js')}}"></script>
<script src="{{asset('web/js/checkout.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).on('click', '.add-to-bag', function () {
    var id = $(this).data('id');

    $.ajax({
       
        url: "{{ route('check-auth') }}",
				
        method: 'GET',
       	
        success: function (response) {

          console.log(response);
         
            if (response.authenticated) {
                // User is logged in, proceed to add the item
                addToBag(id);
            } else {
                // Redirect to login if not authenticated
               
                window.location.href = "{{ url('userLogin') }}";

            }
        },
        error: function () {
            alert('Error checking authentication.');
        }
    });
});

$(document).on("click", ".incrementqty", function () {
    var id = $(this).data("id"); // Product ID
    var i = $(this).data("value"); // Index or unique identifier
    var qty = parseInt($("#quantity_" + i).val()); // Get current quantity and convert to integer

    $.ajax({
        url: "{{ route('check-auth') }}",
        method: "GET",
        success: function (response) {
            console.log(response);

            if (response.authenticated) {
                // User is logged in, proceed to increment quantity
                var newQuantity = qty + 1;

                $("#quantity_" + i).val(newQuantity); // Update input field
                $("#showqty_" + i).html(newQuantity); // Update displayed quantity

                // Call function to add to cart
                addToBag(id);
                location.reload();
            } else {
                // Redirect to login if not authenticated
                window.location.href = "{{ url('userLogin') }}";
            }
        },
        error: function () {
            alert("Error checking authentication.");
        }
    });
});


$(document).on("click", ".decrementqty", function () {
    var id = $(this).data("id"); // Product ID
    var i = $(this).data("value"); // Index or unique identifier
    var qty = parseInt($("#quantity_" + i).val()); // Get current quantity and convert to integer

    $.ajax({
        url: "{{ route('check-auth') }}",
        method: "GET",
        success: function (response) {
            console.log(response);

            if (response.authenticated) {
                // User is logged in, proceed to increment quantity
               
                var newQuantity = qty - 1;

                if(newQuantity<=0){
                  var newQuantity = 1;
                }

                $("#quantity_" + i).val(newQuantity); // Update input field
                $("#showqty_" + i).html(newQuantity); // Update displayed quantity

                // Call function to add to cart
                minusToBag(id);
            } else {
                // Redirect to login if not authenticated
                window.location.href = "{{ url('userLogin') }}";
            }
        },
        error: function () {
            alert("Error checking authentication.");
        }
    });
});
// Function to add the product to the bag
function addToBag(id) {
  //alert(id);
    $.ajax({
       
         type: "POST",

					url: "{{ route('add-to-bag') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
        success: function (response) {
            // alert(response.message);
            $('#cart-count').html(response.cart_count);
        },
        error: function () {
            alert('Failed to add item.');
        }
    });
}

function minusToBag(id){
  $.ajax({
       
       type: "POST",

        url: "{{ route('minusToBag') }}",
        data: {  "_token": "{{ csrf_token() }}",
        id: id },
      success: function (response) {
          // alert(response.message);
          if(response.cart_count == 0){
            location.reload();
          }
          $('#cart-count').html(response.cart_count);
      },
      error: function () {
          alert('Failed to add item.');
      }
  });
}

$(document).on('click', '.wishlist', function () {
    var id = $(this).data('id');

    $.ajax({
       
        url: "{{ route('check-auth') }}",
				
        method: 'GET',
       	
        success: function (response) {

          console.log(response);
         
            if (response.authenticated) {
                // User is logged in, proceed to add the item
                addToWishlist(id);
            } else {
                // Redirect to login if not authenticated
               
                window.location.href = "{{ url('userLogin') }}";

            }
        },
        error: function () {
            alert('Error checking authentication.');
        }
    });
});

// Function to add the product to the bag
function addToWishlist(id) {
  //alert(id);
    $.ajax({
       
         type: "POST",

					url: "{{ route('add-to-wishlist') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
        success: function (response) {
            // alert(response.message);
            $('#wishlist-count').html(response.wishlist_count);
        },
        error: function () {
            alert('Failed to add item.');
        }
    });
}

$(document).on('click','.action-btn-remove',function(){
  var id=$(this).data('id');
  var value=$(this).data('value');
  $.ajax({
       
       type: "POST",

        url: "{{ route('remove-cart') }}",
        data: {  "_token": "{{ csrf_token() }}",
        id: id },
      success: function (response) {
          // alert(response.message);
          $('#items_'+value).hide();
          location.reload();
      },
      error: function () {
          alert('Failed to add item.');
      }
  });
});
$(document).on('click','.updateDelivery',function(){
  var id=$(this).data('id');

  $.ajax({
       
       type: "POST",

        url: "{{ route('updateAd') }}",
        data: {  "_token": "{{ csrf_token() }}",
        id: id },
      success: function (response) {
         
          location.reload();
      },
      error: function () {
          alert('Failed to add item.');
      }
  });
});
$(document).on('click','.removeDelivery',function(){
  var id=$(this).data('id');

  $.ajax({
       
       type: "POST",

        url: "{{ route('removeAd') }}",
        data: {  "_token": "{{ csrf_token() }}",
        id: id },
      success: function (response) {
         
          location.reload();
      },
      error: function () {
          alert('Failed to add item.');
      }
  });
});


</script>