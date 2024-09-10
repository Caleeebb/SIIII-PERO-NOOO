<x-layouts>

    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
            <img src="images/logo.svg" alt="logo">
        </div>
        <h4>Holissss, comencemos.</h4>
        <h6 class="font-weight-light">Inicie sesión para continuar.</h6>
        <form class="pt-3" action="">
            @include('components.validations')
            @csrf()
            <div class="form-group">
                <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="mt-3">
                <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="public/index.html"> llllllllllllllllllSESIÓN</a>
            </div>
            <div class="my-2 d-flex justify-content-between align-items-center">
            </div>
            <div class="text-center mt-4 font-weight-light">
                ¿No tienes una cuenta? <a href="register.html" class="text-primary">Crear</a>
            </div>
        </form>
    </div>

</x-layouts>