<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <form  class="" method="POST" action="{{ url("/contests/".$contest->id."/enter/password") }}">
        <th>
            <input class="form-control" type='text' name='password' placeholder="password"/>
        </th>
        <th>
            <font color="red">{{ $warning }}</font>
        </th>
    </form>
@endsection