@extends('userView.templateUser')

@section('titre')
Publier un livre
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="bg-lg-white text-warning py-lg-5 text-center">
    <div class="">
        <div class="">
            <h3 class="mt-4" style="color: orange" >PUBLIER UN LIVRE</h3>
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
                        <form method="post" action="{{ route('publier.save') }}" enctype="multipart/form-data" >
                            @csrf
                            <div class="px-lg-5 px-3 py-3" >
                                <div class="form-group">
                                    <label>Catégorie du livre</label>
                                    @php $id_c = old('categ_pub'); @endphp

                                    <select name="categ_pub" id="" class="form-control">
                                        <option value="">Chosir la catégorie</option>

                                        @foreach ($les_categories as $item)
                                            @if($id_c == $item->id)
                                            <option selected value="{{$item->id}}">{{$item->name_categ}}</option>
                                            @else
                                            <option value="{{$item->id}}">{{$item->name_categ}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @error('categ_pub')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Titre du livre</label>
                                    <input class="form-control" type="text" name="titre_pub" value="{{ @old('titre_pub') }}" placeholder="">
                                    @error('titre_pub')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Auteur du livre</label>
                                    <input class="form-control" type="text" name="auteur_pub" value="{{ @old('auteur_pub') }}" placeholder="">
                                    @error('auteur_pub')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Une photo</label> <br>
                                    <input class="" type="file" name="photo_pub" placeholder=""> <br>
                                    @error('photo_pub')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Le lien</label>
                                    <input class="form-control" type="text" name="lien_pub" value="{{ @old('lien_pub') }}" placeholder="">
                                    @error('lien_pub')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Une description</label>
                                    <input class="form-control" type="" name="description_pub" value="{{ @old('description_pub') }}" placeholder="">
                                    @error('description_pub')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Voulez vous booster votre livre ?</label>
                                    @php $aff ="none" ; $che1 = ""; $che2 = "checked"; @endphp
                                    @if( old('booster') == 1 ) @php $aff ="" ; $che1 ="checked" ; $che2 = ""; @endphp @endif

                                   <input type="radio" {{$che1}} name="booster" value="1" onclick="aff_plan(1)" class="ml-3 mr-2" id="">OUI
                                   <input type="radio" {{$che2}} name="booster" value="0" onclick="aff_plan(0)"  class="ml-3 mr-2" id="">NON
                                    @error('booster')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group" id="plan_boost" style="display:{{$aff}}" >
                                    <label>Choisissez un plan</label>
                                    <select name="boost_id" id="" class="form-control">
                                        <option value="">Choisir</option>
                                        <option value="1">1.000 Lecteurs ( 5000 Fcfa)</option>
                                        <option value="2">2.500 Lecteurs ( 10.000 Fcfa)</option>
                                        <option value="3">5.000 Lecteurs ( 17.000 Fcfa)</option>
                                        <option value="4">10.000 Lecteurs ( 20.000 Fcfa)</option>
                                    </select>
                                    @error('boost_id')
                                    <strong class="text-danger">Choisissez un plan de boostage</strong>
                                    @enderror
                                </div>

                                <button class="btn btn-sm btn-primary" type="submit">Publier maintenant </button>

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
<script>
    function aff_plan(val){
        $(function(){
            var choix = val;
            if(choix == 1){
                $('#plan_boost').show();
            }
            if(choix == 0){
                $('#plan_boost').hide();
            }
        })
    }
</script>
@endsection
