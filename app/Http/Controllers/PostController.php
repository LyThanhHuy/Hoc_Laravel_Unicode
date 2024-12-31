<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function index()
    {
        $title = 'Danh sach bai viet';

        $allPosts = Post::withTrashed()
        ->orderBy('deleted_at', 'ASC')
        ->orderBy('id', 'DESC')
        ->get();

        return view('clients/posts/lists', compact('title', 'allPosts'));
    }

    public function add()
    {
        $dataInsert = [
            'title' => 'Pho di bo ho guom dong vui',
            'content' => 'Pho di bo ho guom dong vui',
            'status' => 1
        ];

        // $post = Post::create($dataInsert);

        // $insertStatus = Post::insert($dataInsert);
        // dd($insertStatus);

        $check = true;

        $post = new Post;
        $post->title = 'Bai viet moi';
        $post->content = 'Noi dung moi';
        if ($check) {
            $post->status = 1;
        }
        $post->save();

        echo 'Id vua insert: ' . $post->id;
    }

    public function update($id)
    {
        // tao doi tuong cua ban ghi hien tai
        $post = Post::find($id);
        // $post->title = 'bai viet update';
        // $post->content = 'Noi dung update';
        // $post->save();

        $dataUpdate = [
            'title' => 'Bai viet update 2',
            'content' => 'Noi dung update 2'
        ];
        // $status = $post->update($dataUpdate);
        // $status = Post::where('id', $id)->update($dataUpdate);
        // dd($status);

        $post = Post::updateOrCreate([
            'id' => 16
        ], $dataUpdate);

        dd($post);
    }

    public function delete($id)
    {
        // $idCollect = collect([10, 11, 12]);
        // $status = Post::destroy($id);

        $status = Post::where('id', $id)->delete();

        dd($status);
    }

    public function handleDeleteAny(Request $request)
    {
        $deleteArr = $request->delete;
        if (!empty($deleteArr)) {
            $status = Post::destroy($deleteArr);
            if ($status) {
                $msg = 'Da xia' . count($deleteArr) . 'bai viet';
            } else {
                $msg = 'Ban khong the xoa vao luc nay vui long thu lai sau';
            }
        } else {
            $msg = 'Vui long chon bai viet muon xoa';
        }
        return redirect()->route('posts.index')->with('msg', $msg);
    }

    public function restore($id)
    {
        // $post = Post::withTrashed()->where('id', $id)->first();
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->restore();
            return redirect()->route('posts.index')->with('msg', 'Khoi phuc bai viet thanh cong');
        }
        return redirect()->route('posts.index')->with('msg', 'Bai viet khong ton tai');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->forceDelete();
            return redirect()->route('posts.index')->with('msg', 'Xoa bai viet thanh cong');
        }
        return redirect()->route('posts.index')->with('msg', 'Bai viet khong ton tai');
    }
}
