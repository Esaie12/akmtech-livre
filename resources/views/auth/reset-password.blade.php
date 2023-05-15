@extends('auth.templateLogin')

@section('titre')
Modifier Mot de passe
@endsection

@section('contenu')
<div class="card-body">
    <p class="text-center py-2">MODIFIER MOT DE PASSE</p>
    <form class="p-2" method="POST"  action="{{route('password.update')}}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}" >

        <div class="form-group">
            <label class="text-muted" for="signupInputEmail1">Email</label>
            <div class="input-group with-focus">
                <input id="email" type="email" class="form-control border-right-0 @error('email') is-invalid @enderror"
                    name="email" value="{{ $request->email }}"  readonly>
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
            <button class="btn btn-block btn-success mt-3" type="submit">Modifier mon mot de passe</button>
    </form>

    <p class="pt-3 text-center">Vous avez un compte?</p><a class="btn btn-block btn-secondary"
        href="{{route('login')}}">Connectez vous</a>
</div>
@endsection
