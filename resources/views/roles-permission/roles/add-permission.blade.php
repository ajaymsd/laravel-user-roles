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
                        Role: {{$role->name}}
                        <a href="{{url('roles')}}" class="btn btn-large btn-danger float-end">
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{url('roles/'.$role->id.'/give-permissions')}}">
                        @csrf
                        @method('PUT')
                        <div class="row mt-2">
                            <label>Permissions</label>
                            @foreach($permissions as $permission)
                                <div class="col-md-3 mt-3">
                                    <label class="form-label">
                                        <input type="checkbox" name="permissions[]" value="{{$permission->name}}"
                                        {{in_array($permission->id, $rolePermissions) ? 'checked' : ''}}>
                                        {{$permission->name}}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
