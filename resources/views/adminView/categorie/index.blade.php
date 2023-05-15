@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-default">
            <div class="card-header">Créer une catégorie</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.categ.create') }}" >
                    @csrf
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="name_categ" value="{{ @old('name_categ') }}" type="text" placeholder="Titre">
                        @error('name_categ')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" name="description_categ" value="{{ @old('description_categ') }}" type="text" placeholder="">
                        @error('description_categ')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <button class="btn btn-sm btn-primary mt-3" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-3">
        <div class="card card-default">
            <div class="card-header">Les différentes Catégories</div>
            <div class="card-body">
                <!-- START table-responsive-->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <!--th>Nombre de livre</th-->
                                <th>Date d'Ajout</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{$item->name_categ}}</td>
                                <!--td>{{$item->count_livre}}</td-->
                                <td>{{$item->date_add_categ }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.categ.edit',$item->id) }}" class="btn btn-inverse">Modifier</a>
                                        <a href="{{ route('admin.categ.delete',$item->id) }}" class="btn btn-danger">Supprimer</a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- END table-responsive-->
            </div>
        </div>
    </div>
</div>
@endsection


@section('codeJS')
@endsection
