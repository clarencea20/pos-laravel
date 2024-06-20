<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\SupplierModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class Product extends Controller
{
    public function index()
    {
        $products = ProductModel::with('supplier')->get();
        $products = ProductModel::orderBy('product_name', 'asc');
        $suppliers = SupplierModel::all();

        if(request()->has('search')){
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $products = $products->where(function($query) use($searchTerm) {
                    $query->where('products.product_name', 'like', "%$searchTerm%");
                });
            }
        }
        $products = $products->paginate(10)
            ->appends(['search' => request()->get('search')]);
            
        return view('product.index', compact('products', 'suppliers'));
    }
    
    public function show($id)
    {
        $product = ProductModel::find($id);
        return view('product.', compact('product'));
    }
    
    public function create() 
    {
       // return view('product.modal.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => ['required'],
            'product_price' => ['required'],
            'product_quantity' => ['required'],
            'supplier_id' => ['required'],
            'image' => ['nullable','mimes:jpeg,jpg,png,bmp,biff']
        ]);
        
         if($request->hasFile('image')) {
             $filenameWithExtension = $request->file('image');

             $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

             $extension = $request->file('image')->getClientOriginalExtension();

             $filenameToStore = $filename . '_' . time() . '.' . $extension;

             $request->file('image')->storeAs('public/img/product', $filenameToStore);

             $validated['image'] = $filenameToStore;
         }

         ProductModel::create($validated);
         Session::flash('success', 'Product Added Successfully!');
         return redirect('/products');//->with('status', 'Product Added Successfully!');
    }

    public function edit($id)
    {
        $product = ProductModel::find($id);
        return view('product.index', compact('product'));
    }

    public function update(Request $request, ProductModel $product)
    {
        $validated = $request->validate([
            'product_name' => ['required'],
            'product_price' => ['required'],
            'product_quantity' => ['required'],
            'supplier_id' => ['required'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png,bmp,biff', 'max:4096']
        ]);

        if($request->hasFile('image')) {
            $filenameWithExtension = $request->file('image');

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file('image')->getClientOriginalExtension();

            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            $request->file('image')->storeAs('public/img/product', $filenameToStore);

            $validated['image'] = $filenameToStore;
        }

        $product->update($validated);

        return redirect('/products')->with('success', 'Product Successfully Updated!');
    }

    public function delete($id)
    {
        $product = ProductModel::find($id);
        return view('product.index', compact('product'));
    }

    public function destroy(Request $request, ProductModel $product)
    {
        if($product->image && Storage::exists('public/img/product/' . $product->image)) {
            Storage::delete('public/img/product/' .$product->image);
        }
        
        $product->delete($request);
        return redirect('/products')->with('success', 'Product Successfully Deleted!');
    }
}
