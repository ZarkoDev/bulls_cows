@extends('layout', ['title' => __('custom.welcome')])

@section('content')
    <div class="row">
        <div class="mx-auto">
            <form action="{{ route('startGame') }}" method="POST">
                @csrf
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{ __('custom.nickname') }}</span>
                    </div>
                    
                    <input type="text" class="form-control" name="nickname" value="{{ session('nickname') }}" required>

                    <div class="invalid-tooltip {{$errors->has('nickname') ? 'd-block' : ''}}">
                        {{ $errors->first('nickname') }}
                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-info">{{ __('custom.start') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
