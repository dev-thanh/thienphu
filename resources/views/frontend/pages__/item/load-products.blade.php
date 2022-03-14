@foreach($products as $item)
<a href="detail__product.html" class="product__item" title="{{$item->name}}">
    <div class="product__img">
        <div class="frame">
            <img src="{{url('/').$item->image}}" alt="{{$item->name}}" />
        </div>
    </div>
    <div class="product-title">
        {{$item->name}}
    </div>

    <div class="product-price">
        @if(!empty($item->price))
        <div class="product__old-price">
            {{$item->price}}
        </div>
        @endif
        @if(!empty($item->sale_price))
        <div class="product-sale">
            {{$item->sale_price}}
        </div>
        @endif
    </div>
</a>
@endforeach