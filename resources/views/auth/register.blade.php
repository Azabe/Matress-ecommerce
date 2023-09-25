@extends('layouts.public.app')

@section('content')
@include('partials.public.page-top-info', [
'header' => 'Register',
'links' => [
[
'label' => 'Home',
'route' => 'home'
],
[
'label' => 'Register',
'route' => "auth.register.index"
],
]
])
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 contact-info">
                <h3 class="text-center">Create an Account</h3>
                <form class="contact-form" action="{{route('auth.register.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <input type="text" placeholder="Your names" name="names"
                                class="{{ $errors->has('names')? 'error' : '' }}" value="{{old('names')}}">
                            @if ($errors->has('names'))
                            <span class="text-danger">{{ $errors->first('names') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <input type="tel" placeholder="Your Telephone(250...)" name="telephone"
                                class="{{ $errors->has('names')? 'error' : '' }}" value="{{old('telephone')}}" maxlength="12" minlength="12">
                            @if ($errors->has('telephone'))
                            <span class="text-danger">{{ $errors->first('telephone') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <input type="email" placeholder="Your email" name="email"
                                class="{{ $errors->has('names')? 'error' : '' }}" value="{{old('email')}}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <input type="text" placeholder="Your Tin" name="tin"
                                class="{{ $errors->has('names')? 'error' : '' }}" value="{{old('tin')}}" maxlength="5" minlength="5">
                            @if ($errors->has('tin'))
                            <span class="text-danger">{{ $errors->first('tin') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <select name="residence" class="{{ $errors->has('residence')? 'error' : '' }}">
                                <option value="" selected disabled>Select your district</option>
                                @foreach ($districts as $district)
                                <option value="{{$district}}">{{$district}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('residence'))
                            <span class="text-danger">{{ $errors->first('residence') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <input type="password" placeholder="Your password" name="password"
                                class="{{ $errors->has('names')? 'error' : '' }}">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <input type="password" placeholder="confirm password" name="password_confirmation"
                                class="{{ $errors->has('names')? 'error' : '' }}">
                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="site-btn">LOGIN NOW</button>
                        </div>
                        <div class="col-lg-6" style="display: flex; align-items:center">
                            <a href="{{route('auth.login.index')}}" style="color: #00adef">Already have an account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection