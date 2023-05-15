@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')

<div class="row px-5">
    <div class="col-md-12 mb-2">
        <div class="card card-default">
            <div class="card-header">Les publications en attente</div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Utilisateur</th>
                           <th>Titre</th>
                           <th>Username</th>
                           <th>Visible</th>
                           <th>Plan</th>
                           <th>Options</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($pubs as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name." ".$item->prenoms}}</td>
                            <td>{{$item->titre_pub}}</td>
                            <td>
                                @if($item->etat_demande == 0)
                                <b class="text-warning">En attente</b>
                                @endif
                                @if($item->etat_demande == 1)
                                <b class="text-success">Deja étudié</b>
                                @endif
                                @if($item->etat_demande == 2)
                                <b class="text-danger">Rejeté</b>
                                @endif
                            </td>

                            <td>{{$item->date_pub}}</td>
                            <td>
                                @if($item->visible_pub == 0)
                                <span class="badge badge-danger">Non visible</span>
                                @else
                                <span class="badge badge-success">Visible</span>
                                @endif
                            </td>
                            <td>
                                @if($item->with_plan == 0)
                                <span class="badge badge-danger">Boster</span>
                                @else
                                <span class="badge badge-success">Booster</span>
                                <!-- Faire un if -->
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-inverse" href="{{ route('admin.pub.etude',$item->id) }}">Voir ou Etudier</a>
                                </div>
                            </td>
                         </tr>
                        @endforeach
                     </tbody>
                  </table>


               </div>
            </div>
         </div>
    </div>

    <div class="col-12 text-center">
        {{ $pubs->links('component.pagination') }}
    </div>

</div>
@endsection


@section('codeJS')
@endsection
