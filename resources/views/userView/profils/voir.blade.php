@extends('userView.templateUser')

@section('titre')
Mon Profil
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="row mt-lg-5 mt-5">
    <div class="col-xl-4">
        <!-- START card-->
        <div class="card">
            <div class="half-float ie-fix-flex"><img class="img-fluid" src="img/bg3.jpg" alt="">
                <div class="half-float-bottom">
                    <img class="img-thumbnail circle thumb128"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQj4tzGpTQ7UXcB_7gk75AyF_TJElz8gjU1VQ&usqp=CAU"
                        alt="Image">
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('profil.edit') }}" class="btn btn-warning">Modifier mon profil</a>
            </div>
            <div class="card-body text-center">
                <h3 class="m-0">{{$data->name." ".$data->prenoms}}</h3>
                <!--p class="text-muted">Née le  </p-->
                <p class="my-3">Proin metus justo, commodo in ultrices at, lobortis sit amet dui. Fusce dolor purus,
                    adipiscing a
                    tempus at, gravida vel purus.
                </p>
                <div class="list-group">
                    <div class="list-group-item">
                        <em class="fa-fw far fa-clock text-muted mr-2"></em> <b class="text-warning"> Née le :</b>
                        {{$data->birthday}}
                    </div>
                    <div class="list-group-item">
                        <em class="fa-fw far fa-clock text-muted mr-2"></em> <b class="text-warning"> Adresse :</b>
                        {{$data->adresse}}
                    </div>
                    <div class="list-group-item">
                        <em class="fa-fw far fa-clock text-muted mr-2"></em> <b class="text-warning"> Téléphone :</b>
                        {{$data->telephone}}
                    </div>
                    <div class="list-group-item">
                        <em class="fa-fw far fa-clock text-muted mr-2"></em> <b class="text-warning"> Sexe :</b>
                        @if($data->sexe == null)
                        ---
                        @endif
                        @if($data->sexe == "F")
                        Féminin
                        @endif
                        @if($data->sexe == "M")
                        Masculin
                        @endif
                    </div>

                </div>
            </div>
            <div class="card-body text-center bg-gray-success">
                <div class="row">
                    <div class="col-6">
                        <h3 class="m-0 text-success">{{$pub}}</h3>
                        <p class="m-0">Publications</p>
                        <a class="card-footer text-warning bt0 clearfix btn-block d-flex" href="{{route('publier')}}">
                            <span>Les voir</span><span class="ml-auto">
                                <em class="fa fa-chevron-circle-right"></em></span>
                        </a>
                    </div>
                    <div class="col-6">
                        <h3 class="m-0 text-success">{{$aff}}</h3>
                        <p class="m-0">Filleuls</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="row">
            <div class="col-xl-3 ">
                <!-- START card-->
                <div class="card bg-success-dark border-0">
                    <div class="row align-items-center mx-0">
                        <div class="col-4 text-center"><em class="icon-share fa-3x"></em></div>
                        <div class="col-8 py-4 bg-success rounded-right">
                            <div class="h1 m-0 text-bold">{{$aff}}</div>
                            <div class="text-uppercase">FILLEULS</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 ">
                <!-- START card-->
                <div class="card bg-warning-dark border-0">
                    <div class="row align-items-center mx-0">
                        <div class="col-4 text-center"><em class="icon-trophy fa-3x"></em></div>
                        <div class="col-8 py-4 bg-warning rounded-right">
                            <div class="h1 m-0 text-bold">{{Auth::user()->solde_off}}</div>
                            <div class="text-uppercase">SOLDE NON  RETIRABLE <br>  (FCFA) </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 ">
                <!-- START card-->
                <div class="card bg-danger-dark border-0">
                    <div class="row align-items-center mx-0">
                        <div class="col-4 text-center"><em class="icon-star fa-3x"></em></div>
                        <div class="col-8 py-4 bg-danger rounded-right">
                            <div class="h1 m-0 text-bold">{{Auth::user()->solde}}</div>
                            <div class="text-uppercase">SOLDE RETIRABLE <br> (FCFA)</div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">

                <h3>Inviter des amis sur PLUMLIVRE</h3>
                <div id="msg" class="mt-2" >
                    <form>
                        <textarea rows="10" class="form-control" id="txtarea">
                            Salut, comment vas-tu ?

                            C'est {{Auth::user()->name."  ".Auth::user()->prenoms}}. Tu aimes lire ? 📖

                            Si oui,☺️  j'ai le plaisir de te parler de https://plumlivre.com/ c'est une plateforme de lecture où tu peux lire de meilleurs histoires et gagner beaucoup d'argent💵 juste en invitant des amis 🧑🏿‍🤝‍🧑🏾à lire. (100 FCFA par personne invitée)

                            Utilise ce lien pour t'inscrire 👇🏾  https://plumlivre.com/invite/{{Auth::user()->code_invitation}}
                        </textarea>
                        <div class="validate">
                            <button type="button" class="btn btn-success mt-2" data-clipboard-target="#txtarea">Copier et partager</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@section('codeJS')
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script type="text/javascript">
    var Clipboard = new ClipboardJS('.btn');
    clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});
</script>
@endsection
