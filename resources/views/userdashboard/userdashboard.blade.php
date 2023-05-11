<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to dashboard</title>
</head>

<body>
    <div id="app">
        <div id="about">
            <App :questions="{{$questions}}" :userasked="{{$userasked}}"></App>
            {{-- <App/> --}}
          
        </div>
     
    </div>
    @vite('resources/js/app.js')
</body>

</html>
