@extends('layouts.weblayout')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('web/css/pd.css') }}" />
@endpush




    <div class="nav-mobile-menu">
        <span class="nav-close-button">&times;</span>
        @foreach($categories as $cat)
        <a href="{{url('productlist')}}" class="nav-item">{{$cat->category_name}}</a>
                @endforeach
       
    </div>
    <!-- navigationbarsection End -->


    <div class="container">
        <div class="wrapper_name">← RINGS</div>


        <!-- Left Section: Product Images -->
        <div class="left-section">
            <img src="{{asset('web/assets/images/products/'.$products->thumbnail)}}" alt="Product Image" class="main-image">
            @php 
            $productImages=DB::table('product_images')->where('product_id',$products->id)->get();
            @endphp
            <div class="thumbnail-gallery">
                @foreach($productImages as $keyImages)
                <img src="{{asset('web/assets/images/products/'.$keyImages->product_image)}}" alt="Thumbnail 1">
                @endforeach
               
            </div>
        </div>

     

        <!-- Right Section: Product Details -->
        <div class="right-section">
            <p class="gold-type">24KT SOLID GOLD</p>
            <h1 class="product-title">{{$products->product_name}}</h1>

            <p class="mrp"><span>MRP:</span> <s>₹{{$products->mrp}}</s></p>
            <p class="estore-price">eStore Price: <strong>₹{{$products->selling_rate}}</strong></p>
            <p class="tax-info">Price inclusive of all taxes</p>

            <div class="ratings">
                <span class="star"><i class="fa-solid fa-star"></i> 4.9</span>
                <span class="reviews">| 211 Ratings</span>
            </div>

            <p class="stock-status">IN STOCK</p>

            <div class="customize-section">
                <p>CUSTOMISE:</p>
                <div class="custom-options">
                    <div class="option"><span>SIZE</span> <br> 12 (15.1 mm)</div>
                    <div class="option"><span>METAL</span> <br> 24kt Gold</div>
                    <div class="option"><span>DIAMOND</span> <br> IJ-SI</div>
                    <!-- <div class="option engravings"><span>ENGRAVINGS</span> <br> -NONE-</div> -->
                </div>
            </div>

            <div class="buttons">

                <button class="add-to-bag" data-id="{{$products->productId}}" ><i class="fa-solid fa-bag-shopping"></i> ADD TO BAG</button>

                <button class="wishlist" data-id="{{$products->productId}}"><i class="far fa-heart" style="color: white;"></i>
                </button>
                <button class="share"><i class="fas fa-share" style="color: white;"></i></button>
            </div>

            <div class="features">
                <div class="feature">
                    <i class="fas fa-certificate"></i>
                    <p>100% <br>CERTIFIED</p>
                </div>
                <div class="feature">
                    <i class="fas fa-undo"></i>
                    <p>15 DAY<br>MONEY BACK</p>
                </div>
                <div class="feature">
                    <i class="fas fa-exchange-alt"></i>
                    <p>LIFETIME<br>EXCHANGE</p>
                </div>
                <div class="feature">
                    <i class="fas fa-calendar-alt"></i>
                    <p>ONE YEAR<br>WARRANTY</p>
                </div>
            </div>

            <!-- Expandable Sections -->

            <div class="details">
                <!-- PRODUCT DETAILS -->
                <div class="details-section">
                    <h3>PRODUCT DETAILS</h3>
                    <span class="toggle-icon">＋</span>
                </div>
                <div class="details-content">
                    <p><strong>SKU:</strong> {{$products->product_code}}</p>
                    <p>{{$products->product_desc}}</p>
                    <!-- <p>Handcrafted from 100% recycled 9 karat solid gold.</p>
                    <ul>
                        <li>9 karat solid yellow gold</li>
                        <li>Band width 6mm tapering to 2.2mm</li>
                        <li>Gemstone height 10mm, width 12mm</li>
                        <li>Rectangular London Blue Topaz in a half bezel setting</li>
                    </ul> -->
                </div>

                <!-- PROPERTIES -->
                <div class="details-section">
                    <h3>PROPERTIES</h3>
                    <span class="toggle-icon">＋</span>
                </div>
                <div class="details-content">
                     @foreach($properties as $boxList)
                    <span class="title"><i class="fa-solid fa-bag-shopping"></i>{{$boxList->metal_name}}</span>
                    <div class="properties-box">

                        <p><span>Dimensions:</span>{{$boxList->diamension}}</p>
                        <p><span>Weight:</span>{{$boxList->weight}}</p>
                        <p><span>Purity:</span>{{$boxList->purity}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      
    </div>

@endsection