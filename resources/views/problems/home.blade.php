<!-- Styles -->
<link href="/css/problems.css" rel="stylesheet">


@extends('layouts.app')

@section('content')
    <div id="content">
        <ul>
            {{$problems->links()}}
                <table align="center" class="table table-striped table-hover table-condensed table-responsive">
                    <thead>
                        <th style="width: 10%"></th>
                        <th style="width: 11%">ID</th>
                        <th style="width: 45%" class="title-tags">
                            <div class="title">题目</div>
                        </th>

                        <th style=" width:34%">AC / Submit</th>
                    </thead>
                    @foreach ($problems as $problem)
                    <tr>
                        <td></td>
                        <td>{{$problem->id+1000}}</td>
                        <td class="title-tags">
                            <div class="title"><a href="{{ url('problems/'.($problem->id+1000)) }}">{{$problem->title}}</a></div>
                        </td>
                        <td>{{($problem->accepted)}} / {{($problem->submit)}}</td>
                    </tr>
                    @endforeach
                </table>
            {{$problems->links()}}
        </ul>
    </div>
@endsection
