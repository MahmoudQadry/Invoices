<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections=Section::all();
        $products=Product::all();
        return view("products.products",compact("products","sections"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            "product_name"=>"required||string||unique:products,product_name",
            "desc"=>"required||string",
            "section_id"=>"required||exists:sections,id"
        ]);

        Product::create($data);
        session()->flash("success","created");
        return redirect("products");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
    {
        $id=$request["id"];
        $data=$request->validate([
            "product_name"=>"required||string||unique:products,product_name,".$request["id"],
            "desc"=>"required||string",
            "section_id"=>"required||exists:sections,id"
        ]);

        $product=Product::findOrFail($id);
        if (Auth::user()->id==$product->id) {
            $product->update([
                "product_name"=>$data["product_name"],
                "desc"=>$data["desc"],
                "section_id"=>$data["section_id"],
            ]);
            session()->flash("success","created successfully");
            return redirect("products");
        }
        session()->flash("error","you aren't the creator of this invoice");
        return redirect("products");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request["id"];
        $product = Product::findOrFail($id);
            $product->delete();
            session()->flash("success", "deleted successfully");
            return redirect("products");

    }
}
