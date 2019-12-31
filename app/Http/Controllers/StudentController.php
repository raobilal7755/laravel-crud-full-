<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $std=Student::latest()->paginate(3);
        return view('website.index',compact('std'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $image=$request->file('image');
        $my_image=rand().'.'. $image->getClientOriginalExtension();
        $image->move(public_path('upload'),$my_image);


        Student::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'address'=>$request->address,
            'image'=>$my_image,
        ]);
        return redirect()->route('student.index')->with('success','Sir data will inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('website.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('website.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
       $my_image=$request->my_image;
       
       $image=$request->file('image');
       if ($image!="") {
           $request->validate([
                "name"=>"required",
                "email"=>"required",
                "address"=>"required",
                "image"=>"image"
           ]);
           $my_image=rand().'.'. $image->getClientOriginalExtension();
           $image->move(public_path('upload'),$my_image);
       }else{
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "address"=>"required",
            
       ]);
       }
       
       
       
        $student->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "address"=>$request->address,
            "image"=>$my_image,
        ]);

       return redirect()->route('student.index')->with('success','Sir data will updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('error','Sir data will Deleted successfully');
    }
}
