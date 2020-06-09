<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

//php
class PhpController extends Controller
{
    //首页
    public function index()
    {

        //php
        $cate_id = 1;

        //列表
        $news = DB::table('posts')->where('cate_id',$cate_id)
            ->select('id', 'title', 'subtitle', 'clicks', 'cover', 'created_at')
            ->orderBy('created_at', 'desc')->get();

        //热门文章
        $hots = DB::table('posts')->where('cate_id', $cate_id)->select('id', 'title')
            ->orderBy('clicks', 'desc')->limit(10)->get();

        $list = [
            'news' => $news,
            'hots' => $hots,
            'label' => 'PHP'
        ];

        //dump($list);die;

        return view('php.index')->with('list', $list);
    }

}
