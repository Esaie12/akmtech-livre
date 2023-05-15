@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">
    <div class="col-xl-12">
        <div class="card card-default">
            <div class="card-header">Liste des collaborateurs</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email }}</td>
                                <td>
                                    @if($item->statut == 1)
                                    <b class="text-success">Actif</b>
                                    @endif
                                    @if($item->statut == 0)
                                    <b class="text-danger">Bloqué</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($item->statut == 1)
                                        <a href="{{ route('admin.collabo.decision',[0,$item->id]) }}" class="btn btn-danger" >Retirer acces</a>
                                        @else
                                        <a href="{{ route('admin.collabo.decision',[1,$item->id]) }}" class="btn btn-success" >Redonner acces</a>
                                        @endif
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
</div>
@endsection


@section('codeJS')
@endsection
