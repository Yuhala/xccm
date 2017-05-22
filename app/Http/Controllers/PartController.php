<?php

namespace App\Http\Controllers;

use App\Part;
use Illuminate\Http\Request;

class PartController extends Controller
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
        $part = new Part();
        $part->title=$request->title;
        $part->course_id=$request->parent_id;
        $part->introduction="";
        $part->conclusion="";
        $part->save();

        return response()->json($part->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Part $part)
    {
        if($request->has("introconcl")){
            $response=new \stdClass();
            $response->introduction=$part->introduction;
            $response->conclusion=$part->conclusion;
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
    public function update(Request $request, Part $part)
    {
        if($request->has("title")){
            $part->title=$request->input("title");
            $part->save();
            return response()->json(true);
        }
        if($request->has("newparentid")){
            $part->course_id=$request->input("newparentid");
            $part->save();
            return response()->json(true);
        }
        if($request->has("introduction")){
            $part->introduction=$request->input("introduction");
            $part->save();
            return response()->json(true);
        }
        if($request->has("conclusion")){
            $part->conclusion=$request->input("conclusion");
            $part->save();
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
