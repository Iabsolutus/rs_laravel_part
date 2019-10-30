@extends('layouts.appAuth')

@section('content')


    <div class="container">

        <form class="form-signin" role="form" action="{{ url('/login') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                    <h2 class="form-signin-heading">Please sign in</h2>
            </div>



            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <input id="name" type="text" class="form-control" name="name" placeholder="Login" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>


            <button class="btn btn-lg btn-primary btn-block form-signin-heading" type="submit" name="log_in">Sign in</button>


        </form>

    </div>

@endsection
