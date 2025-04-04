@extends('layouts.weblayout')
 @section('content')

 <center>
 <div style="margin-top:200px;text-align: center; padding: 20px; border: 1px solid #ddd; border-radius: 10px; max-width: 400px;  background: #f9f9f9;">
    <h2 style="color: #28a745;">🎉 Order Placed Successfully!</h2>
    <p>Your order <strong>#ORD_123456</strong> has been confirmed.</p>
    <p>Total Amount: <strong>₹1500</strong></p>
    <a href="/orders" style="display: inline-block; padding: 10px 20px; color: white; background: #28a745; text-decoration: none; border-radius: 5px;">View Orders</a>
</div>
</center>


 @endsection