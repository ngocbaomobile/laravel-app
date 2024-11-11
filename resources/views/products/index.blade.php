
<x-layout>
<h1>
    Welcome to Products Page
</h1>

<a href="{{route('products.create') }}">Create Product</a>

@foreach ($products as $product )
<h2>Name: {{$product->name}}</h2>
    <p>Description: {{$product->description}}</p>
    <p>Size: {{$product->size}}</p>
@endforeach


</x-layout>
