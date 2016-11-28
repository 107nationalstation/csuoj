<?php

namespace App\Admin\Controllers;

use App\Problem;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ProblemController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Problem::class, function (Grid $grid) {
            $grid->id()->value(function($id){
                $ret = $id + 1000;
                return $ret;
            });
            $grid->title();
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Problem::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('title', 'title');
            $form->number('time_limit', 'time_limit');
            $form->number('memory_limit', 'memory_limit');
            $form->editor('description', 'description');
            $form->editor('input', 'input');
            $form->editor('output', 'output');
            $form->textarea('sample_input', 'sample_input');
            $form->textarea('sample_output', 'sample_output');
            $form->radio('spj', 'spj')->values([1 => 'yes', 0 => 'no'])->default('no');
            $form->editor('hint', 'hint');
            $form->text('source', 'source');
            //$form->file('source');
            $form->number('user_id', 'uploader_id');
        });
    }
}
