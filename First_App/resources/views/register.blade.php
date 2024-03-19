@extends('app')
@section('register')
    <div >
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <section class="vh-100" style="background-color: #503C3C;">
           
            <div class="container h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                  <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                      <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
          
                          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
          
                          <form class="mx-1 mx-md-4" action="/register" method="post">
                            @csrf
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                              <div class="form-outline flex-fill mb-0">
                                <input name="name" class="form-control @error('name') is-invalid @enderror " type="text" aria-label="default input example">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                <label class="form-label" for="form3Example1c">Your Name</label>
                              </div>
                            </div>
          
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                              <div class="form-outline flex-fill mb-0">
                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail1" aria-describedby="emailHelp">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                <label class="form-label" for="form3Example3c">Your Email</label>
                              </div>
                            </div>
          
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                              <div class="form-outline flex-fill mb-0">
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="InputPassword1">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <label class="form-label" for="form3Example4c">Password</label>
                                <div id="passwordHelpBlock" class="form-text">
                                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                </div>
                                
                              </div>
                            </div>
          
                            <div class="form-check d-flex justify-content-center mb-5">
                              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                              <label class="form-check-label" for="form2Example3">
                                I agree all statements in <a href="#!">Terms of service</a>
                              </label>
                            </div>
          
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                              <button type="submit" class="btn btn-primary btn-lg">Register</button>
                            </div>
          
                          </form>
          
                        </div>
                        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
          
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                            class="img-fluid" alt="Sample image">
          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </div>
@endsection
