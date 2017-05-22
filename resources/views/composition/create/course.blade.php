
@extends("composition.create.layout")

@section("content")
    <div class="content">
        <h3> Créer un Cours </h3>
        <form action="{{ url('/composition/course') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="text" class="form-control" required placeholder="Titre" name="title" value="" autofocus/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" required placeholder="Domaine" name="domain" value=""/>
            </div>
            <div class="row">
                <div class="col-md-5 right-align">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Créer</button>
                </div>
            </div>
        </form>
    </div>

@endsection