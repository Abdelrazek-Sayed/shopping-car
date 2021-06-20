@extends('layouts.master')
@section('title')
    home
@endsection
@section('content')

    <br><br><br>
    <section>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="card mb-2">
                        <img src="{{ $product->image }}" class="img-responsive">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <h5 class="card-title">{{ $product->price }} $ </h5>
                            <a href="{{ route('add.to.cart',$product->id) }}" class="btn btn-success">Add to cart</a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </section>


@endsection
