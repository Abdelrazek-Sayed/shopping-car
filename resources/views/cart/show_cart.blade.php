@extends('layouts.master')

@section('title')
    My Cart
@endsection

@section('content')

    @if ($cart)
        <div class="row">
            <div class="col-md-8">
                @foreach ($cart->items as $product)
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product['item']['title'] }}
                            </h5>
                            <div class="card-text">
                                ${{ $product['price'] * $product['qty'] }}


                                <form action="{{ route('product.update', 'test') }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="product_id" value="{{ $product['item']['id'] }}">
                                    <input type="number" name="qty" id="qty" value={{ $product['qty'] }}
                                        style="width:100px;">
                                    {{-- <button type="submit" class="btn btn-info btn-sm">Change</button> --}}
                                    <button type="submit" class="btn btn-sm btn-success"><i
                                            class="fa fa-check-square"></i></button>
                                    <br>
                                    @error('qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </form>

                                <br>
                                <form action="{{ route('product.destroy', 'test') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="product_id" value="{{ $product['item']['id'] }}">
                                    <button type="submit" class="btn btn-danger btn-sm ml-4 float-right"
                                        style="margin-top: -30px;">Remove</button>


                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <p><strong> Total : {{ $cart->totalPrice }}</strong></p>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h3 class="card-titel">
                            Your Cart
                            <hr>
                        </h3>
                        <div class="card-text">
                            <p>
                                Total Amount is ${{ $cart->totalPrice }}
                            </p>
                            <p>
                                Total Quantities is {{ $cart->totalQty }}
                            </p>
                            <a href="{{ route('cart.checkout') }}" class="btn btn-info">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No Items in Cart!</h2>
            </div>
        </div>
    @endif
@endsection
