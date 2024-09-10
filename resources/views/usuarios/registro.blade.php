<x-layouts>
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <img src="images/logo.svg" alt="logo">
        </div>
        <h4>Registro de usuario.</h4>
        <h6 class="font-weight-light">Escriba los siguientes datos para crear una cuenta.</h6>

        <form class="pt-3" action="{{ route('userCreate') }}" method="post">
        @include('components.validations')
        @csrf()
            <div class="form-group">
                <input type="name" class="form-control form-control-lg" id="name" name="name" placeholder="Nombre de usuario"
                autofocus value="{{ old('name') }}" >
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Correo electronico" 
                value="{{ old('email') }}" >
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Contraseña"
                value="{{ old('password') }}">
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Repita la contraseña"
                value="{{ old('password_confirmation') }}">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Guardar</button>
            </div>
            <div class="mt-3">
                <a class="btn btn-block btn-secondary btn-lg font-weight-medium auth-form-btn" href="{{ route('home') }}">Cancelar</a>
            </div>

        </form>

    </div>
</x-layouts>