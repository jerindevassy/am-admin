<nav class="nav-root-wrapper-frame">
        <div class="nav-frame-4">
            <a href="{{url('index')}}">
            <img src="{{asset('web/assets/logo-original.png')}}" alt="Logo" class="nav-logo"></a>
            <div class="nav-frame-3">
              @foreach($categories as $cat)
              <a href="{{ url('productlist', $cat->id) }}" class="nav-item">{{ $cat->category_name }}</a>

                @endforeach
               
            </div>
        </div>
        @auth
        <div class="nav-frame-2" >
                <div class="wishlist-container" style="position: relative; display: inline-block;" onclick="openModal()">
            <img src="{{ asset('web/assets/likeicion.png') }}" alt="Like" class="nav-icon" width="30">
           
    @php 
    $id=Auth::user()->id;
    $wcount=DB::table('wishlists')->where('customer_id',$id)->count();
    @endphp
            <span id="wishlist-count" class="wishlist-badge">{{$wcount}}</span>
           
        </div> 

        <div class="modal" id="wishlistModal">
      <div class="modal-header">
          <h2>WISHLIST</h2>
          <button class="close-button" onclick="closeModal()">&times;</button>
      </div>
     
      @foreach($wishlist as $wlist)
      <div class="wishlist-item" id="wishlist_item_{{$wlist->id}}">
      
          <div class="item-content">
              <img src="{{asset('web/assets/images/products/'.$wlist->thumbnail)}}" alt="Product Image">
              <div class="item-details">
                  <h3>24KT SOLID GOLD</h3>
                  <p>{{$wlist->product_name}}</p>
                  <span class="item-price">MRP: ₹{{$wlist->mrp}}</span>
                  <span class="item-e-price">eStore Price: ₹{{$wlist->selling_rate}}</span>
              </div>
          </div>

          <div class="wishlist-actions">
              <button class="movetocart " data-id="{{$wlist->variant_id}}" data-value="{{$wlist->id}}">ADD TO CART</button>
              <button class="remove remove-wishlist" data-id="{{$wlist->id}}">REMOVE</button>
          </div>
      </div>
      @endforeach

      </div>
        
    
    @php 
    $id=Auth::user()->id;
    $count=DB::table('carts')->where('customer_id',$id)->count();
    @endphp
    <a href="{{url('cartlist')}}">
            <div class="cart-container" style="position: relative; display: inline-block;">
    <img src="{{ asset('web/assets/carticon.png') }}" alt="Cart" class="nav-icon" width="30">
    <span id="cart-count" class="cart-badge">{{$count}}</span>
    </div>
 </a>
    @endauth

            @auth
    <a href="{{url('profile')}}"><p>Welcome, {{ Auth::user()->name }}!</p></a>
@endauth

@guest
<a href="{{url('userLogin')}}"> <img src="{{asset('web/assets/profileicon.png')}}" alt="Profile" class="nav-icon"></a>
@endguest
           
            <div class="nav-hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <div class="nav-mobile-menu">
        <span class="nav-close-button">&times;</span>
        @foreach($categories as $cat)
        <a href="{{url('productlist')}}" class="nav-item">{{$cat->category_name}}</a>
                @endforeach
       
    </div>
