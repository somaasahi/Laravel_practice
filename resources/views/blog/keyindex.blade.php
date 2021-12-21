
@extends('layout')
@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
      <h2>検索一覧</h2>
      @if(session('err_msg'))
      <p class="text-denger">
        {{ session('err_msg') }}
      </p>
      @endif
      <table class="table table-striped">
          <tr>
              <th>記事ID</th>
              <th>タイトル</th>
              <th>日付</th>
              <th>編集</th>
              <th>削除</th>
          </tr>
          @foreach($blogs as $blog)
          <tr>
              <td>{{ $blog->id }}</td>
              <td><a href="/blog/show/{{$blog->id }}">
              {{ $blog->title }}</a></td>
                <td>{{ $blog->updated_at }}</td>
                <td><button type="button" class="btn btn-info"
                  onclick="location.href='blog/edit/{{$blog->id }}'">編集</button></td>
                  <form method="POST" action="{{ route('delete', $blog->id) }}" onSubmit="return checkDelete()">
                    @csrf
                  <td><button type="submit" class="btn btn-info">削除</button></td>
                  </form>
          </tr>
          @endforeach
      </table>
      <div class="text-align-center" style="margin-bottom:45px;">{{ $blogs->links() }}</div>
  </div>
</div>
@endsection
