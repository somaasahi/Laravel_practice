@extends('layout')
@section('title', 'ブログ投稿')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ブログ投稿フォーム</h2>
        <form method="POST" action="{{ route('store') }}"
        enctype="multipart/form-data" onSubmit="return checkSubmit()">
          @csrf

            <div class="form-group">
                <label for="title">タイトル</label>
            <input id="title" name="title" class="form-control"
                    value="{{ old('title') }}" type="text">
                @if ($errors->has('title'))
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="content">本文</label>
                <textarea id="content" name="content"class="form-control"
                rows="4">{{ old('content') }}</textarea>
                @if ($errors->has('content'))
                    <div class="text-danger">{{ $errors->first('content') }}</div>
                @endif
            </div>

            <div class="form-group">
              <label for="image">画像</label>
              <input type="file" class="form-control-file" name="image" id="image">
              @if ($errors->has('image'))
                  <div class="text-danger">{{ $errors->first('image') }}</div>
              @endif

            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('blogs') }}">
                    キャンセル</a>
                <button type="submit" class="btn btn-primary">
                    投稿する</button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
