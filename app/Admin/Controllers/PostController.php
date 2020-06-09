<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post);

        //搜索条件
        $grid->filter(function ($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            //like
            $filter->like('title', '标题');

            //select
            $cate = DB::table('categories')->pluck('title', 'id')->toArray();
            $filter->equal('cate_id', '类型')->select($cate);

            // 设置created_at字段的范围查询
            $filter->between('created_at', '时间')->datetime();

        });


        //文章分类
        $cate = DB::table('categories')->pluck('title', 'id')->toArray();

        $top = ['0' => '不置顶', '1' => '置顶'];

        //排序
        $grid->model()->orderBy('updated_at', 'desc');

        //查询字段
        $grid->column('id', __('Id'));
        $grid->column('title', '标题');
        $grid->column('cate_id', '类型')->using($cate)->label();
        $grid->column('is_top', '置顶')->using($top);
        $grid->column('created_at', '创建时间');
        $grid->column('updated_at', '更新时间');

        // 默认为每页10条
        $grid->paginate(10);

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        //文章类型
        $cate = DB::table('categories')->pluck('title', 'id')->toArray();

        //修改面板的样式和标题
        $show->panel()->style('info')->title('详情');

        $show->field('title', '标题');
        $show->field('subtitle', '简介');
        $show->cover('图片')->image();
        $show->cate_id('类型')->using($cate);

        $show->content('内容')->unescape()->as(function ($content) {
            //内容转义
            return htmlspecialchars_decode($content);
        });

        $top = ['0' => '不置顶', '1' => '置顶'];
        $show->is_top('置顶')->using($top);

        $show->field('created_at', '创建时间');
        $show->field('updated_at', '更新时间');


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post);

        $form->hidden('id', 'ID');
        $form->text('title', '标题')->rules('required');
        $cate = DB::table('categories')->pluck('title', 'id')->toArray();
        $form->select('cate_id', '类型')->options($cate)->rules('required');

        $form->textarea('subtitle', '简介')->rows(2);
        $form->image('cover', '封面');
        $form->editor('content', '内容');

        $top = ['0' => '不置顶', '1' => '置顶'];
        $form->select('is_top', '置顶')->options($top)->rules('required');

        $form->display('created_at', '创建时间');
        $form->display('updated_at', '修改时间');

        return $form;
    }


    /**
     * 重写 store, update, destroy 方法, 用于 富文本上传的base64图片转文件或删除
     */
    public function store()
    {
        request()['content'] = base64_to_file(request()['content']);

        parent::store();
    }

    public function update($id)
    {
        request()['content'] = base64_to_file(request()['content']);

        parent::update($id);
    }

    public function destroy($id)
    {
        $article = Post::find($id);
        base64_delete_image($article->content);

        parent::destroy($id);
    }


}
