<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


//网站首页
class IndexController extends Controller
{
    //首页
    public function index()
    {

        //首页轮播
        $banner = DB::table('banners')->select('id', 'image', 'url')->get();

        //置顶 一条记录
        $article = DB::table('posts')->select('id', 'title', 'subtitle', 'created_at')
            ->where('is_top', 1)->orderBy('updated_at', 'desc')->first();

        //最新推荐
        $news = DB::table('posts')->join('categories', 'posts.cate_id', '=', 'categories.id')
            ->select('posts.id', 'posts.title', 'posts.subtitle', 'posts.clicks', 'posts.cover', 'posts.created_at', 'categories.title as tit')
            ->orderBy('created_at', 'desc')->limit(5)->get();

        //热门文章
        $hots = DB::table('posts')->select('id', 'title')->orderBy('clicks', 'desc')->limit(10)->get();

        $list = [
            'banner' => $banner,
            'article' => $article,
            'news' => $news,
            'hots' => $hots,
        ];

        //dump($list);die;

        return view('index.index')->with('list', $list);
    }


    //文章详情
    public function details($id)
    {
        //点击量加 1
        DB::table('posts')->where('id', $id)->increment('clicks', 1);

        //查询信息
        $info = DB::table('posts')->where('id', $id)
            ->select('id', 'title', 'content', 'created_at', 'cate_id', 'clicks')
            ->first();

        $info->type = DB::table('categories')->where('id', $info->cate_id)->value('title');

        $info->content = replace_content_file_url($info->content);

        //dump($info);die;

        //相关推荐  同类型文章  点击量最多三条
        $recom = DB::table('posts')->where('cate_id', $info->cate_id)
            ->select('id', 'title', 'cover')->orderBy('clicks', 'desc')
            ->limit(3)->get();

        //热门文章
        $hots = DB::table('posts')->select('id', 'title')->orderBy('clicks', 'desc')->limit(5)->get();

        $list = [
            'info' => $info,
            'recom' => $recom,
            'hots' => $hots,
        ];

        return view('index.details', ['list' => $list]);
    }

}
