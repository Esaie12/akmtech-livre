@extends('auth.templateLogin')

@section('titre')
C
@endsection

@section('contenu')
<div class="card-body">
    <p class="text-center py-2">RECHERCHER VOTRE COMPTE</p>
    <form class="mb-3" id="loginForm" action="{{route('password.request')}}" method="post">
        @csrf
        @if(session('status'))
        <p class="alert alert-sucess my-2">
            {{session('status')}} <br>
            Verifier votre boite ou dans votre spam.
        </p>
        @endif

        <div class="form-group">
            <div class="input-group with-focus">
                <input id="email" placeholder="Entrez votre adresse email" type="email" class="form-control border-right-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <span class="input-group-text text-muted bg-transparent border-left-0">
                        <em class="fa fa-envelope"></em>
                    </span>
                </div>
            </div>
            @error('email')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>
        <button class="btn btn-block btn-success mt-3" type="submit">Lancer la demande</button>
    </form>

    <p class="pt-3 text-center">Vous n'avez pas un compte?</p><a class="btn btn-block btn-secondary"
        href="{{route('register')}}">Inscrivez vous</a>
</div>
@endsection
