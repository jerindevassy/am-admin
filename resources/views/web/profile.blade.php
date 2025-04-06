@extends('layouts.weblayout')
 @section('content')
 @push('profile')
<link rel="stylesheet" href="{{asset('web/css/profile.css')}}" />
<link rel="stylesheet" href="{{asset('web/css/checkout.css')}}" />
@endpush
 <div class="profile-container">
        <!-- Sidebar -->
        <!-- <div class="sidebar">
            <div class="user-profile">
                <img src="profile-icon.svg" alt="User Icon" class="user-icon">
                <h2>Thomas Shelby</h2>
                <p>+91 9228883388</p>
            </div>
            <nav class="menu">
                <a href="#" class="menu-item">
                    <i class="fas fa-user"></i> Personal Information
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-box"></i> My Orders
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-map-marker-alt"></i> My Address
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-question-circle"></i> Help Center
                </a>
                <a href="#" class="menu-item logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
        </div> -->
        <div class="sidebar">
            <div class="user-profile">
                <img src="{{asset('web/assets/profileicon.png')}}" alt="User Icon" class="user-icon">
                <div class="user-info">
                    <h2>{{$shipping_Address->customer_name}}</h2>
                    <p>+91 {{$shipping_Address->phone_number}}</p>
                </div>

            </div>
            <nav class="menu">
                <a href="#personal_info" class="menu-item">
                    <div class="menu-left">
                        <i class="fas fa-id-card"></i> Personal Information
                    </div>
                    <span class="arrow">➜</span>
                </a>
                <a href="#" class="menu-item">
                    <div class="menu-left">
                        <i class="fas fa-box"></i> My Orders
                    </div>
                    <span class="arrow">➜</span>
                </a>
                <a href="#address_info" class="menu-item">
                    <div class="menu-left">
                        <i class="fas fa-map-marker-alt"></i> My Address
                    </div>
                    <span class="arrow">➜</span>
                </a>
                <a href="#" class="menu-item">
                    <div class="menu-left">
                        <i class="fas fa-question-circle"></i> Help Center
                    </div>
                    <span class="arrow">➜</span>
                </a>
                <a href="{{url('logout')}}" class="menu-item logout">
                    <div class="menu-left">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </div>
                    <a href="{{url('logout')}}"><span class="arrow">➜</span></a>
                </a>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="main-content" id="personal_info">
            <div class="header">
                <h3>PERSONAL INFORMATION</h3>
                <!-- <a href="#" class="edit-link">Edit</a> -->
            </div>
            <div class="form-container">
                <label>Name</label>
                <input type="text" value="{{$shipping_Address->customer_name}}" >

                <label>Phone Number</label>
                <input type="text" value="{{$shipping_Address->phone_number}}" disabled>

                <label>Email</label>
                <input type="email" value="{{$shipping_Address->email}}" disabled>

                <button class="save-btn">SAVE</button>
            </div>
        </div>
        <div class="main-content" id="address_info" style="display:none;">
            <div class="header">
                <h3>ADDRESS INFORMATION</h3>
                <!-- <a href="#" class="edit-link">Edit</a> -->
            </div>
            <button class="add-address-btn" onclick="openModal()">
        ADD NEW ADDRESS <span>+</span>

    </button>
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

<div class="modal" id="addressModal">

    <div class="modal-header">
        <h2>ADD DELIVERY ADDRESS </h2>
        <!-- popup wishlist -->
        <button class="close-button" onclick="closeModal()">&times;</button>
    </div>
   

    <form action="{{ route('addDelivery') }}" method="POST">
    @csrf

    <div class="form-container " style="margin-left:20px;">
        
 
                <label>District</label>
                <select name="district">
                    @foreach($district as $keyDis)
                    <option value="{{$keyDis->id}}">{{$keyDis->district}}</option>
                    @endforeach
                </select>
                
                <label>Area</label>
                <input type="text" name="area" required>

                <label>landmark</label>
                <input type="text" name="landmark" required>

                <label>Zipcode</label>
                <input type="text" name="zipcode" required>

                <label>Phone Number</label>
                <input type="number" name="phonenumber" required>


                <button class="save-btn" type="submit">SAVE</button>
               
            </div>
            </form>

</div>

</div>
        </div>
    </div>

@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuItems = document.querySelectorAll(".menu-item");
        const sections = document.querySelectorAll(".main-content");

        menuItems.forEach(item => {
            item.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent default anchor behavior

                const targetId = this.getAttribute("href").substring(1); // Get target ID (without #)

                // Hide all sections
                sections.forEach(section => {
                    section.style.display = "none";
                });

                // Show the selected section
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.style.display = "block";
                }
            });
        });
    });
</script>
