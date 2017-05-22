<?php

namespace App\Http\Controllers;


use App\Chapter;
use App\Notion;
use App\Part;
use App\Section;
use Illuminate\Http\Request;

class CompositionController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function home(){

  }
  public function duplicatenotion(Notion $notion,$sectionid){
      $notionclone=$notion->replicate();
      $notionclone->section_id=$sectionid;
      $notionclone->save();

      $temp=new \stdClass();
      $temp->id=$notionclone->id;
      $temp->childrens=array();
      return $temp;
  }

  public function duplicatesection(Section $section,$chapterid,$notions){
      $sectionclone=$section->replicate();
      $sectionclone->chapter_id=$chapterid;
      $sectionclone->save();
      $temp=new \stdClass();
      $temp->id=$sectionclone->id;
      $temp->childrens=array();
      foreach ($notions as $notion){
          array_push($temp->childrens,$this->duplicatenotion(Notion::find($notion->id),$sectionclone->id));
      }
      return $temp;
  }

  public function duplicatechapter(Chapter $chapter, $partid, $sections){
      $chapterclone=$chapter->replicate();
      $chapterclone->part_id=$partid;
      $chapterclone->save();
      $temp=new \stdClass();
      $temp->id=$chapterclone->id;
      $temp->childrens=array();
      foreach ($sections as $section){
          array_push($temp->childrens,$this->duplicatesection(Section::find($section->id),$chapterclone->id,$section->childrens));
      }
      return $temp;
  }

  public function duplicatepart(Part $part,$chapters){
      $partclone=$part->replicate();
      $partclone->save();
      $temp=new \stdClass();
      $temp->id=$partclone->id;
      $temp->childrens=array();
      foreach( $chapters as $chapter){
          array_push($temp->childrens,$this->duplicatechapter(Chapter::find($chapter->id),$partclone->id,$chapter->childrens));
      }
      return $temp;
  }

  public function duplicate(Request $request){
      $structure=json_decode($request->input("structure"));
      switch ($request->input("rootType")){
          case "part":
               return json_encode($this->duplicatepart(Part::find($structure->id),$structure->childrens));
          case "chapter":
              return json_encode($this->duplicatechapter(Chapter::find($structure->id),$structure->parentid,$structure->childrens));
          case "sections":
              return json_encode($this->duplicatesection(Section::find($structure->id),$structure->parentid,$structure->childrens));
          case "notion":
              return json_encode($this->duplicatenotion(Notion::find($structure->id),$structure->parentid));
      }
  }

  public function delete(Request $request){

      $parts=$request->input("parts");
      Part::destroy($parts);
      $chapters=$request->input("chapters");
      Chapter::destroy($chapters);
      $sections=$request->input("sections");
      Section::destroy($sections);
      $notions=$request->input("notions");
      Notion::destroy($notions);

      return response()->json(true);
  }
}
