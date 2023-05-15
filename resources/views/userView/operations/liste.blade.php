@extends('userView.templateUser')

@section('titre') Mes Opérations
@endsection

@section('codeCCS')
@endsection

@section('contenu')

<div class="">
    <div class="">
        <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-8 px-lg-5">
                <div class="card card-default">
                    <div class="card-header">Vos opérations de retrait</div>
                    <div class="card-body">
                       <!-- START table-responsive-->
                       <div class="table-responsive">
                          <table class="table">
                             <thead>
                                <tr>
                                   <th>#</th>
                                   <th>Montant</th>
                                   <th>Par</th>
                                   <th>Date</th>
                                   <th>Statut</th>
                                </tr>
                             </thead>
                             <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->montant_retirer}} FCFA</td>
                                        <td>{{ $item->receve_moyen }}</td>
                                        <td><strong>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</strong></td>
                                        <td>
                                            @if($item->etat_demande == 0)
                                            <span class="badge badge-info">En attente</span>
                                            @endif
                                            @if($item->etat_demande == 2)
                                            <span class="badge badge-info">Demande rejetée</span>
                                            @endif
                                            @if($item->etat_demande == 1)
                                            <span class="badge badge-info">Retrait effectué</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                             </tbody>
                          </table>
                          <div class="text-center">
                              {{ $data->links('component.pagination')}}
                          </div>
                       </div><!-- END table-responsive-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@section('codeJS')

@endsection
