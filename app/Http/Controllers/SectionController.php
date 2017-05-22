<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $section = new Section();
        $section->title=$request->title;
        $section->chapter_id=$request->parent_id;
        $section->introduction="";
        $section->introduction="";
        $section->save();

        return response()->json($section->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Section $section)
    {
        if($request->has("introconcl")){
            $response=new \stdClass();
            $response->introduction=$section->introduction;
            $response->conclusion=$section->conclusion;
            return json_encode($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        if($request->has("title")){
            $section->title=$request->input("title");
            $section->save();
            return response()->json(true);
        }
        if($request->has("newparentid")){
            $section->chapter_id=$request->input("newparentid");
            $section->save();
            return response()->json(true);
        }
        if($request->has("introduction")){
            $section->introduction=$request->input("introduction");
            $section->save();
            return response()->json(true);
        }
        if($request->has("conclusion")){
            $section->conclusion=$request->input("conclusion");
            $section->save();
            return response()->json(true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
