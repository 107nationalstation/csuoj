<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <table class="table table-striped table-hover table-responsive">
        <h1 class="text-center" id="contest_title">{{$contest->title}}</h1>
    	  <ul class="nav nav-tabs">
            <li class="active"><a href="#">problem</a></li>
            <li><a href="{{url('contests/'.($id).'/status/now')}}">statu</a></li>
            <li><a href="{{url('contests/'.($id).'/rank/now')}}">rank</a></li>
        </ul>
        <thead>
        	<th style="width: 10%"></th>
            <th style="width: 11%">ID</th>
            <th style="width: 45%">题目</th>
            <th style=" width:34%">AC / Submit</th>
        </thead>
        <tbody>
        	@foreach ($problems as $problem)
          		<tr>
          			<td></td>
          			<td>{{chr($loop->index + 65)}}</td>
          			<td><a href="{{ url( 'contests/'.($contest->id).'/'.(chr($loop->index + 65)) ) }}">{{$problem->title}}</a></td>
          			<td>{{$accepted[$loop->index]}} / {{$submit[$loop->index]}}</td>
	            </tr>
          @endforeach
        </tbody>
    </table>
@endsection