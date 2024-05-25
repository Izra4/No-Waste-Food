<!-- resources/views/products/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
<h1>Create Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
    </div>

    <div>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
    </div>

    <div>
        <label for="image">Image:</label>
        <input type="text" id="image" name="image" required>
    </div>

    <div>
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" step="0.1" required>
    </div>

    <div>
        <label for="categories">Categories:</label>
        <select id="categories" name="categories[]" multiple required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Create Product</button>
</form>

</body>
</html>
