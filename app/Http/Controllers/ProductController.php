<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::get();
        return view('product.index',  compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch all categories
    return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validate = $request->validate([
                'name' => 'required|max:255',
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
                'category_id' => 'required|exists:categories,id',  // Validate category_id
            ]);
        
            try
            {
                if ($validate)
                {
                    Product::create([
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'category_id' => $request->category_id, // Store category_id here
                    ]);
                    Session::flash('message', 'Product created successfully!');
                    Session::flash('alert-class', 'alert-success');
                } else {
                    Session::flash('message', 'Error. Validation failed.');
                    Session::flash('alert-class', 'alert-danger');
                }
            } catch (\Exception $e)
            {
                Session::flash('message', 'Something went wrong. Please try again later.');
                Session::flash('alert-class', 'alert-danger');
            }
        
            return redirect(route('product.index'));
        }
        
        

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        return view('product.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Validate category_id
            Rule::unique('products')->ignore($request->id),
        ]);
    
        $data = Product::findOrFail($request->id);
        if ($data) {
            try
            {
                $data->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'category_id' => $request->category_id,  // Update category_id here
                ]);
                Session::flash('message', 'Product updated successfully!');
                Session::flash('alert-class', 'alert-success');
            } catch (\Exception $e)
            {
                Log::error('Update Failed. ' . $e->getMessage());
                Session::flash('message', 'Something went wrong. Please try again later.');
                Session::flash('alert-class', 'alert-danger');
            }
        } else {
            Session::flash('message', 'Invalid product ID');
            Session::flash('alert-class', 'alert-danger');
        }
    
        return redirect(route('product.index'));
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        try
        {
            $data->delete();
            Session::flash('message', 'Product deleted successfully!');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception $e)
        {
            Log::error('Delete operation failed. ' . $e->getMessage());
            Session::flash('message', 'Something went wrong. Please try again later.');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect(route('product.index'));
    }
}
