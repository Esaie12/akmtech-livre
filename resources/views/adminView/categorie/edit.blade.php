@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 mb-4">
        <div class="card card-default">
            <div class="card-header">Créer une catégorie</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.categ.edit_save') }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" >
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="name_categ" value="{{ @old('name_categ',$data->name_categ) }}" type="text" placeholder="Titre">
                        @error('name_categ')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" name="description_categ" value="{{ @old('description_categ',$data->description_categg) }}" type="text" placeholder="">
                        @error('description_categ')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <button class="btn btn-sm btn-primary mt-3" type="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('codeJS')
@endsection
