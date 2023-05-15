<div>
    @php

    $date1 = new DateTime('2022-01-01'); //Fin
    $date2 = new DateTime('2022-12-31'); //sup

    $diff = date_diff($date1, $date2);

    echo $diff->format('Il y a %a jours de différence entre les deux dates');



    if($abonnement->dateEnd != null){
        $date = date_create($abonnement->dateEnd);
        $d = date_format($date, 'Y-m-d H:i:s');
        $to_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:s:i'));
        $from_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $d);

        $in_days = $to_date->diffInDays($from_date);
    }

    @endphp


    @if( $abonnement->dateEnd < date('Y-m-d') or $abonnement->dateEnd == null)

    Vous etes en mode gratuit, veulliez souscrire à l'un de nos packs <a href="{{route('tarif')}}"> suivants </a>. <br>
    Pour lire nos livres.

    @else
    @if($abonnement->idPack == 0)
    Vous etes en mode gratuit, veulliez souscrire à l'un de nos packs <a href="{{route('tarif')}}"> suivants </a>. <br>
    Pour lire nos livres.
    @endif

    @if($abonnement->idPack == 5)
    Vous benéficiez des <b> 5 jours</b> d'essaie que nous ouvrons,
     expire le {{ $abonnement->dateEnd }} soit dans <b>{{$in_days }}</b> jours. profitez en. <br>
    Pensez à souscrire à l'un de nos packs <a href="{{route('tarif')}}"> suivants </a>.
    @endif

    @if($abonnement->idPack == 1)
    Vous avez un abonnement <b>BASIC</b> en cours. Qui expire le {{ $abonnement->dateEnd }} soit dans <b>{{$in_days }}</b> jours.
    @endif

    @if($abonnement->idPack == 2)
    Vous avez un abonnement <b>VIP</b> en cours. Qui expire le {{ $abonnement->dateEnd }} soit dans <b>{{$in_days }}</b> jours.
    @endif

    @if($abonnement->idPack == 3)
    Vous avez un abonnement <b>GOLD</b> en cours. Qui expire le {{ $abonnement->dateEnd }} soit dans <b>{{$in_days }}</b> jours.
    @endif

    @if($abonnement->idPack == 4)
    Vous avez un abonnement <b>EVASION</b> en cours. Qui expire le {{ $abonnement->dateEnd }} soit dans <b>{{$in_days }}</b> jours.
    @endif

    @endif

</div>
