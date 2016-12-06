<!-- Styles -->
<link href="/css/submit.css" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <div id="content">
        <form method="post" action="{{ url('paste') }}">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">


            <label>Content:</label>

            <br>
                <textarea class="form-control" id="code_area" rows="25" cols="80" name="content"></textarea>
            <br>
            <button class="btn btn-primary btn-lg" type="submit">Submit</button>

        </form>
        <br>
    </div>
@endsection
