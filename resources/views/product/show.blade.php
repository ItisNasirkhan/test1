@extends('product.layout')
@section('content')
 
<div class="card">
  <div class="card-header">Product Page</div>
  <div class="card-body">
    
        <div class="card-body">
        <h5 class="card-title">Name : {{ $products->name }}</h5>
        <p class="card-text">Address : {{ $products->address }}</p>
        <p class="card-text">Mobile : {{ $products->mobile }}</p>
  </div>
       
    </hr>
  
  </div>
</div>