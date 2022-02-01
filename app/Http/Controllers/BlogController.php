<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function showList()
    {

      $blogs = DB::table('blogs')->orderBy('created_at', 'desc')->simplePaginate(10);

      return view('blog.list',['blogs'  => $blogs]);
    }


    public function showDetail($id)
    {
      $blog = Blog::find($id);

      if(is_null($blog)){
        \Session::flash('err_msg', 'データがありません。');
        return redirect(route('blogs'));
      }

      if(is_null($blog->path)){
        $blog->path = 'public/images/noimg.png';
      }

      return view('blog.detail', ['blog' => $blog]);
    }


    public function showCreate()
    {
      return view('blog.form');
    }


    public function exeStore(BlogRequest $request)
    {

      $inputs = $request->all();
      if($request->hasFile('image')){
        $filename=request()->file('image')->getClientOriginalName();
            $inputs['path']=request('image')->storeAs('public/images', $filename);
      }else{
        $inputs['path'] = null;
      }

      \DB::beginTransaction();
      try{
        Blog::create($inputs);
        \DB::commit();
      }catch(\Throwable $e){
        \DB::rollback();
        abort(500);
      }
      \Session::flash('err_msg', 'ブログを登録しました。');
      return redirect(route('blogs'));
    }


    public function showEdit($id)
    {
      $blog = Blog::find($id);
      if(is_null($blog)){
        \Session::flash('err_msg', 'データがありません。');
        return redirect(route('blogs'));
      }
      if(is_null($blog->path)){
        $blog->path = 'public/images/noimg.png';
      }
      return view('blog.edit', ['blog' => $blog]);
    }


    public function exeUpdate(BlogRequest $request)
    {
      $inputs = $request->all();
      if($request->hasFile('image')){
        $filename=request()->file('image')->getClientOriginalName();
        $inputs['path'] = request('image')->storeAs('public/images', $filename);
      }else{
        $inputs['path'] = 'public/images/noimg.png';
      }

      \DB::beginTransaction();
      try{
        $blog = Blog::find($inputs['id']);
        $blog->fill([
          'title' => $inputs['title'],
          'content' => $inputs['content'],
          'path' => $inputs['path'],
        ]);
        $blog->save();
        \DB::commit();
      }catch(\Throwable $e){
        \DB::rollback();
        abort(500);
      }
      \Session::flash('err_msg', 'ブログを更新しました。');
      return redirect(route('blogs'));
     }


     public function delete($id)
     {
       if(empty($id)){
         \Session::flash('err_msg', 'データがありません。');
         return redirect(route('blogs'));
       }
       try{
         Blog::destroy($id);
       }catch(\Throwable $e){
         abort(500);
         }
         \Session::flash('err_msg', '削除しました。');
         return redirect(route('blogs'));
    }


    public function showsearch()
    {
      return view('blog.search');
    }


    public function exeSearch(Request $request)
    {
      $key = $request['key'];

      $query = Blog::query();

        if (!empty($key)) {
            $query->where('title', 'like', '%' . $key . '%')->orWhere('content', 'like', '%' . $key . '%');
        }

        $blogs = $query->orderBy('created_at', 'desc')->simplePaginate(10);
        return view('blog.keyindex', ['blogs' => $blogs]);
    }
}
