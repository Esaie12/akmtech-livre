@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')

<div class="row px-5">
    <div class="col-md-12">
        <!-- START card-->
        <div class="card card-default">
            <div class="card-header">Publier un livre</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.pub.create') }}" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Catégorie du livre</label>
                                <select name="categ_pub" id="" class="form-control">
                                    <option value="">Chosir la catégorie</option>
                                    @foreach ($les_categories as $item)
                                    <option value="{{$item->id}}">{{$item->name_categ}}</option>
                                    @endforeach

                                </select>
                                @error('categ_pub')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Titre du livre</label>
                                <input class="form-control" type="text" name="titre_pub" value="{{ @old('titre_pub') }}" placeholder="">
                                @error('titre_pub')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Auteur du livre</label>
                                <input class="form-control" type="text" name="auteur_pub" value="{{ @old('auteur_pub') }}" placeholder="">
                                @error('auteur_pub')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Une photo</label>
                                <input class="" type="file" name="photo_pub" placeholder=""> <br>
                                @error('photo_pub')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Le lien</label>
                                <input class="form-control" type="text" name="lien_pub" value="{{ @old('lien_pub') }}" placeholder="">
                                @error('lien_pub')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Une description</label>
                                <input class="form-control" type="" name="description_pub" value="{{ @old('description_pub') }}" placeholder="">
                                @error('description_pub')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-primary" type="submit">Publier maintenant </button>
                </form>
            </div>
        </div><!-- END card-->
    </div>
</div>
@endsection


@section('codeJS')
@endsection
