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
                        Update Permission
                        <a href="{{url('permissions')}}" class="btn btn-large btn-danger float-end">
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{url('permissions/'.$permission->id)}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$permission->id}}" />
                        <input type="text" class="form-control" name="name" value="{{$permission->name}}"}}/>
                        <button type="submit" class="mt-1 btn btn-md btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
