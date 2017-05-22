<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Course;
use Illuminate\Http\Request;

class ChapterController extends Controller
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
        $chapter = new Chapter();
        $chapter->title=$request->title;
        $chapter->part_id=$request->parent_id;
        $chapter->introduction="";
        $chapter->conclusion="";
        $chapter->save();

        return response()->json($chapter->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Chapter $chapter)
    {
        if($request->has("introconcl")){
            $response=new \stdClass();
            $response->introduction=$chapter->introduction;
            $response->conclusion=$chapter->conclusion;
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
    public function update(Request $request, Chapter $chapter)
    {
        if($request->has("title")){
            $chapter->title=$request->input("title");
            $chapter->save();
            return response()->json(true);
        }
        if($request->has("newparentid")){
            $chapter->part_id=$request->input("newparentid");
            $chapter->save();
            return response()->json(true);
        }
        if($request->has("introduction")){
            $chapter->introduction=$request->input("introduction");
            $chapter->save();
            return response()->json(true);
        }
        if($request->has("conclusion")){
            $chapter->conclusion=$request->input("conclusion");
            $chapter->save();
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
