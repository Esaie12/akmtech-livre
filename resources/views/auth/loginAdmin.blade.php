@extends('auth.templateLogin')

@section('titre')
Admin - Connexion
@endsection

@section('contenu')
<div class="card-body">
    <p class="text-center py-2">CONNECTEZ VOUS ENTANT QUE ADMIN</p>
    <form class="mb-3" id="loginForm" action="{{route('admin.login')}}" method="post">
        @csrf
        <div class="form-group">
            <div class="input-group with-focus">
                <input id="email" placeholder="Entrez votre adresse email" type="email" class="form-control border-right-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <span class="input-group-text text-muted bg-transparent border-left-0">
                        <em class="fa fa-envelope"></em>
                    </span>
                </div>
            </div>
            @error('')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <div class="input-group with-focus">
                <input id="password" placeholder="Entrez votre mot de passe" type="password" class="form-control border-right-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                <div class="input-group-append">
                    <span class="input-group-text text-muted bg-transparent border-left-0">
                        <em class="fa fa-lock"></em>
                    </span>
                </div>
            </div>
            @error('')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror

        </div>
        <div class="clearfix">
            <div class="custom-control custom-checkbox float-left mt-0">
                <!--input
                    class="custom-control-input" id="rememberme" type="checkbox" name="remember"><label
                    class="custom-control-label" for="rememberme">Remember Me</label-->
            </div>
            <div class="float-right">
                <a class="text-muted" href="#">Mot de passe oublié?</a>
            </div>
        </div>
        <button class="btn btn-block btn-primary mt-3" type="submit">Se connecter</button>
    </form>


</div>
@endsection
