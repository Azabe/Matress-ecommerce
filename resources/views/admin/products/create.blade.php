@extends('admin.layouts.app')

@section('pageTitle')
Create Product
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-default">

                    <div class="card-header">
                        <h2>New Product</h2>
                        <a class="btn mdi mdi-format-list-bulleted" href="{{route('admin.products.index')}}"> </a>
                    </div>

                    <div class="card-body">
                        <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Serial No</label>
                                    <input type="text" placeholder="Serial number" name="serial_number"
                                        class="{{ $errors->has('serial_number')? 'form-control error' : 'form-control' }}"
                                        value="{{old('serial_number')}}">
                                    @if ($errors->has('serial_number'))
                                    <span class="text-danger">{{ $errors->first('serial_number') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Size</label>
                                    <select class="{{ $errors->has('size')? 'form-control error' : 'form-control' }}"
                                        name="size">
                                        <option selected disabled>Select size</option>
                                        @foreach (\App\Models\Product::SIZES as $size)
                                        <option {{ $size===old('size') ? 'selected' : '' }} value="{{$size}}">{{$size}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('size'))
                                    <span class="text-danger">{{ $errors->first('size') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Type</label>
                                    <select class="{{ $errors->has('type')? 'form-control error' : 'form-control' }}"
                                        name="type">
                                        <option selected disabled>Select type</option>
                                        @foreach (\App\Models\Product::TYPES as $type)
                                        <option {{ $type===old('type') ? 'selected' : '' }} value="{{$type}}">{{$type}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Length</label>
                                    <input type="number" placeholder="Enter the length" name="length"
                                        class="{{ $errors->has('length')? 'form-control error' : 'form-control' }}"
                                        value="{{old('length')}}">
                                    @if ($errors->has('length'))
                                    <span class="text-danger">{{ $errors->first('length') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Height</label>
                                    <input type="number" placeholder="Enter the height" name="height"
                                        class="{{ $errors->has('height')? 'form-control error' : 'form-control' }}"
                                        value="{{old('height')}}">
                                    @if ($errors->has('height'))
                                    <span class="text-danger">{{ $errors->first('height') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Width</label>
                                    <input type="number" placeholder="Enter the width" name="width"
                                        class="{{ $errors->has('width')? 'form-control error' : 'form-control' }}"
                                        value="{{old('width')}}">
                                    @if ($errors->has('width'))
                                    <span class="text-danger">{{ $errors->first('width') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Price</label>
                                    <input type="number" placeholder="Enter the price" name="price"
                                        class="{{ $errors->has('price')? 'form-control error' : 'form-control' }}"
                                        value="{{old('price')}}">
                                    @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Image</label>
                                    <input type="file" name="image" accept="image/jpeg"
                                        class="{{ $errors->has('image')? 'form-control error' : 'form-control' }}"
                                        value="{{old('image')}}">
                                    @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Description</label>
                                    <textarea
                                        class="{{ $errors->has('description')? 'form-control error' : 'form-control' }}"
                                        name="description">
                                        {{old('description')}}
                                    </textarea>
                                    @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-footer mt-6">
                                <button type="submit" class="btn btn-primary btn-pill">Create Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection