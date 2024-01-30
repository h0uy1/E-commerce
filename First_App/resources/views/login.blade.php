@extends('app')
@if(session('failed'))
  <div class="alert alert-danger" id="successAlert" role="alert" style="position:absolute;top:80;right:50">
    {{session('failed')}}
  </div>
    <script>
        // Automatically hide the success alert after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000);
    </script>
@endif


@section('register')
<div class="container" style="padding-top: 2rem">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Login</h1>
    <form action="/login" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="login_email" type="email" class="form-control @error('login_email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('login_email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="login_password" type="password" class="form-control @error('login_password') is-invalid @enderror " id="validationServer03">
            @error('login_password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        
    </form>
</div>
@endsection