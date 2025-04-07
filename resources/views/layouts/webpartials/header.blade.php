<nav class="nav-root-wrapper-frame">
        <div class="nav-frame-4">
            <a href="{{url('index')}}">
            <img src="{{asset('web/assets/amokahalogo.png')}}" alt="Logo" class="nav-logo"></a>
            <div class="nav-frame-3">
              @foreach($categories as $cat)
              <a href="{{ url('productlist', $cat->id) }}" class="nav-item">{{ $cat->category_name }}</a>

                @endforeach
               
            </div>
        </div>
        @auth
        <div class="nav-frame-2">
                <div class="wishlist-container" style="position: relative; display: inline-block;">
            <img src="{{ asset('web/assets/likeicion.png') }}" alt="Like" class="nav-icon" width="30">
           
    @php 
    $id=Auth::user()->id;
    $wcount=DB::table('wishlists')->where('customer_id',$id)->count();
    @endphp
            <span id="wishlist-count" class="wishlist-badge">{{$wcount}}</span>
           
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
