<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::All();
        $sections = sections::All();
        return view('products.products',compact('products','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
        $request->validate([
            
            'product_name' => 'required|min:2|max:30',
            'description' => 'required|min:10|max:500'
        ],[
            'product_name.required' => 'لا يمكن ترك اسم المنتج فارغ',
            'product_name.min' => ' عذرا يجب ادخال اكثر من حرفين كاسم للمنتج',
            'product_name.max' => ' عذراً يجب الا يزيد اسم المنتج عن 30 حرف كاسم للمنتج',
            'description.required' => 'لا يمكن ترك الوصف فارغ',
            'description.min' => ' عذرا يجب ادخال اكثر من 10 احرف في الوصف',
            'description.max' => 'عذراً يجب الا يزيد اسم المنتج عن 500 حرف',

        ]);

        $check_name = sections::where('id',$request->sections_id)->first();
        // $check_name = sections::where('sections_id',$request->sections_id)->first();
        
        if($check_name == null ){
            return redirect()->back()->with('fai_edit_sections','هذا القسم غير موجود ');
        }

        products::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'sections_id' => $request->sections_id,
        ]);

        return redirect()->back()->with('success','تم اضافه المنتج بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;
        $request->validate([
            'product_name' => 'required|min:2|max:30',
            'description' => 'required|min:10|max:500',
            'section_name'=>'required'
        ],[
            'product_name.required' => 'لا يمكن ترك اسم المنتج فارغ',
            'product_name.min' => ' عذرا يجب ادخال اكثر من حرفين كاسم للمنتج',
            'product_name.max' => ' عذراً يجب الا يزيد اسم المنتج عن 30 حرف كاسم للمنتج',
            'description.required' => 'لا يمكن ترك الوصف فارغ',
            'description.min' => ' عذرا يجب ادخال اكثر من 10 احرف في الوصف',
            'description.max' => 'عذراً يجب الا يزيد اسم المنتج عن 500 حرف',
            'section_name.required'=>'لا مكن ترك القسم فارغ'
        ]);     
        

        $check_name = sections::where('section_name',$request->section_name)->first();
        
        if($check_name == null ){
            return redirect()->back()->with('fai_edit_sections','هذا القسم غير موجود ');
        }
        
        $sec_id = sections::where('section_name',$request->section_name)->first()->id;
        
        products::where('id',$request->pro_id)->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'sections_id'=>$sec_id
        ]);

        return redirect()->back()->with('success','تم تعديل المنتح');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        products::where('id',$request->pro_id)->delete();
        return redirect()->back()->with('success','تم حذف المنتج');
    }
}









