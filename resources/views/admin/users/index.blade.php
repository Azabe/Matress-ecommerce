@extends('admin.layouts.app')

@section('pageTitle')
Users
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">

            <div class="card-header">
                <h2>Users List</h2>
                <a class="btn mdi mdi-plus"> </a>
            </div>

            <div class="card-body">
                <table id="productsTable" class="table table-hover table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>Names</th>
                            <th>Email</th>
                            <th>Residence</th>
                            <th>Tin</th>
                            <th>Role</th>
                            <th>Account Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)

                        <tr>
                            <td>{{$user->names}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->residence}}</td>
                            <td>{{$user->tin}}</td>
                            <td>{{$user->role->role}}</td>
                            <td>
                                @if ($user->status === \App\Models\User::ACTIVE)
                                <span class="badge badge-pill badge-success">
                                    {{$user->status}}

                                </span>
                                @else
                                <span class="badge badge-pill badge-danger">
                                    {{$user->status}}

                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-display="static">
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection