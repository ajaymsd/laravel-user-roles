<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
@include('roles-permission.navbar')
<div class="mt-3 container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Create user
                        <a href="{{url('users')}}" class="btn btn-large btn-danger float-end">
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{url('users')}}">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="name" />
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" />
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" />
                        </div>
                        <div class="form-group mb-3">
                            <label>Roles</label>
                            <select name="roles[]" multiple class="form-control">
                                <option>Select roles</option>
                                @foreach($roles as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="mt-1 btn btn-md btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
