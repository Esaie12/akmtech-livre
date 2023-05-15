@extends('adminView.templateAdmin')

@section('titre') Liste Mots
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row mt-3">
    <div class="col-xl-12">
        <!-- START card-->
        <div class="card card-default">
            <div class="card-header">Listes des mots et citations</div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date de visibilité</th>
                                <th>Mot</th>
                                <th>Auteur de la citation</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>#</td>
                                <td>{{$item->date_pour}}</td>
                                <td>{{$item->mot_day}}</td>
                                <td>{{$item->citation_auteur}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-primary">Modifier</a>
                                        <a href="{{ route('admin.mot.delete',$item->id) }}" class="btn btn-primary">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-green text-white" >
                                <td colspan="2">
                                    {{$item->definition_mot}}
                                </td>
                                <td colspan="3">
                                    {{$item->citation_day}}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $data->links('component.pagination')}}
                </div><!-- END table-responsive-->
            </div>
        </div><!-- END card-->
    </div>
</div>
@endsection


@section('codeJS')
@endsection
