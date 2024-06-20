<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Supplier extends Controller
{
    public function index()
    {
        $suppliers = SupplierModel::orderBy('supplier_name', 'asc');

        if(request()->has('search')){
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $suppliers = $suppliers->where(function($query) use($searchTerm) {
                    $query->where('suppliers.supplier_name', 'like', "%$searchTerm%");
                });
            }
        }
        $suppliers = $suppliers->paginate(10)
            ->appends(['search' => request()->get('search')]);
            
        return view('supplier.index', compact('suppliers'));
    }

    public function show($id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.index', compact('supplier'));
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'supplier_name' => ['required'],
            'address' => ['required'],
            'contact_number' => ['required'],
            'email' => ['required'],
        ]);

        SupplierModel::create($validated);
        Session::flash('success', 'Supplier Added Successfully!');
        return redirect('/suppliers');//->with('status', 'User Added Successfully!');
    }

    public function update(Request $request, SupplierModel $supplier)
    {
        $validated = $request->validate([
            'supplier_name' => ['required'],
            'address' => ['required'],
            'contact_number' => ['required'],
            'email' => ['required'],
        ]);

        $supplier->update($validated);

        return redirect('/suppliers')->with('success', 'Supplier Successfully Updated!');
    }

    public function destroy(Request $request, SupplierModel $supplier)
    {
        $supplier->delete($request);
        return redirect('/suppliers')->with('success', 'Supplier Successfully Deleted!');
    }
}
