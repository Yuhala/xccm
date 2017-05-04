@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{trans('adminlte_lang::message.home')}}
@endsection

@section('main-content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
            <h3>Nouveau Cours</h3>
        <form action="{{route('cours.store')}}" method="post">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label>Titre</label>

                        <div class="input-group ">
                            <div class="input-group-addon">
                                <i class="fa fa-book"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="coursName" >

                        </div>
                        <!-- /.input group -->
                        <label>Domain</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-cogs"></i>
                            </div>
                            <select class="form-control pull-right select2" name="coursDomain" data-placeholder="Select a State" style="">
                                <option>Algorithmique</option>
                                <option>IA</option>
                                <option>Programmation</option>
                                <option>Electronique</option>
                                <option>Mathématique</option>
                                <option>Réseau</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div>

            <div class="pull-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Créer</button>
            </div>
            <a href="{{ url('/home') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Supprimer</a>
            {{csrf_field()}}
        </form>
    </div>
</div>

@endsection