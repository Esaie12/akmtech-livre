@extends('userView.templateUser')

@section('titre') Mes Publications
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="bg-lg-white text-warning py-lg-5 text-center">
    <div class="">
        <div class="">
            <h3 class="mt-4" style="color: orange" >MES LIVRES</h3>
        </div>
    </div>
</div>
<div class="">
    <div class="">
        <div class="row">
            <div class="col-md-12 px-lg-5">
                <div class="card card-default">
                    <div class="card-header">Les livres que vous avez publié sont ici</div>
                    <div class="card-body">
                       <!-- START table-responsive-->
                       <div class="table-responsive">
                          <table class="table">
                             <thead>
                                <tr>
                                   <th>#</th>
                                   <th>Etat</th>
                                   <th>Titre du livre</th>
                                   <th>Etat de la demande</th>
                                   <th>Date de publication</th>
                                   <th>Actions</th>
                                </tr>
                             </thead>
                             <tbody>
                                @foreach ($pubs as $key=> $item)
                                <tr>
                                    @php $p=0; @endphp
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if($item->visible_pub == 0)
                                        <span class="badge badge-danger">Non visible</span>
                                        @else
                                        <span class="badge badge-success"> visible</span>
                                        @endif
                                        @if($item->with_plan == 1)
                                        <span class="badge badge-primary">Booster</span>
                                        @else
                                        <span class="badge badge-info">Non Booster</span>
                                        @endif
                                    </td>
                                    <td>{{$item->auteur_pub}}</td>
                                    <td>
                                        @if($item->etat_demande == 0)
                                        EN attente
                                        @endif
                                        @if($item->etat_demande == 2)
                                        Rejeté
                                        @endif
                                        @if($item->etat_demande == 1)
                                            @if($item->with_plan == 1)

                                                @if($item->id_transaction != null)
                                                Validé et booster
                                                @php $p=1; @endphp
                                                @else
                                                <a href="{{route('publier.get_paid',$item->id)}}">
                                                    <span class="badge badge-warning">
                                                        Passer au paiement
                                                    </span>
                                                </a>

                                                @endif
                                            @endif
                                            @if($item->with_plan == 0)
                                            Validé
                                            @php $p=1; @endphp
                                            @endif

                                        @endif
                                    </td>
                                    <td>{{$item->date_pub}}</td>
                                    <td>
                                        @if($p != 1)
                                        <div class="btn-group">
                                            <a href="{{route('publier.editer',$item->id)}}" class="btn btn-inverse">Modifier</a>
                                            <a href="{{route('publier.delete',$item->id)}}" class="btn btn-danger">Effacer</a>
                                        </div>
                                        @endif
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
