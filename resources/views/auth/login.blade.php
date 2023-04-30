<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    
    <div class="container w-50">
        <h3>Login</h3>
        <form action="{{route('login-user')}}" method="post" >
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            @if (Session::has('fail'))
                <div class="alert alert-danger">
                    {{Session::get('fail')}}
                </div>
            @endif
            @csrf
            <div class="mb-3">
              <label for="exampleDropdownFormEmail2" class="form-label">Email </label>
              <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleDropdownFormEmail2" placeholder="email">
              <span class="text-danger">@error('email') {{$message}} @enderror</span>
            </div>
            <div class="mb-3">
              <label for="exampleDropdownFormPassword2" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
              <span class="text-danger">@error('password') {{$message}} @enderror</span>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
            <br>
            <a href="registration">New User !! Register Here.</a>
          </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>