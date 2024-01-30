@extends('app')
@section('register')
    <div class="container" >
        <h1>Register</h1>
        <form action="/register" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" class="form-control @error('name') is-invalid @enderror " type="text" aria-label="default input example">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail1" aria-describedby="emailHelp">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="InputPassword1">
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
                <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
