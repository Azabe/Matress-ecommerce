@extends('layouts.public.app')

@section('content')
@include('partials.public.page-top-info', [
'header' => 'Login',
'links' => [
[
'label' => 'Home',
'route' => 'home'
],
[
'label' => 'Login',
'route' => "auth.login.index"
],
]
])
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 contact-info">
                <h3 class="text-center">Login in your Account</h3>
                <form class="contact-form" action="{{route('auth.login.store')}}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="email" placeholder="Your e-mail" name="email" value="{{old('email')}}">
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <input type="password" placeholder="Your Password" name="password" value="{{old('password')}}">
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="site-btn">LOGIN NOW</button>
                        </div>
                        <div class="col-lg-6" style="display: flex; align-items:center">
                            <a href="{{route('auth.register.index')}}" style="color: #00adef">No account Yet?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection