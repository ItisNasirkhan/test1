<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Get the search term
        $searchTerm = $request->input('searchTerm');
    
        // Query the products and categories based on the search term
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('categories.name', 'LIKE', "%{$searchTerm}%")
            ->select('products.name as product_name', 'categories.name as category_name')
            ->get();
    
        // Return the filtered results
        return response()->json($products);
    }
}
