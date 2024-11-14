{{-- @extends('adminlte::auth.auth-page', ['auth_type' => 'login']) --}}

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

{{-- @section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body') --}}
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="general fondo">
    <form action="{{ $login_url }}" method="post" class="container login">
        <img src="{{asset('img/PoliciaLogo.png')}}" class="rounded mx-auto d-block logo" alt="Logo policía">
            <h2 class="form_titulo">Sistema de control de operaciones</h2>
            <h3 class="label">Inicio de sesión</h3>
        @csrf

        <div class="form_cont">
            {{-- Email field --}}
            <div class="form_dato">
                <input type="text" name="username" class="form_input @error('username') is-invalid @enderror"
                    value="{{ old('username') }}" placeholder="">

                <label for="nombre" class="form_label">Usuario:</label>

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Password field --}}
            <div class="form_dato">
                <input type="password" name="password" class="form_input @error('password') is-invalid @enderror"
                    placeholder="">

                <label for="nombre" class="form_label">Contraseña:</label>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Login field --}}
                <div class="form_dato" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember" class="label">
                        Recordar contraseña
                    </label>
                </div>
                <button type=submit class="button label{{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    Ingresar
                     {{-- {{ __('adminlte::adminlte.sign_in') }} --}}
                </button>
        </div>

    </form>
</div>
{{-- @stop

@section('auth_footer')
    {{-- Password reset link
    @if($password_reset_url)
        <p class="my-0">
            <a href="{{ $password_reset_url }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </p>
    @endif

    {{-- Register link
    @if($register_url)
        <p class="my-0">
            <a href="{{ $register_url }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif
@stop --}}
