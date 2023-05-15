@extends('adminView.templateAdmin')

@section('titre') Ajouter un carrousel
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-default">
            <div class="card-header">Créer un nouveau carrousel</div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.carrousel.save') }}" >
                    @csrf
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="name" value="{{ @old('name') }}" type="text" >
                        @error('name')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Une description</label>
                        <textarea class="form-control" name="description" id="" rows="3">{{@old('description')}}</textarea>
                        @error('description')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="">Choisissez une image</label>
                      <input type="file" name="image" id=""  placeholder="" aria-describedby="helpId"> <br>
                        @error('image')
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
