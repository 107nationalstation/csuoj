<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <table class="table table-striped table-hover table-responsive">
        <h1 class="text-center" id="contest_title">{{$contest->title}}</h1>
    	  <ul class="nav nav-tabs">
            <li><a href="{{ url('contests/'.($id)) }}">problem</a></li>
            <li><a href="{{url('contests/'.($id).'/status/now')}}">statu</a></li>
            <li class="active"> <a href="#">rank</a></li>
        </ul>
        <thead>
        	  <th>Rank</th>
            <th>User</th>
            <th>Solved</th>
            <th>Penalty</th>
            @for ($i = 0 ; $i < $index_problem ; $i ++)
              <th>{{chr($i + 65)}}</th>
            @endfor
        </thead>
        <tbody>
          @for ($i = 0 ; $i < $index_user ; $i ++)
              <tr>
                    <td>{{$i + 1}}</td>
                    <td>{{$users[$i]}}</td>
                    <td>{{$user_ac[$i]}}</td>
                    <td>{{$penalty[$users[$i]]}}</td>
                    @foreach ($problems as $problem)
                      @if($is_ac[$users[$i]][$problem->id] == 1)
                          <td>AC(-{{$no_ac_time[$users[$i]][$problem->id]}})</td>
                      @else
                          <td>(-{{$no_ac_time[$users[$i]][$problem->id]}})</td>
                      @endif
                    @endforeach
              </tr>
          @endfor
        </tbody>
    </table>
@endsection