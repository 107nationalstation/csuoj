<!-- Styles -->
<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')

    <div class="container">
        <h4>提交人:{{ $paste->title }}</h4>
        
        <h4>Content:</h4>
        <pre class="sh_cpp" id="code_cen">{{ $paste->content }}</pre>
                
        
    </div>

@endsection