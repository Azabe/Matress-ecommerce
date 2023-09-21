@extends('layouts.public.app')

@section('content')
<div class="page-holder">
    <div class="container">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-12">
                        <h1 class="h2 text-uppercase mb-0">Welcome to this application</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <!-- BILLING ADDRESS-->
            <h2 class="h5 text-uppercase text-center mb-4">Create an account to start</h2>
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <form action="#">
                        <div class="row gy-3">
                            <div class="col-lg-12">
                                <label class="form-label text-sm text-uppercase" for="firstName">First name </label>
                                <input class="form-control form-control-lg" type="text" id="firstName"
                                    placeholder="Enter your first name">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label text-sm text-uppercase" for="lastName">Last name </label>
                                <input class="form-control form-control-lg" type="text" id="lastName"
                                    placeholder="Enter your last name">
                            </div>
                            <div class="col-lg-12 form-group">
                                <button class="btn btn-dark" type="submit">Place order</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- ORDER SUMMARY-->
            </div>
        </section>
    </div>
</div>
@endsection