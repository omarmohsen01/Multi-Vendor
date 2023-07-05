<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">{{ $items->count() }}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $items->count() }} Items</span>
            <a href="{{ route('cart.index') }}">View Cart</a>
        </div>
        <ul class="shopping-list">
            @if($items->count() != 0)
                @foreach ($items as $item)
                    <li>
                        <form method="POST" action="{{ route('cart.destroy',$item->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="remove">
                                <i class="lni lni-close"></i>
                            </button>
                        </form>
                        @if($item)
                        <div class="cart-img-head">
                            <a class="cart-img" href="{{ route('products.show',$item->product->slug) }}"><img
                                    src="{{ $item->product->image_url }}" alt="#"></a>
                        </div>
                        <div class="content">
                            <h4><a href="product-details.html">{{ $item->product->name }}</a></h4>
                            <p class="quantity">{{ $item->quantity }}x - <span class="amount">${{ $item->product->price }}</span></p>
                        </div>
                            
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">${{ $total }}</span>
            </div>
            <div class="button">
                <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>