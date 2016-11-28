<!-- Styles -->
<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <div id="content">
        <ul>
            {{$users->links()}}
                <table class="table table-striped table-hover table-condensed table-responsive">
                    <thead>
                    <form method="GET" action="/Status/Local/">
                        <th style="width:4%">ID</th>
                        <th style="width:10%">nickname</th>
                        <th style="width:16%">email</th>
                        <th style="width:62%">moto</th>
                        <th style="width:8%">solved</th>
                    </form>
                    </thead>
                    <tbody>


                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="#">{{$user->id}}</a></td>
                                    <td><a href="#">{{$user->name}}</a></td>
                                    <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                    <td><a href="#">{{$user->moto}}</a></td>
                                    <td><a href="#">{{$user->solved}}</a></td>

                                </tr>
                            @endforeach

                    </tbody>
                </table>
            {{$users->links()}}
        </ul>
    </div>
@endsection
