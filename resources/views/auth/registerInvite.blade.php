@extends('auth.templateLogin')

@section('titre')
Inscription
@endsection

@section('contenu')
<div class="card-body">
    <p class="text-center py-2">INSCRIVEZ VOUS MAINTENANT</p>
    <form class="mb-3" action="{{ route('register') }}" method="post" id="registerForm" novalidate="">
        @csrf
        <input type="hidden" name="idInvite" value="{{ $idUser}}" >
        <input type="hidden" name="invitation" value="1">
        <div class="form-group">
            <label class="text-muted" for="signupInputEmail1">Vous avez reçu une invitation de</label>
            <div class="input-group with-focus">
                <b class="text-primary">{{$nameUser}}</b>
            </div>
        </div>
        <div class="form-group">
            <label class="text-muted" for="signupInputEmail1">Nom</label>
            <div class="input-group with-focus">
                <input id="name" type="text" class="form-control border-right-0 @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" >

                <div class="input-group-append"><span
                        class="input-group-text text-muted bg-transparent border-left-0"><em
                            class="fa fa-envelope"></em></span></div>
            </div>
            @error('name')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="text-muted" for="signupInputEmail1">Prénoms</label>
            <div class="input-group with-focus">
                <input id="name" type="text" class="form-control border-right-0 @error('prenoms') is-invalid @enderror"
                    name="prenoms" value="{{ old('prenoms') }}" required autocomplete="name" >

                <div class="input-group-append"><span
                        class="input-group-text text-muted bg-transparent border-left-0"><em
                            class="fa fa-envelope"></em></span></div>
            </div>
            @error('prenoms')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="text-muted" for="signupInputEmail1">Email</label>
            <div class="input-group with-focus">
                <input id="email" type="email" class="form-control border-right-0 @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                <div class="input-group-append"><span
                        class="input-group-text text-muted bg-transparent border-left-0"><em
                            class="fa fa-envelope"></em></span></div>
            </div>
            @error('email')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="text-muted" for="signupInputPassword1">Mot de passe</label>
            <div class="input-group with-focus">
                <input id="password" type="password"
                    class="form-control border-right-0 @error('password') is-invalid @enderror" name="password" required
                    autocomplete="new-password">
                <div class="input-group-append"><span
                        class="input-group-text text-muted bg-transparent border-left-0"><em
                            class="fa fa-lock"></em></span></div>
            </div>
            @error('password')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="text-muted" for="signupInputRePassword1">Confirmer mot de passe</label>
            <div class="input-group with-focus">
                <input id="password-confirm" type="password"
                    class="form-control border-right-0form-control border-right-0" name="password_confirmation" required
                    autocomplete="new-password">

                <div class="input-group-append"><span
                        class="input-group-text text-muted bg-transparent border-left-0"><em
                            class="fa fa-lock"></em></span></div>
            </div>
        </div>
        <div class="custom-control custom-checkbox mt-0">
            <input class="custom-control-input" id="agree" type="checkbox" required checked name="agreed"
                data-parsley-multiple="agreed">
            <label class="custom-control-label" for="agree"> J'ai lu et accepté<a class="ml-1" href="#">les
                    conditions</a></label></div><button class="btn btn-block btn-primary mt-3" type="submit">Créer
            mon compte</button>
    </form>

    <p class="pt-3 text-center">Vous avez un compte?</p><a class="btn btn-block btn-secondary"
        href="{{route('login')}}">Connectez vous</a>
</div>
@endsection
