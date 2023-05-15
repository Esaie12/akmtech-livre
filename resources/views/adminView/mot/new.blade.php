@extends('adminView.templateAdmin')

@section('titre') Ajouter un mot
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-default">
            <div class="card-header">Ajouter le mot et la citiation du jour</div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.mot.save') }}" >
                    @csrf
                    <div class="form-group">
                        <label>Mot du jour</label>
                        <input class="form-control" name="mot_day" value="{{ @old('mot_day') }}" type="text" >
                        @error('mot_day')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Définition du mot</label>
                        <textarea class="form-control" name="definition_mot" id="" rows="3">{{@old('definition_mot')}}</textarea>
                        @error('definition_mot')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Citation du jour</label>
                        <textarea class="form-control" name="citation_day" id="" rows="3">{{@old('citation_day')}}</textarea>
                        @error('citation_day')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Auteur de la citation</label>
                        <input class="form-control" name="citation_auteur" value="{{ @old('citation_auteur') }}" type="text" >
                        @error('citation_auteur')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="">Date d'affichage</label>
                      <input type="date" name="date_pour" class="form-control" value="{{@old('data_pour')}}">
                      @error('date_pour')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <button class="btn btn-sm btn-primary mt-3" type="submit">Publier</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection


@section('codeJS')
@endsection
