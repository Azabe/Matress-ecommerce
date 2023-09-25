<div class="col-lg-4 col-sm-6">
    <div class="product-item">
        <div class="pi-pic">
            @if ($product->quantity >= 20)
            <div class="tag-sale success">In Stock</div>
            @else
            <div class="tag-sale warning">Almost out</div>
            @endif
            <img src="{{ asset('storage/' . $product->image) }}" alt="" height="700px">
            <div class="pi-links">
                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO
                        CART</span></a>
                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
            </div>
        </div>
        <div class="pi-text">
            <h6>RWF {{$product->price}}</h6>
            <p>{{$product->description}} </p>
        </div>
    </div>
</div>