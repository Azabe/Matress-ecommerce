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
            <strong>Error</strong> {{Session::get('error')}}
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
                <table id="productsTable" class="table table-hover table-product" style="width:100%; height:100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
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
                                {{$product->title}}
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
                                @if ($product->quantity >= 20)
                                <span class="badge badge-pill badge-success">
                                    In Stock

                                </span>
                                @elseif($product->quantity >= 10 && $product->quantity <20)
                                 <span class="badge badge-pill badge-warning">
                                    Running out
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
                                                        {{$product->title}}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    
    <form id="updateProductForm" action="{{ route('update.product', ['id' => $product->id]) }}" method="POST" style="display: none;">
        @csrf
        @method('PUT')

        <ul class="list-group">
            <li class="list-group-item">Product Quantity: <span id="quantity">{{$product->quantity}}</span></li>
            <li class="list-group-item">Product Height: <span id="height">{{$product->height}}</span></li>
            <li class="list-group-item">Product Width: <span id="width">{{$product->width}}</span></li>
            <li class="list-group-item">Product Length: <span id="length">{{$product->length}}</span></li>
            <li class="list-group-item">Product Description: <span id="description">{{$product->description}}</span></li>
        </ul>

        <!-- Input fields for updating properties -->
        <div class="form-group">
            <label for="new_quantity">New Quantity:</label>
            <input type="text" class="form-control" id="new_quantity" name="new_quantity" placeholder="Enter new quantity">
        </div>
        <!-- Add other input fields for updating properties if needed -->

        <button type="submit" class="btn btn-success">Save Changes</button>
    </form>
</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info btn-pill" onclick="toggleUpdateForm()">Update Product</button>
                                                    
                                                    <a class="btn btn-danger btn-pill" href="#"
                                                        onclick="document.getElementById('form-delete-{{$product->id}}').submit()">Delete
                                                        Product</a>
                                                    <form id="form-delete-{{$product->id}}"
                                                        action="{{route('admin.products.destroy', $product->id)}}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                    
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
</div><br>
@endsection
<script>
        function toggleUpdateForm() {
            var form = document.getElementById('updateProductForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>