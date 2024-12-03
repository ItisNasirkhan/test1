<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @php($route = isset($data) ? route('product.update') : route('product.store'))
                    <form method="post" action="{{$route}}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Product Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" placeholder="Enter product name" name="name"
                                   value="@isset($data->name) {{$data->name}} @endisset">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <!-- Category Dropdown -->
                        <div class="mb-3 mt-3">
                            <label for="category_id" class="form-label">Category:</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            @isset($data->category_id) 
                                                @if($data->category_id == $category->id) selected @endif
                                            @endisset>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                   id="price" placeholder="Enter price" name="price"
                                   value="@isset($data->price) {{$data->price}} @endisset">
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 mt-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                   id="quantity" placeholder="Enter quantity" name="quantity"
                                   value="@isset($data->quantity) {{$data->quantity}} @endisset">
                            @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <input type="hidden" name="id" value="@isset($data->id) {{$data->id}} @endisset">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
