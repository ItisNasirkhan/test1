<<<<<<< HEAD
@if($products->isEmpty())
    <p>No products found.</p>
@else
    <ul class="list-group">
        @foreach($products as $product)
            <li class="list-group-item">
                <strong>{{ $product->name }}</strong> ({{ $product->price }})
            </li>
        @endforeach
    </ul>
@endif
=======
<div id="product-results" class="row mt-0">
    <!-- Results will be displayed dynamically by AJAX -->
</div>
>>>>>>> 3f48fa116454a9355d9739381e23d01fe8f38d1e
