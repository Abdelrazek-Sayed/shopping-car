@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up</h1>
            <br>
            <h4><a href="{{ route('get.login') }}">sign in</a> &nbsp; already have account</h4>
            <br>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <br>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="text" id="email" name="email" class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="password" name="password_confirmation" class="form-control">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Sign Up</button>

            </form>
        </div>
    </div>
@endsection
