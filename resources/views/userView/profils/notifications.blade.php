@extends('userView.templateUser')

@section('titre')
Notification
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 mt-5">

        <div class="card card-default">
            <div class="card-header">Vos notifications</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table-striped">

                        <tbody>
                            @foreach ($data as $item)
                            <div class="mda-list-item">
                                <tr rowspan="2" >
                                    <td>#</td>
                                    <td>{{$item->message}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                </tr>
                            </div>
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
