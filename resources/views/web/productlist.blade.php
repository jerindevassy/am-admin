@extends('layouts.weblayout')

@section('content')

    <!-- navigationbarsection End -->
 

    <div class="wrapper-productlist">
      
    <div class="container">
        <!-- Left Section: Text Content -->
        <!-- <div class="text-section">
          <h2>Rings</h2>
          <p>Discover silver and gold rings for every occasion.</p>
        </div> -->

        <!-- Right Section: Image Grid -->
        <div class="image-grid">
          @foreach($subcat as $scat)
          <div class="image-wrapper">
            <img src="{{asset('web/assets/images/categories/'.$scat->category_image)}}" alt="{{$scat->category_name}}" />
            <span class="image-overlay"> {{$scat->category_name}}</span>
          </div>
          @endforeach
         
        </div>
      </div>
      <div class="filters-container">
        <h2><i class="fas fa-filter"></i> HIDE FILTERS</h2>
        <div class="sort-bar">
          <p>24 Products</p>
          <select>
            <option>Sort By</option>
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
          </select>
        </div>
      </div>

      <!-- Main Content -->
      <div class="wrappertop">
        <!-- Sidebar Filters -->
        <div class="sidebar">
          <!-- Metal Filter -->
          <div class="sidebar-section">
            <h3>Metal <span class="toggle-btn">&#65291;</span></h3>
            <div class="filter-content">
              <p class="close-btn">Close</p>
              @foreach($metal as $keymetal)
              <label><input type="checkbox" /> {{$keymetal->name}}</label><br />
              @endforeach
            </div>
          </div>
          <!-- <div class="sidebar-section">
            <h3>Size <span class="toggle-btn">&#65291;</span></h3>
            <div class="filter-content">
              <p class="close-btn">Close</p>
              <input type="range" min="50000" max="150000" />
              <div class="range-values">
                <span>₹50,000</span>
                <span>₹1,50,000</span>
              </div>
            </div>
          </div> -->

          <!-- Material Filter -->
          <!-- <div class="sidebar-section">
            <h3>Material <span class="toggle-btn">&#65291;</span></h3>
            <div class="filter-content">
              <p class="close-btn">Close</p>
              <label><input type="checkbox" /> 18K Gold</label><br />
              <label><input type="checkbox" /> 24K Gold</label><br />
              <label><input type="checkbox" /> Sterling Silver</label>
            </div>
          </div> -->

          <!-- Category Filter -->
          <!-- <div class="sidebar-section">
            <h3>Category <span class="toggle-btn">&#65291;</span></h3>
            <div class="filter-content">
              <p class="close-btn">Close</p>
              <label><input type="checkbox" /> Rings</label><br />
              <label><input type="checkbox" /> Bracelets</label><br />
              <label><input type="checkbox" /> Necklaces</label>
            </div>
          </div> -->

          <!-- Sub-Category Filter -->
          <!-- <div class="sidebar-section">
            <h3>Sub-Category <span class="toggle-btn">&#65291;</span></h3>
            <div class="filter-content">
              <p class="close-btn">Close</p>
              <label><input type="checkbox" /> Solitaire</label><br />
              <label><input type="checkbox" /> Stackable</label><br />
              <label><input type="checkbox" /> Vintage</label>
            </div>
          </div> -->

          <!-- Occasion Filter -->
          <div class="sidebar-section">
            <h3>Occasion <span class="toggle-btn">&#65291;</span></h3>
            <div class="filter-content">
              <p class="close-btn">Close</p>
              @foreach($occasians as $oKey)
              <label><input type="checkbox" /> {{$oKey->occasians}}</label><br />
              @endforeach
           
            </div>
          </div>
        </div>
        <!-- Product Section -->
        <main class="products">
          <div class="product-grid">
            @foreach($products as $singleProducts)
              @php 
               $thumbnail=DB::table('product_images')->where('product_id',$singleProducts->id)->orderBy('id', 'desc')->first();

              @endphp
            <div class="product-card">
              <a href="{{ url('productdetails', $singleProducts->id) }}">
              <div class="image-container">
                <img
                  src="{{asset('web/assets/images/products/'.$singleProducts->thumbnail)}}"
                  alt="{{$singleProducts->product_name}}"
                  class="main-image"
                />
                <img
                  class="pd-image-overlay"
                  src="{{asset('web/assets/images/products/'.$thumbnail->product_image)}}"
                  alt="{{$singleProducts->product_name}}"
                />
              </div>
</a>
              <h3>{{$singleProducts->product_name}}</h3>
              <p class="metal">24K Gold</p>
              <p class="price">
                ₹{{$singleProducts->selling_rate}} <span class="old-price">₹{{$singleProducts->mrp}}</span>
              </p>
            </div>
            @endforeach
            
          </div>
        </main>
      </div>
    </div>
    <div class="load-more-container">
      <p class="p-count">9 of 34</p>
      <button class="load-more">Load More</button>
    </div>

    <!-- /* Product  Carousel Start */ -->
    <div class="carousel-container">
      <div class="header">
        <h2 class="bestsellers">BESTSELLERS</h2>
        <a href="#" class="view-all">VIEW ALL</a>
      </div>

      <div class="carousel-wrapper">
        <div class="carousel">
          <div class="carousel-item">
            <img
              src="{{asset('web/assets/product1.png')}}"
              alt="Sculptural Diamond Ring"
              class="product-image"
            />
            <div class="product-info">
              <div class="product-title">Sculptural Diamond Ring</div>
              <div class="product-price">₹20,000</div>
            </div>
          </div>
          <!-- Repeat for other items -->
          <div class="carousel-item">
            <img
              src="{{asset('web/assets/product2.png')}}"
              alt="Sculptural Diamond Ring"
              class="product-image"
            />
            <div class="product-info">
              <div class="product-title">Sculptural Diamond Ring</div>
              <div class="product-price">₹20,000</div>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="{{asset('web/assets/product3.png')}}"
              alt="Sculptural Diamond Ring"
              class="product-image"
            />
            <div class="product-info">
              <div class="product-title">Sculptural Diamond Ring</div>
              <div class="product-price">₹20,000</div>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="{{asset('web/assets/product4.png')}}"
              alt="Sculptural Diamond Ring"
              class="product-image"
            />
            <div class="product-info">
              <div class="product-title">Sculptural Diamond Ring</div>
              <div class="product-price">₹20,000</div>
            </div>
          </div>
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

    @endsection