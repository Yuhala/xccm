<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('course.courseManager');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("course.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator= Validator::make($request->all(),[
            "title"=>"required",
            "domain"=>"required"
        ]);
        if($validator->fails()){
            return redirect(route("course.create"))->withErrors($validator->errors());
        }

        $course=new Course($request->only(["title","domain"]));
        $course->author_id=Auth::id();
        $course->language="french";
        $structure=new \stdClass();
        $structure->text=$request->input('title');
        $structure->type="course";
        $structure->parent="#";
        $course->course_structure=json_encode($structure);
        $course->introduction="";
        $course->conclusion="";
        $course->save();

        $structure->id=$course->id;
        $a_attr=new \stdClass();
        $a_attr->remoteid=$course->id;
        $structure->a_attr=$a_attr;
        $course->course_structure=json_encode($structure);
        $course->save();

        return redirect("course.courseManager",$course->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Course $course)
    {
        if($request->has("introconcl")){
            $response=new \stdClass();
            $response->introduction=$course->introduction;
            $response->conclusion=$course->conclusion;
            return json_encode($response);
        }

        return view("composition.home", ["structure"=>$course->course_structure,"id"=>$course->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('course.courseManager',['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        if($request->has("structure")){
            $course->course_structure=$request->structure;
            $course->save();
            return "Opération réussie avec success";
        }
        if($request->has("introduction")){
            $course->introduction=$request->input("introduction");
            $course->save();
            return response()->json(true);
        }
        if($request->has("conclusion")){
            $course->conclusion=$request->input("conclusion");
            $course->save();
            return response()->json(true);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect('/home');
    }
}
