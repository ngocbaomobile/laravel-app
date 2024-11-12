<x-layout>
    <a href="{{ URL::previous()}}">BACK</a>
    <h1>NAME: {{$product->name}}</h1>
    <p>DESCRIPTION: {{$product->description}}</p>
    <p>SIZE: {{$product->size}}</p>
    <a href="{{route('products.edit', $product->id)}}">EDIT</a>
</x-layout>