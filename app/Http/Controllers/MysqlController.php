<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

//mysql
class MysqlController extends Controller
{
    //首页
    public function index()
    {

        //php
        $cate_id = 3;

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
            'label' => 'MySQL'
        ];

        //dump($list);die;

        return view('mysql.index')->with('list', $list);
    }

}
