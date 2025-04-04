@extends('layouts.weblayout')

@section('content')


    <!-- <div class="container">
      
        <div class="image-grid">
          @foreach($subcat as $scat)
          <div class="image-wrapper">
            <img src="{{asset('web/assets/images/wrapperimg1.jpeg')}}" alt="Gold Rings" />
            <span class="image-overlay"> {{$scat->category_name}}</span>
          </div>
          @endforeach
         
        </div>
      </div> -->

<section class="hederban-root-wrapper">
        <div class="hederban-grid-container">
           
            <div class="hederban-card hederban-card-large">
                <img src="{{asset('web/assets/jasmin-chew-UBeNYvk6ED0-unsplash.jpg')}}" alt="Earrings" class="hederban-card-image">
                <div class="hederban-overlay">
                    <div class="hederban-card-content">
                        <div class="hederban-category-line"></div>
                        <h2 class="hederban-category-title">EARRINGS</h2>
                    </div>
                </div>
            </div>
            <div class="hederban-card hederban-card-large">
                <img src="{{asset('web/assets/lilartsy-ZhmbakzCBtk-unsplash.jpg')}}" alt="Necklaces" class="hederban-card-image">
                <div class="hederban-overlay">
                    <div class="hederban-card-content">
                        <div class="hederban-category-line"></div>
                        <h2 class="hederban-category-title">NECKLACES</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="hederban-small-grid">
            <div class="hederban-card hederban-card-small">
                <img src="{{asset('web/assets/khaled-ghareeb-OI1MEinU9sQ-unsplash.jpg')}}" alt="Bangles" class="hederban-card-image">
                <div class="hederban-overlay">
                    <div class="hederban-card-content">
                        <div class="hederban-category-line"></div>
                        <h2 class="hederban-category-title">BANGLES</h2>
                    </div>
                </div>
            </div>
            <div class="hederban-card hederban-card-small">
                <img src="{{asset('web/assets/chuttersnap-NYqEk7a42yc-unsplash.jpg')}}" alt="Rings" class="hederban-card-image">
                <div class="hederban-overlay">
                    <div class="hederban-card-content">
                        <div class="hederban-category-line"></div>
                        <h2 class="hederban-category-title">RINGS</h2>
                    </div>
                </div>
            </div>
            <div class="hederban-card hederban-card-small">
                <img src="{{asset('web/assets/dimitri-photography-jEYYq9AjmTo-unsplash.jpg')}}" alt="Bracelets" class="hederban-card-image">
                <div class="hederban-overlay">
                    <div class="hederban-card-content">
                        <div class="hederban-category-line"></div>
                        <h2 class="hederban-category-title">BRACELETS</h2>
                    </div>
                </div>
            </div>
            <div class="hederban-card hederban-card-small">
                <img src="{{asset('web/assets/christian-lucas-LrQys_Ukuak-unsplash.jpg')}}" alt="Men's" class="hederban-card-image">
                <div class="hederban-overlay">
                    <div class="hederban-card-content">
                        <div class="hederban-category-line"></div>
                        <h2 class="hederban-category-title">MEN'S</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="carousel-container">
        <div class="header">
            <h2 class="bestsellers">BESTSELLERS</h2>
            <a href="#" class="view-all">VIEW ALL</a>
        </div>
        
        <div class="carousel-wrapper">
            <div class="carousel">
            @foreach($products as $singleProduct)
         
                <div class="carousel-item">
                <a href="{{url('productdetails/'.$singleProduct->id)}}">
                    <img src="{{asset('web/assets/images/products/'.$singleProduct->thumbnail)}}" alt="Sculptural Diamond Ring" class="product-image">
                    </a>
                    <div class="product-info">
                        <div class="product-title">{{$singleProduct->product_name}}</div>
                        <div class="product-price">₹{{$singleProduct->selling_rate}}</div>
                    </div>
                 
                </div>

                <!-- Repeat for other items -->
                @endforeach
            </div>

            <div class="carousel-controls">
                <button class="carousel-button prev">
                    <svg viewBox="0 0 24 24">
                        <path d="M15 18l-6-6 6-6"></path>
                    </svg>
                </button>
                <button class="carousel-button next">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 18l6-6-6-6"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- /* Product  Carousel Start */ -->
    <!-- /* bottam banner Start  */ -->
    <div class="bottambanner-root-wrapper">
        <div class="bottambanner-frame">
          <div class="bottambanner-content">
            <div class="bottambanner-text-container">
              <span class="bottambanner-main-title">
                Where timeless elegance meets Modern craftsmanship
              </span>
              <span class="bottambanner-subtitle">
                With 85 years of legacy in the diamond business, Cyril's is a name synonymous with trust and quality. At AMOKHA, we bring this rich heritage into creating exquisite diamond jewelry, blending tradition with innovation.
              </span>
            </div>
            <div class="bottambanner-cta-button">
              <span class="bottambanner-cta-text">
                FIND OUT MORE
              </span>
            </div>
          </div>
        </div>
        <div class="bottambanner-services-container">
          <div class="bottambanner-service-card">
            <div class="bottambanner-service-icon-container">
              <img src="{{asset('web/assets/qulityicon.png')}}" alt="Natural and Precious Stones">
            </div>
            <div class="bottambanner-service-text-container">
              <span class="bottambanner-service-title">
                Natural and Precious Stones
              </span>
              <span class="bottambanner-service-description">
                Each piece is crafted with carefully selected, high quality stones that stand the test of time
              </span>
            </div>
          </div>
          <div class="bottambanner-service-card">
            <div class="bottambanner-service-icon-container">
              <img src="{{asset('web/assets/dimonts.png')}}" alt="Lab-Grown Diamonds">
            </div>
            <div class="bottambanner-service-text-container">
              <span class="bottambanner-service-title">
                Lab-Grown Diamonds
              </span>
              <span class="bottambanner-service-description">
                Each piece is crafted with carefully selected, high quality stones that stand the test of time
              </span>
            </div>
          </div>
          <div class="bottambanner-service-card">
            <div class="bottambanner-service-icon-container">
              <img src="{{asset('web/assets/cutomcreation.png')}}" alt="Custom Creations">
            </div>
            <div class="bottambanner-service-text-container">
              <span class="bottambanner-service-title">
                Custom Creations
              </span>
              <span class="bottambanner-service-description">
                Each piece is crafted with carefully selected, high quality stones that stand the test of time
              </span>
            </div>
          </div>
          <div class="bottambanner-service-card">
            <div class="bottambanner-service-icon-container">
              <img src="{{asset('web/assets/back.png')}}" alt="Diamond Buy-Back">
            </div>
            <div class="bottambanner-service-text-container">
              <span class="bottambanner-service-title">
                Diamond Buy-Back
              </span>
              <span class="bottambanner-service-description">
                Each piece is crafted with carefully selected, high quality stones that stand the test of time
              </span>
            </div>
          </div>
          <div class="bottambanner-service-card">
            <div class="bottambanner-service-icon-container">
              <img src="{{asset('web/assets/old.png')}}" alt="Reimagining Old Ornaments">
            </div>
            <div class="bottambanner-service-text-container">
              <span class="bottambanner-service-title">
                Reimagining Old Ornaments
              </span>
              <span class="bottambanner-service-description">
                Each piece is crafted with carefully selected, high quality stones that stand the test of time
              </span>
            </div>
          </div>
        </div>
      </div>
    <!-- /* bottam banner End  */ -->
    <!-- /* Polisysection Start */ -->
    <div class="polisy-container">
        <h1 class="polisy-header-title">Start Fresh This Year</h1>

        <div class="polisy-product-images">
            <img src="{{asset('web/assets/sama-hosseini-U_hLxGtAN6U-unsplash.jpg')}}" alt="Product Image 1">
            <img src="{{asset('web/assets/brooke-cagle-kElEigko7PU-unsplash.jpg')}}" alt="Product Image 2">
            <img src="{{asset('web/assets/anna-tarazevich-dju8OGXEKEs-unsplash.jpg')}}" alt="Product Image 3">
            <img src="{{asset('web/assets/sama-hosseini-uesvB32vC6U-unsplash.jpg')}}" alt="Product Image 4">
            <img src="{{asset('web/assets/eric-fung-bTPCbB3kmbw-unsplash.jpg')}}" alt="Product Image 5">
            <img src="{{asset('web/assets/alvaro-o-donnell-ptoKHlOZqIM-unsplash.jpg')}}" alt="Product Image 6">
        </div>

        <div class="polisy-features">
            <div class="polisy-feature">
                <img src="{{asset('web/assets/warantyicon.png')}}" alt="Warranty Icon">
                <div class="polisy-feature-title">One Year Warranty*</div>
                <div class="polisy-feature-description">
                    We guarantee the quality and workmanship of this piece for one year.
                </div>
            </div>

            <div class="polisy-feature">
                <img src="{{asset('web/assets/shipingicon.png')}}" alt="Shipping Icon">
                <div class="polisy-feature-title">100% Certified & Free Shipping</div>
                <div class="polisy-feature-description">
                    Enjoy Free Shipping. 100% Certified for Your Peace of Mind.
                </div>
            </div>

            <div class="polisy-feature">
                <img src="{{asset('web/assets/returnicon.png')}}" alt="Return Icon">
                <div class="polisy-feature-title">15 Day Return*</div>
                <div class="polisy-feature-description">
                    Enjoy 15 Days to Return Your Purchase.<br>
                    (Terms & Conditions Apply)
                </div>
            </div>
        </div>
    </div>
    @endsection