@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign In</h1>
            <br>
            <h4><a href="{{ route('get.register') }}">sign up</a>&nbsp; Do not have account</h4>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <br>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary">Sign In</button>

            </form>
        </div>
    </div>
@endsection
