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
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        Users
                        <a href="{{url('users/create')}}" class="btn btn-large btn-primary float-end">
                            Add User
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table mt-3">
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $role)
                                            <span class="badge bg-primary">{{$role}}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a class="mx-2 btn btn-success" href="{{url('users/'.$user->id.'/edit')}}">Update</a>
                                    <form class="mx-2" method="POST" action="{{url('users/'.$user->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
