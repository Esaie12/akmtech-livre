@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">Striped Rows</div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Etat</th>
                           <th>Titre</th>
                           <th>Auteur</th>
                           <th>Date de publication</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($publications as  $key=>$item)
                        <tr>
                           <td>{{ $key+1 }}</td>
                           <td>
                            @if($item->visible_pub == 1)
                            <b class="text-success">Visible</b>
                            @else
                            <b class="text-danger">Non Visible</b>
                            @endif
                           </td>
                           <td>{{$item->titre_pub}}</td>
                           <td>{{$item->auteur_pub}}</td>
                           <td>{{$item->date_pub}}</td>
                           <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.pub.edit',$item->id) }}" class="btn btn-inverse">Modifier</a>
                                <a href="{{ route('admin.pub.delete',$item->id) }}" class="btn btn-danger">Supprimer</a>
                                @if($item->visible_pub == 1)
                                <a href="{{ route('admin.pub.revoir-decision',[0,$item->id]) }}" class="btn btn-primary" >Rendre invisible</a>
                                @else
                                <a href="{{ route('admin.pub.revoir-decision',[1,$item->id]) }}" class="btn btn-success" >Rendre visible</a>
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

    <div class="col-12 text-center">
        {{ $publications->links('component.pagination') }}
    </div>

</div>


<div class="row">
    <!--div class="col-xl-3">

        <div class="card card-default">
           <div class="card-header">Search</div>
           <div class="card-body">
              <form class="form-horizontal">
                 <div class="input-group"><input class="form-control" type="text" placeholder="Search for..."><span class="input-group-btn"><button class="btn btn-secondary" type="button"><em class="fa fa-search"></em></button></span></div>
              </form>
           </div>
        </div>
        <div class="card card-default">
           <div class="card-header">Categories</div>
           <div class="card-body">
              <ul class="list-unstyled">
                <li><a href="#"><em class="fa fa-angle-right fa-fw"></em>Toutes les catégories</a></li>
                 @foreach ($les_categories as $item)
                 <li>
                    <a href="#"><em class="fa fa-angle-right fa-fw"></em>{{$item->name_categ}}</a>
                </li>
                 @endforeach
              </ul>
           </div>
        </div>
    </div-->
    <!--div class="col-xl-9">
        <div class="row">
            @foreach ($publications as $item)
            <div class="col-md-6 mb-3">
                <div class="card"><a href="{{$item->lien_pub}}">
                    <img class="img-fluid" src="{{asset($item->photo_pub)}}" alt="demo"></a>
                    <div class="card-body">
                       <p class="d-flex">
                        <span>
                            <small class="mr-1">Ecrit par<a class="ml-1" href="#">{{$item->auteur_pub}}</a></small>
                            <small class="mr-1">{{$item->date_pub}}</small></span>
                            <span class="ml-auto"><small>
                            <strong>0</strong><span>Vues</span></small>
                        </span>
                    </p>
                       <h4><a href="{{$item->lien_pub}}">{{$item->titre_pub}}</a></h4>
                       <p>
                        {{$item->description_pub}}
                       </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div-->
</div>
@endsection


@section('codeJS')
@endsection
