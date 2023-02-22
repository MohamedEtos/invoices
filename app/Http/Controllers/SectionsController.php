<?php

namespace App\Http\Controllers;

use App\Http\Requests\sectionsValidateRequest;
use App\Models\sections;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections_data = sections::all();
        return view('sections.sections',compact('sections_data'));
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
    public function store(sectionsValidateRequest $request)
    {
        
        // $validated = $request->validate([
        //     'section_name'=>'required|max:255|exists:sections,section_name|min:2'
        // ]);

            sections::create([
                'section_name'=>$request->section_name,
                'description' =>$request->description,
                'created_by'  =>Auth::user()->name
            ]);

            return redirect()->back()->with('success','تم اضافة القسم بنجاح');




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        
        $request->validate([

            'description'=>'required',
            'section_name'=>'required|max:30|min:2|unique:sections,section_name,'.$id,
            
        ],[
            
            'section_name.required' => 'تاكد من ادخال قيمة ',
            'section_name.unique' => 'هذه القسم موجود بالفعل ',
            'section_name.min' => 'يجب ادخال اسم قسم اكثر من حرفين ',
            'section_name.max' => 'يجب الا يزداد اسم القمسم عن 30 حرف ',    
            'description.required' => 'لا تترك الوصف فارغ',
            
        ]);

        sections::where('id' , $id)->update([

            'section_name' => $request->section_name,
            'description' => $request->description

        ]);

        return redirect()->back()->with('success','تم تعديل القسم بناج');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        if(Hash::check( $request->password_del , Auth::user()->password )){

            sections::where('id',$request->id)->delete();
            return redirect()->back()->with('delete','تم حذف قسم ' . $request->section_name);

        }else{

            return redirect()->back()->with('delete_faild','عذرا كلمه المرور غير صحيحة');
            
        };

    }
}
