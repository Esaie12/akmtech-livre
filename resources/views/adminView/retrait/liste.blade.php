@extends('adminView.templateAdmin')

@section('titre') Demandes de retrait
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">

    <div class="col-md-2"></div>
    <div class="col-xl-8">
        <!-- START card-->
        <div class="card card-default">
            <div class="card-header">Les demandes de retraits en cours sont:</div>
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
                                        <td>{{ $item->name." ".$item->prenoms }}</td>
                                        <td>{{$item->montant_retirer}} FCFA</td>
                                        <td>{{ $item->receve_moyen }}</td>
                                        <td><strong>{{ $item->date_demande }}</strong></td>
                                        <td>
                                            @if($item->etat_demande == 0)
                                            <span class="badge badge-info">En attente</span>
                                            @endif
                                            @if($item->etat_demande == 2)
                                            <span class="badge badge-info">Demande rejetée</span>
                                            @endif
                                            @if($item->etat_demande == 1)
                                            <span class="badge badge-success">Retrait effectué</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @if($item->etat_demande == 0)
                                                <a href="{{ route('admin.demande.approuve',$item->id) }}" class="btn btn-success">Aprouver</a>
                                                @endif
                                                @if($item->etat_demande == 1)
                                                -------
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {{ $data->links('component.pagination') }}
                </div><!-- END table-responsive-->
            </div>
        </div><!-- END card-->
    </div>
</div>
@endsection


@section('codeJS')
@endsection
