@extends('layouts.weblayout')
 @section('content')
 @push('cart')
<link rel="stylesheet" href="{{asset('web/css/cart.css')}}" />
<link rel="stylesheet" href="{{asset('web/css/checkout.css')}}" /> 
@endpush
<form action="{{ route('order-now') }}" method="POST">
    @csrf
<div class="container">


    <div class="left-section">
        <div class="section">
            <div class="section-title"><i class="fa-solid fa-user"></i> PROFILE</div>
            <div class="user-info">
                <div class="user-info-text">{{$shipping_Address->customer_name}} | +91 {{$shipping_Address->phone_number}}</div>
                <button class="change-button">CHANGE</button>
            </div>
        </div>

        <div class="section">
            <div class="section-title"><i class="fa-solid fa-house"></i> ADDRESS</div>
            <div class="address-info">
                <div class="address-info-text"> {{$shipping_Address->customer_name}} | +91 {{$shipping_Address->phone_number}} | {{$shipping_Address->area}}, {{$shipping_Address->landmark}}, {{$shipping_Address->zipcode}}1</div>
                <button class="change-button" onclick="openModal()">CHANGE</button>
            </div>
        </div>

        <div class="section">
            <div class="section-title"><i class="fa-solid fa-cart-shopping"></i> ORDER SUMMARY</div>
            @php $sum=0; $msum=0; $i=1; @endphp @foreach($cart as $list)
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

                <!-- <div class="action-buttons">
                    
                    <button class="action-btn-remove" data-value="{{$i}}" data-id="{{$list->variant_id}}">REMOVE</button>
                </div> -->

            </div>
            @php $sum= $sum + ($list->qty * $list->selling_rate); $msum= $msum + ($list->qty * $list->mrp); $i++; @endphp @endforeach
            <div class="confirm-order-section">
                <div>Order confirmation will be sent to: {{$shipping_Address->email;}}</div>
                <!-- <button class="confirm-order-button">CONFIRM ORDER</button> -->
            </div>
        </div>
    </div>
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
            <input type="hidden" name="total_amount" value="{{$sum}}">
        </div>
        <div class="save-message">You will save ₹{{$msum-$sum}} on this order</div>

    </div>
    <div class="bottom-section-payment-section">
        <a href="{{url('order-now')}}">
            <button class="pay-now-button">PAY NOW </button>
        </a>
        <div class="secure-payments"><i class='fas fa-handshake'></i>Secure payments, guaranteed authenticity and hassle-free returns </div>
    </div>
</div>
<div class="modal" id="addressModal">

    <div class="modal-header">
        <h2>DELIVERY ADDRESS LIST</h2>
        <!-- popup wishlist -->
        <button class="close-button" onclick="closeModal()">&times;</button>
    </div>
   

    <div class="address-list">

        <!-- Selected Address -->

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
                <button class="edit-btn updateDelivery" data-id="{{$list->id}}">SET AS DELIVERY ADDRESS</button>
                <button class="remove-btn removeDelivery" data-id="{{$list->id}}">REMOVE</button>

                @endif
            </div>
        </div>

        @endforeach

    </div>
</div>



</div>
</form>
@endsection