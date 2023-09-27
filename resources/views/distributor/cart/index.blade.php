@extends('layouts.public.app')

@section('content')
@include('partials.public.navbar')

@include('partials.public.page-top-info', [
'header' => 'My Cart',
'links' => [
[
'label' => 'Home',
'route' => 'home'
],
[
'label' => 'My Cart',
'route' => "distributor.cart.products.index"
],
]
])

<!--Cart-->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <h3>Your Cart</h3>
                    @if (!is_null($myCart) && $myCart->products()->count() > 0)
                    <form action="{{route('distributor.orders.store')}}" method="POST" id="cart-form">
                        @csrf
                        <div class="cart-table-warp">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-th">Product</th>
                                        <th class="quy-th">Quantity</th>
                                        <th class="size-th">Unit price(FRWS)</th>
                                        <th class="total-th">Total Price(FRWS)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($myCart->products as $product)
                                    <tr>
                                        <td class="product-col">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                            <div class="pc-title">
                                                <a href="{{route('public.products.show', $product->id)}}">
                                                    <h4>{{$product->title}}</h4>
                                                    <input type="hidden" name="productIds[]" value="{{$product->id}}">
                                                </a>
                                            </div>
                                        </td>
                                        <td class="quy-col">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="number" min="0" value="1" class="quantity-input"
                                                        onkeydown="return false" name="quantities[]">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="size-col">
                                            <h4>{{$product->price}}</h4>
                                        </td>
                                        <td class="total-col total-price">
                                            <h4>0</h4>
                                        </td>
                                        <td class="total-col">
                                            <i class="fa fa-close text-danger"
                                                onclick="document.getElementById('cart-product-remove-{{$product->id}}').submit();"></i>
                                            <form action="{{route('distributor.cart.products.destroy', $product->id)}}"
                                                method="POST" id="cart-product-remove-{{$product->id}}">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="total-cost">
                        <h6>Total(FRWS) <span></span></h6>
                    </div>
                    @else
                    <span class="text-danger text-center mb-4"><b>Empty Card</b></span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 card-right">
                <button onclick="document.getElementById('cart-form').submit();" class="site-btn">Proceed to checkout</button>
                <a href="{{route('public.products.index')}}" class="site-btn sb-dark">Continue shopping</a>
            </div>
        </div>
    </div>
</section>
@include('partials.public.footer')
<script>
    // Function to calculate the total price for a row

    function updateTotalPrice(row) {
        const quantityInput = row.querySelector('.quantity-input');
        const unitPrice = parseFloat(row.querySelector('.size-col h4').textContent);
        const totalPrice = row.querySelector('.total-price h4');

        const quantity = parseInt(quantityInput.value);
        const total = unitPrice * quantity;
        totalPrice.textContent = total.toFixed(2);
        updateGrandTotal();

    }

    // Function to update the Grand Total
    function updateGrandTotal() {
        const totalPrices = document.querySelectorAll('.total-price h4');
        let grandTotal = 0;

        totalPrices.forEach((totalPrice) => {
            grandTotal += parseFloat(totalPrice.textContent);
        });

        const grandTotalElement = document.querySelector('.total-cost h6 span');
        grandTotalElement.textContent = grandTotal.toFixed(2);
    }

    // Function to remove a product (you can implement this as needed)
    function removeProduct(productId) {
        document.getElementById('cart-product-remove-' + productId).submit();
    }

    // Add event listeners to quantity input elements
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach((input) => {
        input.addEventListener('input', (event) => {
            updateTotalPrice(event.target.closest('tr'));
        });
    });

    // Initial calculation
    const rows = document.querySelectorAll('.cart-table-warp tbody tr');
    rows.forEach((row) => {
        updateTotalPrice(row);
    });
</script>
@endsection