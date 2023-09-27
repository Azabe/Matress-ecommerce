@extends('layouts.public.app')

@section('content')
@include('partials.public.page-top-info', [
'header' => 'Password Update',
'links' => [
[
'label' => 'Home',
'route' => 'home'
],
[
'label' => 'Password Update',
'route' => "auth.userConfirm.index"
],
]
])
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 contact-info">
                <h3 class="text-center">Update your password</h3>
                <span class="text-info"><b>Dear {{$user->names}} Please update your password </b></span>
                @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error...</strong> {{Session::get('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form class="contact-form" action="{{route('auth.userConfirm.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="userId" value="{{$user->id}}">
                    <div class="mb-4">
                        <input type="password" placeholder="Your Password" name="password" value="{{old('password')}}">
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <input type="password" value="{{old('password')}}" placeholder="confirm password" name="password_confirmation"
                            class="{{ $errors->has('names')? 'error' : '' }}">
                        @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="site-btn">Update Password</button>
                        </div>
                        <div class="col-lg-6" style="display: flex; align-items:center">
                            <a href="{{route('auth.login.index')}}" style="color: #00adef">Return to login page</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection