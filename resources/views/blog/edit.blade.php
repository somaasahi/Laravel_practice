@extends('layout')
@section('title', 'ブログ投稿')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ブログフォーム</h2>
        <form method="POST" enctype="multipart/form-data" action="{{ route('update') }}" onSubmit="return checkSubmit()">
          @csrf
          <input type="hidden" name="id" value="{{ $blog->id }}">

            <div class="form-group">
                <label for="title">タイトル</label>
            <input id="title" name="title" class="form-control"
                    value="{{ $blog->title }}" type="text">
                @if ($errors->has('title'))
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="content">本文</label>
                <textarea id="content" name="content" class="form-control"
                rows="4">{{ $blog->content }}</textarea>
                @if ($errors->has('content'))
                    <div class="text-danger">{{ $errors->first('content') }}</div>
                @endif
            </div>

            <div style="width:10rem;">
              <p>現在の画像:</p>
              <img src="{{ Storage::url($blog->path) }}" style="width:100%">
            </div>

            <div class="form-group" style="margin-top:20px;">
              <label for="image">変更:↓</label>
              <input type="file" class="form-control-file" name="image" id="image">
              @if ($errors->has('image'))
                  <div class="text-danger">{{ $errors->first('image') }}</div>
              @endif
            </div>


            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('blogs') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
