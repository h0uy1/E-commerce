@extends('app')

@section('content')

    <div class="container" style="padding-top:10px">
        <div style="display:flex;justify-content:space-between;align-items: center">
            <h1>Welcome, {{auth()->user()->name}} !!</h1>
    
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Product
            </button>
        </div>
       
        <!-- Modal -->
        <form action="/create_product" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name='title' type="text" class="form-control" id="floatingInput" placeholder="Text">
                            <label for="floatingInput">Product Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name='price' type="number" class="form-control" id="floatingPassword" placeholder="Number">
                            <label for="floatingPassword">Product Price</label>
                        </div>
                        <div class="input-group mb-3">
                            <input name='image' type="file" class="form-control" id="inputGroupFile02">
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <table class="table table-striped table-hover">
    </div>
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Product Title</th>
            <th scope="col">Product Price</th>
            <th scope="col">Image</th>
            <th scope="col">Operation</th>
            <th scope="col">Created By</th>
          </tr>
        </thead>
        <tbody>
            @if (!$products->isEmpty())
            @foreach($products as $product)
              <tr class="align-middle" >
                <th scope="row">{{$product['id']}}</th>
                <td>{{$product['title']}}</td>
                <td>{{$product['price']}}</td>
                <td style="width: 300px; height: 100px; overflow: hidden;">
                    <img src="{{$product['image']}}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                </td>
                <td>
                    <div style="display: flex;align-items:center;gap:10px">
                        <form action="/edit/{{$product['id']}}" method="GET">
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </form>
                        <form action="/delete/{{$product['id']}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Delete
                            </button>
                             <!--Delete Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are u Sure u want to delete this ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">YES</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
                <td>{{$product->getUser->name}}</td>
              </tr>
            @endforeach
            @endif
        </tbody>
      </table>
@endsection