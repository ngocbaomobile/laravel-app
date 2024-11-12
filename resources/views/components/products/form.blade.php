@csrf
<label for="name">Name</label>
<input type="text" name="name", id="name" value="{{ old('name', $product->name) }}">

<label for="description">Description</label>
<textarea name="description" id="description">{{ old('description') }}</textarea>

<label for="size">Size</label>
<input type="Text" name="size", id="size" value="{{ old('size') }}"></input>

<button>Save</button>