@extends('layouts.weblayout')

@section('content')

@push('cart')
<link rel="stylesheet" href="{{asset('web/css/cart.css')}}" />
<link rel="stylesheet" href="{{asset('web/css/checkout.css')}}" />
@endpush
<div class="container">
        <div class="left-section">
            <div class="section">
                <div class="user-info">
                  <div class="user-info-wrapper">
                    <div class="user-info-delivery">Delivery by: Wednesday, Feb 26</div>
                    <div class="user-info-text">DELIVER TO: {{$shipping_Address->customer_name}}, {{$shipping_Address->area}}, {{$shipping_Address->landmark}},  {{$shipping_Address->zipcode}}</div>
                  </div>
                    <!-- <button class="change-button" onclick="openModal()">CHANGE</button> -->
                </div>
            </div>
            <div class="modal" id="addressModal">  
   
      <div class="modal-header">
        <h2>CHANGE DELIVERY ADDRESS</h2>
        <!-- popup wishlist -->
        <button class="close-button" onclick="closeModal()">&times;</button>
      </div>
      <button class="add-address-btn">
          ADD NEW ADDRESS <span>+</span>
         
      </button>

      <div class="address-list">

      @foreach($delivery_Address as $list)

          <!-- Selected Address -->
          <div class="address-card selected">
            @if($shipping_Address->shipping_addrees_id==$list->id)
              <p class="selected-label">SELECTED</p>
              @endif
          
              <p class="address">{{$list->area}}, {{$list->landmark}}, {{$list->district_name}}, {{$list->zipcode}}</p>
              <p class="phone">+91 <strong>{{$list->phone_number}}</strong></p>
              <hr>
              <div class="actions">
              @if($shipping_Address->shipping_addrees_id!=$list->id)
                  <button class="edit-btn">SET AS DELIVERY ADDRESS</button>
                  @endif
                  <button class="remove-btn">REMOVE</button>
              </div>
          </div>

          @endforeach

          <!-- Normal Address -->
          

      </div>
  </div>
            @php 
            $sum=0;
            $msum=0;
            $i=1;
            @endphp
            @foreach($cart as $list)
            <div class="section" id="items_{{$i}}">
               
                <div class="order-item">
                    <img src="{{asset('web/assets/images/products/'.$list->thumbnail)}}" alt="Product Image">
                    <div class="order-item-details">
                        <div class="order-caret">24KT SOLID GOLD</div>
                        <div class="order-name">{{$list->product_name}}</div>
                        <div class="order-price">MRP: ₹{{$list->mrp}}</div>
                        <div class="order-price-e">eStore Price: ₹{{$list->selling_rate}}</div>
                    </div>
                </div>
          
            <div class="bottom-section">
                <div class="quantity-controls">
                    <button class="quantity-btn decrementqty" data-value="{{$i}}" data-id="{{$list->variant_id}}">-</button>
                    <span id="showqty_{{$i}}">{{$list->qty}}</span>
                    <input type="hidden" id="quantity_{{$i}}" value="{{$list->qty}}">
                    <button class="quantity-btn incrementqty" data-value="{{$i}}" data-id="{{$list->variant_id}}" id="plusButton_{{$i}}">+</button>
                </div>
                
                <div class="action-buttons">
                    <!-- <button class="action-btn-later">SAVE FOR LATER</button> -->
                   <button class="action-btn-remove" data-value="{{$i}}" data-id="{{$list->variant_id}}">REMOVE</button>
                </div>
        </div>
        
        </div>
        @php 
        $sum= $sum + ($list->qty * $list->selling_rate);
        $msum= $msum + ($list->qty * $list->mrp);
        $i++;
        @endphp
        @endforeach
    </div>
        <div>
        <div class="right-section price-details">
            <div class="section-title price">PRICE DETAILS</div>
            <div class="price-row">
                <div>Price (1 item)</div>
                <div>₹ {{$sum}}</div>
            </div>
            <div class="price-row">
                <div>Discount</div>
                <div class="discount">-₹ {{$msum-$sum}}</div>
            </div>
            <div class="price-row">
                <div>Platform Fee</div>
                <div>₹0</div>
            </div>
            <div class="price-row">
                <div>Delivery Charge</div>
                <div class="free">Free</div>
            </div>
            <div class="total-amount price-row">
                <div>Total Amount</div>
                <div>₹{{$sum}}</div>
            </div>
            <div class="save-message">You will save ₹{{$msum-$sum}} on this order</div>
        </div>   
            <div class="bottom-section-payment-section">
            <a href="{{url('checkout')}}"><button class="pay-now-button">CHECKOUT <i class='fab fa-cc-amazon-pay'></i></button></a>
            <div class="secure-payments"><i class='fas fa-handshake'></i>Secure payments, guaranteed authenticity and hassle-free returns </div>
           </div>
        </div>
       
    </div>
     <!-- /* wish list pop up */ -->
    <div class="modal" id="wishlistModal">
      <div class="modal-header">
          <h2>WISHLIST</h2>
          <button class="close-button" onclick="closeModal()">&times;</button>
      </div>
      <div class="wishlist-item">
          <div class="item-content">
              <img src="product-image.jpg" alt="Product Image">
              <div class="item-details">
                  <h3>24KT SOLID GOLD</h3>
                  <p>Tiny Diamond Valentine Tag Ring - White Gold</p>
                  <span class="item-price">MRP: ₹50,000</span>
                  <span class="item-e-price">eStore Price: ₹45,000</span>
              </div>
          </div>
          <div class="wishlist-actions">
              <button>ADD TO CART</button>
              <button class="remove">REMOVE</button>
          </div>
      </div>

      </div>

      @endsection