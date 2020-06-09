<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<meta name="apple-mobile-web-app-status-bar-style" content="black">
  	<meta name="apple-mobile-web-app-capable" content="yes">
  	<meta name="format-detection" content="telephone=no">
	<title>{{ $list['info']->title }}</title>
	<link rel="stylesheet" href="{{ asset('static/layui/css/layui.css') }}">
	<link rel="stylesheet" href="{{ asset('static/css/common.css') }}">
	<link rel="stylesheet" href=".{{ asset('static/css/detail.css') }}">
</head>
<body>
	{{--菜单栏--}}
	@include('common.nave');

	<div class="layui-container">
		<div class="layui-row layui-col-space20">
			<div class="layui-col-md8">
				<div class="layui-row">
					<div class="layui-col-md12">
						<div class="main">
							<div class="title">
								<p>{{ $list['info']->title }}</p>
								<div class="layui-row stat">
									<div class="layui-col-md3 layui-col-xs12">发布时间：<em>{{ $list['info']->created_at }}</em></div>
									<div class="layui-col-md2 layui-col-xs6">分类：{{ $list['info']->type }}</div>
									{{--<div class="layui-col-md2 layui-col-xs6">作者：<a href="javascript:;">木子</a></div>--}}
									<div class="layui-col-md5 layui-col-xs12">
										<div class="layui-row">
											{{--<div class="layui-col-md6 layui-col-xs6">
												<i class="layui-icon layui-icon-reply-fill"></i>
												<em> 0 条评论</em>
											</div>--}}
											<div class="layui-col-md6 layui-col-xs6">
												<i class="layui-icon layui-icon-read"></i>
												<em>{{ $list['info']->clicks }} 次阅读</em>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="content" id="content">
								{!! $list['info']->content !!}
							</div>

							{{--<div class="operation">
								<a href="javascript:;" class="layui-btn layui-btn-normal">点赞</a>
								<a href="javascript:;" class="layui-btn layui-btn-warm">赞赏</a>
							</div>--}}

						</div>
					</div>
					<div class="layui-col-md12 margin20"></div>
					<div class="layui-col-md12">
						<div class="layui-card">
						  	<div class="layui-card-header">
								<span>
									相关推荐
								</span>
						  	</div>
						  	<div class="layui-card-body">
						  		<div class="layui-row">

						  			@foreach($list['recom'] as $item)
						  			<div class="layui-col-md4">
										<div class="layui-card">
										  	<a href="{{ url('index/details',['id' => $item->id]) }}" class="layui-card-body recommend">
										    	<img src="{{ asset('upload/'.$item->cover)}}" width="100%" height="150">
									    		<p>{{ $item->title }}</p>
										  	</a>
										</div>
					  				</div>
									@endforeach

						  		</div>
						  	</div>
						</div>
					</div>
				</div>
	        </div>


	        <div class="layui-col-md4">
				<div class="layui-row">
					<div class="layui-col-md12">
						<div class="layui-card">
						  	<div class="layui-card-header">
								<span class="layui-breadcrumb" lay-separator="|">
									{{--<a href="javascript:;">站点统计</a>--}}
									<a href="javascript:;">联系站长</a>
								</span>
						  	</div>
						  	<div class="layui-card-body" id="stat" style="display: none;">
						  		<table class="layui-table">
								  	<colgroup>
								    	<col width="120">
								    	<col width="230">
								  	</colgroup>
								  	<tbody>
								    	<tr>
								      		<td>运行时间：</td>
								      		<td>856 天</td>
								    	</tr>
								    	<tr>
								      		<td>发表文章：</td>
								      		<td>1024 篇</td>
								    	</tr>
								    	<tr>
								      		<td>注册用户：</td>
								      		<td>3689 人</td>
								    	</tr>
								  	</tbody>
								</table>
						  	</div>
						  	<div class="layui-card-body" id="binfo">
						  		<table class="layui-table">
								  	<colgroup>
								    	<col width="120">
								    	<col width="230">
								  	</colgroup>
								  	<tbody>
								    	<tr>
								      		<td>QQ：</td>
								      		<td>1453811292</td>
								    	</tr>
								    	<tr>
								      		<td>Wechat：</td>
								      		<td>1453811292</td>
								    	</tr>
								    	<tr>
                                            <td>Email：</td>
                                            <td>1452811292@qq.com</td>
								    	</tr>
								  	</tbody>
								</table>
						  	</div>
						</div>
					</div>
					<div class="layui-col-md12 margin20"></div>
					<div class="layui-col-md12">
						<div class="layui-card">
						  	<div class="layui-card-header">
								<span>
									热门文章
								</span>
						  	</div>
						  	<div class="layui-card-body">
								<table class="layui-table" lay-skin="nob">
								  	<tbody>
                                        @foreach($list['hots'] as $val)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('index/details',['id' => $val->id]) }}">{{ $val->title }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
								  	</tbody>
								</table>
						  	</div>
						</div>
					</div>
					<div class="layui-col-md12 margin20"></div>
					<div class="layui-col-md12">
						<div class="layui-card">
						  	<div class="layui-card-header">
								<span>
									捐助本站
								</span>
						  	</div>
						  	<div class="layui-card-body" style="text-align: center;">
						    	<img src="{{ asset('static/images/wxpay.jpg') }}" style="display: inline-block;width: 258px;">
						    	<br/>
						    	<p>无论多少，都是心意!</p>
						  	</div>
						</div>
					</div>
				</div>
	        </div>
		</div>
	</div>

{{--脚部--}}
@extends('common.footer')
