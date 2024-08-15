<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $field = $request->validate([
            'name' => 'required|max:255',
            'is_publish' => 'boolean',
        ]);
    
        $field['is_publish'] = $field['is_publish'] ?? false;
    
        try {
          
            $category = Category::create($field);
    

            return response()->json(['Category' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create category', 'message' => $e->getMessage()], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
     return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $field = $request->validate([
            'name' => 'required|max:255',
            'is_publish' => 'boolean',
        ]);
    
        $field['is_publish'] = $field['is_publish'] ?? false;
    
        try {
          
            $category ->update($field);
    

            return response()->json(['Category' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create category', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
$category->delete();

return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
