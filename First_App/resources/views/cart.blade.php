@extends('app')
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
@section('content')
    <div class="container">
        
      <div class="row d-flex justify-content-center align-items-center h-100">
        
        <div class="col-10">
            <button onclick="window.location.href='{{ route('user') }}'" class="btn btn-primary">Back <-</button>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
          </div>
          @if(isset($items))
            @foreach($items as $item)
            <div class="card rounded-3 mb-4">
                <div class="card-body p-4">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                    <img
                        src="{{$item->getProduct->image}}"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                    <p class="lead fw-normal mb-2">{{$item->getProduct->title}}</p>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <form action="/editCart/{{$item->id}}" method="POST" style="display: contents!important">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-link px-2" type="submit" name="decrease">
                                <i class="bi bi-dash"></i>
                            </button>
            
                            <input  style="text-align: center;width:50%" min="0" name="quantity" value="{{$item->quantity}}" type="number"
                                class="form-control form-control-sm" readonly />
            
                            <button class="btn btn-link px-2" type="submit" name="increase">
                                <i class="bi bi-plus"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                    <h5 class="mb-0">RM{{$item->getProduct->price}}</h5>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <form action="/deleteCart/{{$item->id}}"  method="POST" style="display: contents!important">
                            @csrf
                            @method('Delete')
                            <button class="btn btn-danger rounded">Delete</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
            @endif
          <div >
            <form style="display: flex" action="/checkout" method="POST">
              @csrf
                <input value="{{json_encode($items)}}" name="cartData" hidden>
                <button type="submit" class="btn btn-warning" style="width: 100%">Checkout</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection