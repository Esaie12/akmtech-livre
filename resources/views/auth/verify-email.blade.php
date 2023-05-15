
@extends('auth.templateLogin')

@section('titre')
Confirmer Mail
@endsection

@section('contenu')
<div class="card-body">
    <p class="text-center py-2 text-success">
        CONFIRMER VOTRE MAIL
    </p>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-success btn-block mt-3 mb-3 p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </div>

</div>
@endsection
