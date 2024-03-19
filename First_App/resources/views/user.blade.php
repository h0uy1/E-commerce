@extends('app')
@section('alert')

@if(session('success'))
  <div class="alert alert-success" id="successAlert" role="alert" style="position:absolute;top:80;right:50">
    {{session('success')}}
  </div>
    <script>
        // Automatically hide the success alert after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000);
    </script>
@endif

@endsection
@section('content')
<main>
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Product Listing</h1>
          <p class="lead text-body-secondary">Buy what you want not what you need!!</p>
        </div>
      </div>
    </section>
  
    <div class="album py-5 bg-body-tertiary">
      <div class="container">
  
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($products as $product)
            <form action="/cart" method="POST">
              @csrf
              <div class="col">
                <div class="card shadow-sm">
                    <img src="{{$product['image']}}" alt="Product Image" class="card-img-top" style="height:200px;width:auto">
                  <div class="card-body">
                    <p class="card-text">{{$product['title']}}</p>
                    <p class="card-text">RM {{$product['price']}}</p>
                    <div class="d-flex justify-content-between align-items-center " style="padding-bottom: 5px">
                    <input value="{{$product['id']}}" hidden name="product_id">
                    
                    <button type="submit" class="btn btn-sm btn-outline-success">Add To Cart</button>
                      <small class="text-body-secondary">Created at: {{ $product['created_at']->format('jS \of F') }}</small>
                    </div>
                    <input style="width: 23%" value="1" class="bg-success-subtle border rounded form-control" type="number" name="quantity">
                  </div>
                  
                </div>
              </div>
            </form>
            @endforeach
        </div>

      </div>
    </div>
  
  </main>
  {{ $products->links() }}
@endsection
