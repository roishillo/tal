@extends('admin.layouts.boxed')

@section('content')
    <div class="lock-head">
        {{config('app.name')}}
    </div>
    <div id ="main" class="lock-body">

        {{-- main form --}}

        <form id="login-form" class="lock-form pull-left" method="POST" >
            {!! csrf_field() !!}
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="{{trans('admin.auth.form.email')}}" name="email" />
            </div>
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="{{trans('admin.auth.form.password')}}" name="password" />
            </div>
            <div class="form-actions">
                <button type="submit" class="btn roulette-login uppercase">{{trans('admin.auth.form.login_button')}}</button>
            </div>
            <div class="form-actions">
                <button type="button" id="forgotButton" class="btn roulette-login uppercase">{{trans('admin.auth.form.forgot_button')}}</button>
            </div>
            <div class="roulette-alerts">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning rouletteAlert">{{ $error }}</div>
                    @endforeach
                @endif
            </div>

        </form>

        {{--forgot password form--}}

        <form id ="forgot-password-form" class="lock-form pull-left" method="POST" action="{{ route('admin.password.email') }}" style="display: none">
            {!! csrf_field() !!}
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="{{trans('admin.auth.form.email')}}" name="email" />
            </div>
            <div class="form-actions">
                <button type="submit" class="btn roulette-login uppercase">{{trans('admin.auth.form.send_button')}}</button>
            </div>

            <div class="roulette-alerts">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-warning rouletteAlert">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </form>
    </div>

    @if (session('status'))
        <div id = "alert" class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
@endsection

@push('boxedScript')
<script>
    let alert = document.getElementById("alert");
    let forgotPasswordButton = document.getElementById("forgotButton");
    forgotPasswordButton.addEventListener("click", function(){
        document.getElementById("forgot-password-form").style.display = "block";
        document.getElementById("login-form").style.display = "none";
        alert.parentNode.removeChild(alert);

    });
</script>
@endpush