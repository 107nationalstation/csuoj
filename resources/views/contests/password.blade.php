<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <form  class="" method="POST" action="{{ url("/contests/".$contest->id) }}">
    	{{ csrf_field() }}
        <th>
            <input class="form-control" type='text' name='password' placeholder="password"/>
        </th>
        <th>
            <font color="red">{{ $warning }}</font>
        </th>
        <th>
            <button class="btn btn-primary btn-block" type='submit' />submit</button>
        </th>
    </form>


@endsection