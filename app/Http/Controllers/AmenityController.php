<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\AmenityImage;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'search_text' => 'nullable|string',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1',
        ]);
    
        $searchText = $validated['search_text'] ?? null;
        $perPage = $validated['per_page'] ?? 10; // Default records per page
        $page = $validated['page'] ?? 1; // Default page number
    
        // Query amenities
        $query = Amenity::with('images');
    
        // Apply search filter
        if (!empty($searchText)) {
            $query->where('name', 'LIKE', '%' . $searchText . '%');
        }
    
        // Paginate results
        $amenities = $query->paginate($perPage, ['*'], 'page', $page);
    
        // Return paginated response
        return response()->json($amenities);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'product_code' => 'required|string|unique:amenities',
            'unit_name' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'array',
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048', // max:2048 means that each file being uploaded must not exceed 2 MB in size (2048 KB = 2 MB).
            // 'files' => 'array',
            // 'files.*' => 'file|mimes:pdf,doc,docx|max:2048',

        ]);
    
        // Create the Amenity
        $amenity = Amenity::create([
            'name' => $validated['name'],
            'product_code' => $validated['product_code'],
            'unit_name' => $validated['unit_name'],
            'price' => $validated['price'],
        ]);
    
        // Handle Uploaded Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('amenities', 'public'); // Store in the 'public/amenities' directory
                AmenityImage::create([
                    'amenity_id' => $amenity->id,
                    'image_url' => $path,
                ]);
            }
        }
    
        return response()->json($amenity->load('images'), 201);
    }

    public function update(Request $request, $id)
    {
        $amenity = Amenity::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'product_code' => "sometimes|required|string|unique:amenities,product_code,{$id}",
            'unit_name' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'images' => 'array',
            'images.*' => 'string',
        ]);

        $amenity->update($validated);

        if (isset($validated['images'])) {
            AmenityImage::where('amenity_id', $amenity->id)->delete();
            foreach ($validated['images'] as $image) {
                AmenityImage::create([
                    'amenity_id' => $amenity->id,
                    'image_url' => $image,
                ]);
            }
        }

        return response()->json($amenity->load('images'));
    }

    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->delete();

        return response()->json(['message' => 'Amenity deleted']);
    }
}

