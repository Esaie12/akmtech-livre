@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-default">
            <div class="card-header">Créer un nouveau collaborateur</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.collabo.save') }}" >
                    @csrf
                    <div class="form-group">
                        <label>Titre</label>
                        <input class="form-control" name="name" value="{{ @old('name') }}" type="text" >
                        @error('name')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" value="{{ @old('email') }}" type="text" placeholder="">
                        @error('email')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input class="form-control" name="mdp" value="{{ @old('mdp') }}" type="text" placeholder="">
                        @error('mdp')
                            <strong class="text-primary">{{ $message }}</strong>
                        @enderror
                    </div>

                    <button class="btn btn-sm btn-primary mt-3" type="submit">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection


@section('codeJS')
@endsection
