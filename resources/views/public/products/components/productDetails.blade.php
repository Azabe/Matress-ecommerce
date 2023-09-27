<div class="col-lg-6 product-details">
    <h2 class="p-title">{{$product->title }}</h2>
    <h3 class="p-price">{{$product->price}} RWF</h3>
    <h4 class="p-stock">Available: <span>In Stock</span></h4>
    @can('add-product-to-cart')
    @if (!Auth::user()->cart || !Auth::user()->cart->products->contains($product->id))
    <a href="#" class="site-btn" onclick="document.getElementById('product-cart-{{$product->id}}').submit();">ADD TO
        CART</a>
    <form action="{{route('distributor.cart.products.store')}}" method="POST" id="product-cart-{{$product->id}}">
        @csrf
        <input type="hidden" name="productId" value="{{$product->id}}">
    </form>
    @else
    <span class="text-danger"><b>Product Exists in yor cart</b></span>
    @endif
    @else
    <span class="text-danger"><b>only authenticated distributors can add this product to cart</b></span>
    @endcan
    <div id="accordion" class="accordion-area">
        <div class="panel">
            <div class="panel-header" id="headingOne">
                <button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
                    aria-controls="collapse1">description</button>
            </div>
            <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="panel-body">
                    <p>{{$product->description}}.</p>
                </div>
            </div>
        </div>
    </div>
</div>