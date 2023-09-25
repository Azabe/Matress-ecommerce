@extends('admin.layouts.app')

@section('pageTitle')
Products
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
                <h2>Products List</h2>
                <a class="btn mdi mdi-plus" href="{{route('admin.products.create')}}"> </a>
            </div>

            <div class="card-body">
                <table id="productsTable" class="table table-hover table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Serial Number</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="py-0">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                            </td>
                            <td>
                                {{$product->serial_number}}
                            </td>
                            <td>
                                {{$product->price}} FRWS
                            </td>
                            <td>
                                {{$product->height}}*{{$product->width}}*{{$product->length}}
                            </td>
                            <td>
                                {{$product->type}}
                            </td>
                            <td>
                                @if ($product->status === \App\Models\Product::INSTOCK)
                                <span class="badge badge-pill badge-success">
                                    In Stock

                                </span>
                                @else
                                <span class="badge badge-pill badge-danger">
                                    Out of Stock
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
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#modal-{{$product->id}}">View More</a>

                                    </div>
                                    <div class="modal fade" id="modal-{{$product->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Product #{{$product->serial_number}}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item disabled" aria-disabled="true">
                                                            Product Height: {{$product->height}}</li>
                                                        <li class="list-group-item disabled" aria-disabled="true">
                                                            Product Width: {{$product->width}}</li>
                                                        <li class="list-group-item disabled" aria-disabled="true">
                                                            Product Lenght: {{$product->length}}</li>
                                                        <li class="list-group-item disabled" aria-disabled="true">
                                                            Product Description: {{$product->description}}</li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    @if ($product->status === \App\Models\Product::INSTOCK)
                                                    <a class="btn btn-info btn-pill" href="#">Update Product</a>
                                                    @else
                                                    <a class="btn btn-danger btn-pill" href="#" onclick="document.getElementById('form-delete-{{$product->id}}').submit()">Delete Product</a>
                                                    <form id="form-delete-{{$product->id}}" action="{{route('admin.products.destroy', $product->id)}}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
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