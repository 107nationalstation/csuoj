<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <table class="table table-striped table-hover table-responsive">
        <h1 class="text-center" id="contest_title">{{$contest->title}}</h1>
        <ul class="nav nav-tabs">
            <li><a href="{{ url('contests/'.($id)) }}">problem</a></li>
            <li class="active"><a href="#">statu</a></li>
            <li><a href="{{url('contests/'.($id).'/rank/now')}}">rank</a></li>

        </ul>

        <div id="content">
        <ul>
            {{$status->links()}}
                <form  class="" id="status_filter" method="GET" action="{{ url("/contests/".$contest->id."/status/now") }}">
                    <table class="table table-striped  table-responsive">
                    <thead>
                        <th style="width:6%">
                            <input class="form-control" type='text' name='problem_id' placeholder="题号"/>
                        </th>
                        <th style="width:10%">
                            <input class="form-control" type='text' name='user_name' placeholder="用户名"/>
                        </th>
                        <th style="width:14%">
                            <select class="form-control" name='statue'>
                            <option value='' selected>All</option>
                            <option value='Accepted'>Accepted</option>
                            <option value='Wrong Answer'>Wrong Answer</option>
                            <option value='Time Limit Exceeded'>Time Limit Exceeded</option>
                            <option value='Memory Limit Exceeded'>Memory Limit Exceeded</option>
                            <option value='Presentation Error'>Presentation Error</option>
                            <option value='Output Limit Exceeded'>Output Limit Exceeded</option>



                        <option value='System Error'>System Error</option>
                        <option value='Submitting'>Submitting</option>
                        <option value='AuthorizationError'>AuthorizationError</option>
                        <option value='OverFailed'>OverFailed</option>
                        <option value='FetchError'>FetchError</option>
                        </select>
                        </th>
                        <th class="hidden-xs" style="width:7%"></th>
                        <th class="hidden-xs" style="width:7%"></th>
                        <th style="width:10%">
                            <select class="form-control" name='compiler'>
                                <option value='' selected>All</option>




                                <option value='GPP'>GPP</option>
                                <option value='GCC'>GCC</option>
                                <option value='Java'>Java</option>

                            </select>
                        </th>
                        <th style="width:7%">
                            <button class="btn btn-primary btn-block" type='submit' />筛选</button>
                        </th>
                        <th class="hidden-xs" style="width:17%"></th>
                    </thead>
                    </table>
                </form>
                <table class="table table-striped table-hover table-condensed table-responsive">
                    <thead>
                <th>ID</th>
                <th>题号</th>
                <th>用户名</th>
                <th>运行状态</th>
                <th>运行时间</th>
                <th>峰值内存</th>
                <th>编译器</th>
                <th>代码长度</th>
                <th>提交时间</th>
            </thead>
            <tbody>
                @foreach ($status as $statu)
                    <tr>
                        <td>{{$statu->id}}</td>
                        <td>{{$statu->problem_tag}}</td>
                        <td>{{$statu->user_name}}</td>
                        <td>{{$statu->statue}}</td>
                        <td>{{$statu->running_time}} MS</td>
                        <td>{{$statu->running_memory}} K</td>
                        <td>{{$statu->compiler}}</td>
                        <td>{{$statu->code_length}}B</td>
                        <td>{{$statu->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
                    </table>
                {{$status->links()}}
            </ul>
        </div>

        
    </table>
@endsection