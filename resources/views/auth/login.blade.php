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
                <form class="contact-form">
                    <input type="email" placeholder="Your e-mail">
                    <input type="password" placeholder="Your Password">
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