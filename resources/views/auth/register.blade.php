@extends('layouts.public.app')

@section('content')
@include('partials.page-top-info', [
    'header' => 'Login',
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
                <form class="contact-form">
                   <div class="row">
                    <div class="col-lg-6">
                        <input type="text" placeholder="Your names">
                    </div>
                    <div class="col-lg-6">
                        <input type="email" placeholder="Your Telephone(250...)">
                    </div>
                    <div class="col-lg-6">
                        <input type="email" placeholder="Your email">
                    </div>
                    <div class="col-lg-6">
                        <input type="number" placeholder="Your Tin">
                    </div>
                    <div class="col-lg-6">
                        <select>
                            <option value="" selected disabled>Select your district</option>
                            @foreach ($districts as $district)
                                <option value="{{$district}}">{{$district}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <input type="password" placeholder="Your password">
                    </div>
                    <div class="col-lg-6">
                        <input type="password" placeholder="confirm password">
                    </div>
                   </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="site-btn">LOGIN NOW</button>
                        </div>
                        <div class="col-lg-6" style="display: flex; align-items:center">
                            <a href="{{route('auth.login.index')}}" style="color: #f51167">Already have an account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection