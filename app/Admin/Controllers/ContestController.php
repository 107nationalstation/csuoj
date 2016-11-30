<?php

namespace App\Admin\Controllers;

use App\Contest;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ContestController extends Controller
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
        return Admin::grid(Contest::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title();
            $grid->start_time()->sortable();
            $grid->end_time()->sortable();

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
        return Admin::form(Contest::class, function (Form $form) {
            $form->text('title', 'title');
            $form->time('start_time' , 'start_time')->format('YYYY-M-D HH:mm:ss');
            $form->time('end_time' , 'end_time')->format('YYYY-M-D HH:mm:ss');
            $form->radio('contest_type', 'contest_type')->values(['public' => 'public', 'private' => 'private'])->default('public');
            $form->text('password' , 'password');
        });
    }
}
