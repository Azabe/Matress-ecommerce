@extends('admin.layouts.app')

@section('pageTitle')
Users
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Success</strong> {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card card-default">
            <div class="card-header">
                <h2>Users List</h2>
                <div style="display: flex;gap: 5px;">
                    <a class="btn mdi mdi-plus" href="{{route('admin.users.create')}}"> </a>
                    <a target="_blank" class="btn mdi mdi-printer" href="{{route('admin.users.report.index')}}"> </a>
                </div>
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
                                        @if ($user->role->role!==\App\Models\Role::ADMIN)
                                        <a class="dropdown-item" href="#"
                                            onclick="document.getElementById('form-update-{{$user->id}}').submit();">
                                            {{ $user->status === \App\Models\User::ACTIVE ? "Disable Account" : "Enable
                                            Account" }}
                                        </a>
                                        @endif
                                        <form action="{{route('admin.users.update', $user->id)}}" method="post"
                                            id="form-update-{{$user->id}}">
                                            <input type="hidden" name="_method" value="put">
                                            @csrf
                                        </form>
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