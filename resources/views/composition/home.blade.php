@extends('composition.layout')

@section('content')
    @parent

    <div class="container content">
        <div class="row">
            <div class="col-md-3">
                <div id="treeview">

                </div>
            </div>
            <div class="col-md-9" id="editionArea">

            </div>

        </div>

    </div>


    <div id="notion_editor" style="display:none;">

        <div id="loading">
            <div class="cont">

                <div class='is-animate'>
                    <div class="l">C</div>
                    <div class="l">h</div>
                    <div class="l">a</div>
                    <div class="l">r</div>
                    <div class="l">g</div>
                    <div class="l">e</div>
                    <div class="l">m</div>
                    <div class="l">n</div>
                    <div class="l">t</div>
                </div>
            </div>

        </div>
        <textarea id="notion_editor"></textarea>
        <div id="submit_content" style="display:none;margin-top: 10px" class="text-right">
            <button class='submitbutton' id='submit-content' onclick="submitcontent();">
                <span>Sauvegarder</span>
            </button>
        </div>
    </div>
    <div id="course_editor" style="display:none;">
        <div class="form-group">
            <label for="comment">Introduction</label>
            <textarea class="form-control" rows="5" id="introduction"
                      placeholder="Saisir l'introduction par ici" onkeyup="enableintro()"></textarea>
            <div style="margin-top: 10px" class="text-right">
                <button class='submitbutton' id='submit-intro' onclick="submitintroduction();">
                    <span>Sauvegarder</span>
                </button>
            </div>
        </div>

        <div class="form-group">
            <label for="comment">Conclusion</label>
            <textarea class="form-control" rows="5" id="conclusion"
                      placeholder="Saisir la conclusion par ici" onkeyup="enableconcl()"></textarea>
            <div style="margin-top: 10px" class="text-right">
                <button class='submitbutton' id='submit-concl' onclick="submitconclusion();">
                    <span>Sauvegarder</span>
                </button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        structure ={!! $structure !!};
        course_id ={{$id}};
    </script>


@endsection
