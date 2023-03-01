<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Section::all();
        return view('sections.section',compact('sections'));
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

        $section=Section::where('section_name',$request->SectionName)->exists();
        if($section){
            return redirect()->back()->with('error','هذا القسم موجود مسابقا');
        }else{
            Section::create(
                [
                    'section_name'=>$request->SectionName,
                    'description'=>$request->Notes,
                    'created_by'=>Auth::user()->name
                ]
            );
            return redirect()->back()->with('add','تم اضافة القسم بنجاح ');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $section= Section::findorfail($id);
        return view('sections.edit',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $section=Section::findorfail($id);
        $section->update(
            [
                'section_name'=>$request->SectionName,
                'description'=>$request->Notes
            ]
        );
        return redirect()->route('section.index')->with('add','تم التعديل القسم بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $section=Section::findorfail($id);
         $section->delete();
        return redirect()->route('section.index')->with('add','تم حذف القسم بنجاح ');

    }
}
