@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">{{ __('Validate Otp') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $item)
                            <p class="text-center text-danger">{{$item}}</p>
                        @endforeach
                    @endif
                    <form method="POST" action="{{ route('validate.otp.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('OTP') }}</label>
                            <div class="col-md-6">
                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus>
                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Validate OTP') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
