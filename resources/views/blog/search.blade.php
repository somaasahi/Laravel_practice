@extends('layout')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
      <h3>キーワード検索</h3>
      <form method="POST" action="{{ route('exesearch') }}">
        @csrf

          <div class="form-group">
          <input id="key" name="key" class="form-control"
              value="{{ old('key') }}" type="text">
              @if ($errors->has('key'))
              <div class="text-danger">{{ $errors->first('key') }}</div>
              @endif
          </div>

          <button type="submit" class="btn btn-primary">
              検索する
          </button>
         </form>
      </div>

  </div>

@endsection
