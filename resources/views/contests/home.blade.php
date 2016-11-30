<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <table class="table table-striped table-hover table-responsive">
        <thead>
            <th style="width:24%">比赛名称</th>
            <th style="width:15%">开始时间</th>
            <th style="width:15%">结束时间</th>
            <th style="width:10%">比赛类型</th>
            <th style="width:9%">状态</th>
        </thead>
        <tbody>
        	@foreach ($contests as $contest)
          		<tr>
	                <td><a href="{{ url('contests/'.($contest->id)) }}">{{$contest->title}}</a></td>
	                <td>{{$contest->start_time}}</td>
	                <td>{{$contest->end_time}}</td>
	                <td>{{$contest->contest_type}}</td>
                    @if (time() > strtotime($contest->end_time))
                        <td>finished</td>
                    @elseif (time() < strtotime($contest->start_time))
                        <td>waiting</td>
                    @else
                        <td>running</td>
                    @endif
	            </tr>
            @endforeach
        </tbody>
    </table>
@endsection