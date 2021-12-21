@extends('layout')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
      <h3>ブログ記事詳細</h3>
      @if(session('err_msg'))
      <p class="text-denger">
        {{ session('errmsg') }}
      </p>
      @endif
      <span>作成日:{{ $blog->created_at }}</span>
      <span>更新日:{{ $blog->updated_at }}</span>
      <p>タイトル:{{ $blog->title }}</p>
      <p>詳細:{{ $blog->content }}</p>
      <div style="width:10rem;">
        <p>画像:</p>
        <img src="{{ Storage::url($blog->path) }}" style="width:100%">
      </div>
  </div>
</div>
@endsection
