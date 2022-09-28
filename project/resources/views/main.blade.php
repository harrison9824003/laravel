<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>    
    <div id="app">
        <router-link to="/">首頁</router-link>
        <router-link to="/product">商品</router-link>
        <router-view></router-view>
    </div>
    

    <!-- App JS -->
    <script src="{{ mix('js/app.js') }}"></script>    
</body>
</html>