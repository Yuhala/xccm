<?php

namespace App\Http\Controllers;

use App\Notion;
use Illuminate\Http\Request;

class NotionController extends Controller
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
        //
        $notion= new \App\Notion();
        $notion->title=$request->input("title");
        $notion->section_id=$request->input("parent_id");
        $notion->content="";

        $notion->save();
        return response()->json($notion->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Notion $notion)
    {
        return $notion->content;
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
    public function update(Request $request, Notion $notion)
    {
        if($request->has("title")){
            $notion->title=$request->input("title");
            $notion->save();
            return response()->json(true);
        }
        if($request->has("newparentid")){
            $notion->section_id=$request->input("newparentid");
            $notion->save();
            return response()->json(true);
        }
        if($request->has("content")){
            $notion->content=$request->input("content");
            $notion->save();
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
