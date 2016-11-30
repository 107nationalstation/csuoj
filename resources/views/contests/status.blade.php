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
@endsection