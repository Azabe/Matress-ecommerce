<div class="product-item">
    <div class="pi-pic">
        @if ($show_tag_sale)
        @if ($product->quantity >= 20)
        <div class="tag-sale success">In Stock</div>
        @else
        <div class="tag-sale warning">Almost out</div>
        @endif
        @endif
        <img src="{{ asset('storage/' . $product->image) }}" alt="" height={{$height}}>
        <div class="pi-links">
            <a href="{{route('public.products.show', $product->id)}}" class="add-card"><i class="fa fa-eye"></i><span>VIEW MORE</span></a>
        </div>
    </div>
    <div class="pi-text">
        <h6>RWF {{$product->price}}</h6>
        <p>{{$product->description}} </p>
    </div>
</div>