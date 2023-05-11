<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <div class="login cover-img">
        <h3>User Login</h3>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <input type="email" name="email" placeholder="Email" required="required" />
            <input type="password" name="password" placeholder="Password" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
    </div>


    <style>
        
                    background-image: url('https://cdn.pixabay.com/photo/2018/02/23/12/38/flower-3175428__340.jpg');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center center;
                    

        @import url(https://fonts.googleapis.com/css?family=Open+Sans);

       

       
        .btn:hover {
            color: #b9d80a;
            text-decoration: none;
            background-color: #fc2323;
            background-position: 0 -15px;
           
        }

    

        body {
            
            background-image: url('https://cdn.pixabay.com/photo/2016/06/15/10/00/earth-1458557_960_720.jpg');
            background-size: cover;
            background-repeat:no-repeat;
            background-position: center center;
           
           
           
          
        }

        .login {
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -150px 0 0 -150px;
           
        }

        .login h3 {
            color: #fff;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
            text-align: center;
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            background: rgba(0, 0, 0, 0.199);
            padding: 10px;
            font-size: 13px;
            color: rgb(126, 126, 126);
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            box-shadow: inset 0 -5px 45px rgba(255, 255, 255, 0.2), 0 1px 1px rgba(255, 255, 255, 0.2);
           
        }

     

    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
