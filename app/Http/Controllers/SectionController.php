<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view("section.all_section", compact("sections"));
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
        $data = $request->validate([
            "section_name" => "required||string||unique:sections,section_name",
            "desc" => "required||string",
        ]);
        // $section=Section::where("section_name","=",$request["section_name"])->exists();
        // if($section){
        //     session()->flash("error","this section already exist");
        //     return redirect("section");
        // }else{
        // }
        $data["created_by"] = Auth::user()->name;
        Section::create($data);
        session()->flash("success", "section created successfully");
        return redirect("section");
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request);
        $id = $request["id"];
        // dd($id);
        $data = $request->validate([
            "section_name" => "required||string||unique:sections,section_name," . $request["id"],
            "desc" => "required||string",
        ]);

        $section = Section::findOrFail($id);
        if (Auth::user()->name == $section->created_by) {
            $section->update([
                "section_name" => $data["section_name"],
                "desc" => $data["desc"],
                "created_by" => Auth::user()->name,
            ]);
            session()->flash("success", "created successfully");
            return redirect("section");
        }
        session()->flash("error", ["you aren't the creator of this invoice"]);
        return redirect("section");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request["id"];
        $section = Section::findOrFail($id);
        if (Auth::user()->name == $section->creatd_by) {
            $section->delete();
            session()->flash("success", "deleted successfully");
            return redirect("section");
        } else {
            session()->flash("error", "you aren't the creator of this invoice");
            return redirect("section");
        }
    }
    public function getproduct(Request $request)
    {
        $id=$request["id"];
        $products=Product::where("section_id",$id)->pluck("product_name","id");
        return json_encode($products);
    }
}
