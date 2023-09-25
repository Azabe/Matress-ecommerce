@extends('admin.layouts.app')

@section('pageTitle')
Create User
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="px-6 py-4">
                <p>After the user being created, the default generated password with be sent <span
                        class="text-secondary text-capitalize font-bold"> Via SMS to his/her telephone number provided
                    </span> and he/she will be required to update it</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-default">

                    <div class="card-header">
                        <h2>New user</h2>
                        <a class="btn mdi mdi-format-list-bulleted" href="{{route('admin.users.index')}}"> </a>
                    </div>

                    <div class="card-body">
                        <form action="{{route('admin.users.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Names</label>
                                <input type="text" placeholder="User names" name="names"
                                    class="{{ $errors->has('names')? 'form-control error' : 'form-control' }}"
                                    value="{{old('names')}}">
                                @if ($errors->has('names'))
                                <span class="text-danger">{{ $errors->first('names') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" placeholder="User email" name="email"
                                    class="{{ $errors->has('email')? 'form-control error' : 'form-control' }}"
                                    value="{{old('email')}}">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Telephone</label>
                                <input type="tel" placeholder="User Telephone(250...)" name="telephone"
                                    class="{{ $errors->has('telephone')? 'form-control error' : 'form-control' }}"
                                    value="{{old('telephone')}}" maxlength="12" minlength="12">
                                @if ($errors->has('telephone'))
                                <span class="text-danger">{{ $errors->first('telephone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="{{ $errors->has('role')? 'form-control error' : 'form-control' }}"
                                    name="role">
                                    <option selected disabled>Select user role</option>
                                    @foreach ($roles as $role)
                                    <option {{ $role->id === old('role') ? 'selected': '' }}
                                        value="{{$role->id}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                <span class="text-danger">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>TIN Number</label>
                                <input type="text" placeholder="User Tin" name="tin"
                                    class="{{ $errors->has('tin')? 'form-control error' : 'form-control' }}"
                                    value="{{old('tin')}}" maxlength="5" minlength="5">
                                @if ($errors->has('tin'))
                                <span class="text-danger">{{ $errors->first('tin') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Residence</label>
                                <select name="residence"
                                    class="{{ $errors->has('residence')? 'form-control error' : 'form-control' }}">
                                    <option value="" selected disabled>Select user district</option>
                                    @foreach ($districts as $district)
                                    <option value="{{$district}}">{{$district}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('residence'))
                                <span class="text-danger">{{ $errors->first('residence') }}</span>
                                @endif
                            </div>
                            <div class="form-footer mt-6">
                                <button type="submit" class="btn btn-primary btn-pill">Create user</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection