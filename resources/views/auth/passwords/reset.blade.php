@extends('admin.layouts.boxed')

@section('content')

    <div class="lock-head">
        {{trans('admin.auth.form.reset_password')}}
    </div>
    <div class="lock-body">

                    <form method="POST" class ="lock-form pull-left" action="{{ route('password.request') }}">
                        @csrf
                        <input type="hidden"  name="token" value="{{ $token }}">

                        <div class="form-group">
                                <input id="email" type="email" class="form-control placeholder-no-fix{{ $errors->has('email') ? ' is-invalid' : '' }}"  placeholder="{{trans('admin.auth.form.email')}}" name="email" value="{{ $email or old('email') }}" required autofocus>


                        </div>

                        <div class="form-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="{{trans('admin.auth.form.password')}}" name="password" required>


                        </div>

                        <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="{{trans('admin.auth.form.confirm_password')}}" name="password_confirmation" required>


                        </div>

                        <div class="form-actions">
                                <button type="submit" class="btn roulette-login uppercase">
                                    {{trans('admin.auth.form.reset_password')}}
                                </button>
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
@endsection
