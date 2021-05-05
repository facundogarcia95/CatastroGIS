@extends('auth.contenido')
@section('login')
<div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card-group mb-0">
          <div class="card p-4 rounded" style="opacity: 0.90">
          <form class="form-horizontal was-validated" method="POST" action="{{route('login')}}">
            @csrf
              <div class="card-body">
                <div style="text-align: center"><img src="{{asset('img')."/".env('ICONO_LOGO')}}" /></div>
                
              <h3 class="text-center bg-while text-light p-2"><label style="color:#A08FC2">Dirección de Catastro</label></h3>
             
              <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" value="{{old('login')}}" name="login" id="login" class="form-control" placeholder="Usuario">
                {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!} 
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn bg-catastro text-light px-4 rounded"><i class="fa fa-sign-in fa-2x"></i> Ingresar</button>
                </div>
              </div>
            </div>
            <footer style="text-align: center">
              <span class="ml-auto"><a href="https://divisiongis.com" target="_blank">DivisionGIS</a> &copy; 2021</span>
            </footer>
          </form>
          </div>
        </div>
      </div>
    </div>
@endsection
