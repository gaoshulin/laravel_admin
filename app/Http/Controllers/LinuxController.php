<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

//linux
class LinuxController extends Controller
{
    //首页
    public function index()
    {

        //php
        $cate_id = 4;

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
            'label' => 'LINUX'
        ];

        //dump($list);die;

        return view('linux.index')->with('list', $list);
    }

}
