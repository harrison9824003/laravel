<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">
            {{ $title }}
        </h1>
        <form action="{{ route('product.createProcess') }}" method="POST">
            <div class="row justify-content-center">            
                <div class="col-3">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">商品名稱</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="請輸入商品名稱" require>
                        </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">商品簡介</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="simpleintro" rows="3" require></textarea>
                    </div>                   
                    <div>
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </div>   
                {{ csrf_field() }}      
            </div>
        </form>
    </div>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>