<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <h1>Edit Products</h1>
        <form action="/edit/{{$product->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <img src="{{$product->image}}" alt="">
            <input name='oldImage' type="text" value="{{$product->image}}" hidden>
            <div class="form-floating mb-3">
                <input name='title' type="text" value="{{$product->title}}" class="form-control" id="floatingInput" placeholder="Text">
                <label for="floatingInput">Product Title</label>
            </div>
            <div class="form-floating mb-3">
                <input name='price' type="number" value="{{$product->price}}" class="form-control" id="floatingPassword" placeholder="Number">
                <label for="floatingPassword">Product Price</label>
            </div>
            <div class="input-group mb-3">
                <input name='newImage' type="file" class="form-control" id="inputGroupFile02">
            </div>
            <div style="text-align: center;">
                <button style="width:50%" type="submit" class="btn btn-warning">Save</button>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>