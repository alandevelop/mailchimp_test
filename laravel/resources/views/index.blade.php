<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

@auth
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand">Navbar</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Logout') }}
                        </button>
                    </form>

                </div>
            </nav>
        </div>
    </div>
@endauth

@guest
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top: 40px;">
            <div class="col-md-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endguest


<div class="container">
    <div class="row justify-content-md-center" style="margin-top: 40px;">

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">

                <div class="font-medium text-red-600">
                    {{ __('Whoops! Something went wrong.') }}
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <p class="text-sm">{{session('success')}}</p>
            </div>
        @endif

    </div>
</div>

@auth
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top: 40px;">
            <div class="col-md-4">
                <form method="POST" action="{{ route('subscribers.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">First name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Surname</label>
                        <input type="text" class="form-control" name="surname" value="{{old('surname')}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="{{old('email')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endauth

</body>
</html>
