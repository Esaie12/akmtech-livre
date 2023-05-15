@extends('userView.templateUser')

@section('titre')
Modifier mon profil
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="bg-lg-white text-warning py-lg-5 text-center">
    <div class="">
        <div class="">
            <h3 class="mt-4" style="color: orange" >MODIFIER MON PROFIL LIVRE</h3>
        </div>
    </div>
</div>
<div class="">
    <div class="">
        <div class="row">

            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('profil.edit.save') }}" enctype="multipart/form-data" >
                            @csrf
                            <div class="px-lg-5 px-3 py-3" >
                                <div class="form-group">
                                    <label for="">Nom</label>
                                    <input type="text" name="name" id="" value="{{ @old("name",$data->name) }}" class="form-control" placeholder="" >
                                    @error('name')
                                    <small id="helpId" class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Prénoms(s)</label>
                                    <input type="text" name="prenoms" id="" value="{{ @old("prenoms",$data->prenoms) }}" class="form-control" placeholder="" >
                                    @error('prenoms')
                                    <small id="helpId" class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Date de naissance</label>
                                    <input type="date" name="birthday" id="" value="{{ @old("birthday",$data->birthday) }}" class="form-control" placeholder="" >
                                    @error('birthday')
                                    <small id="helpId" class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Adresse</label>
                                    <input type="text" name="adresse" id="" value="{{ @old("adresse",$data->adresse) }}" class="form-control" placeholder="" >
                                    @error('adresse')
                                    <small id="helpId" class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Numéro de telephone</label>
                                    <input type="text" name="telephone" id="" value="{{ @old("telephone",$data->telephone) }}" class="form-control" placeholder="" >
                                    @error('telephone')
                                    <small id="helpId" class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Sexe</label>
                                    <select name="sexe" id="" class="form-control">
                                        <option value="">-----------</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>
                                    @error('sexe')
                                    <small id="helpId" class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-sm btn-primary" type="submit">Sauvegarder</button>

                            </div>



                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection


@section('codeJS')

@endsection
