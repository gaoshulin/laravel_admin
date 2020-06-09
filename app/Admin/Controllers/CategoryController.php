<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

        //搜索条件
        $grid->filter(function ($filter) {
            //like
            $filter->like('title', '标题');

            // 设置created_at字段的范围查询
            $filter->between('created_at', '时间')->datetime();

        });

        $grid->column('id', __('Id'));
        $grid->column('title', '标题');
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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', '标题');

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
        $form = new Form(new Category);

        $form->hidden('id', 'ID');
        $form->text('title', '标题')->rules('required');

        return $form;

    }
}
