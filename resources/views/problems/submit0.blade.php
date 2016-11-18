<!-- Styles -->
<link href="/css/submit.css" rel="stylesheet">


@extends('layouts.app')

@section('content')


<div class="container">
        <h1>Submit Your Code!</h1>

        <br>
        <label>Problem ID</label>

        <input class="form-control submit-setting" type="text" placeholder="1000" readonly>
        <form method="post" action="{{ url('test') }}">



            <label>Compiler</label>
            <br>
            <select class="form-control submit-setting" name="compiler">




                  <option value="GPP" selected="">GNU C++ Compiler</option>
                  <option value="GCC">GNU C Compiler</option>
                  <option value="Java">Java Compiler</option>



            </select>
            <br>
            <div class="submit-setting">
            <label>Code:</label>
            <button class="btn btn-primary pull-right" type="submit" accesskey="s">Submit</button>
            </div>
            <br>
            <textarea class="form-control" id="code_area" rows="25" cols="80" name="code"></textarea>
            <br>
            <button class="btn btn-primary btn-lg" type="submit">Submit</button>
        </form>
        <br>
</div>

@endsection
