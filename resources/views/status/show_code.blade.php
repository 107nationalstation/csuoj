<!-- Styles -->
<link href="/css/common.css" rel="stylesheet">

@extends('layouts.app')

@section('content')

    <div class="container">
        <h4>运行结果:{{ $statu->statue }}</h4>
        <div id="sta" >
            <div id="sta1">
                <h5 >RunId: {{ $statu->id }}</h5>
                
                <h5 >题号: {{ $statu->problem_id }}</h5>
                
                <h5 >用户: {{ $statu->user_name }}</h5>
            </div>
            <div id="sta2">
                <h5 >编译器: {{ $statu->compiler }}</h5>
                <h5 >运行时间: <span id="runtime">{{ $statu->running_time }} MS</span></h5>
                <h5 >峰值内存: <span id="runmemory">{{ $statu->running_memory }} K</span></h5>
                <h5 >提交时间: {{ $statu->created_at }}</h5>
            </div>
        </div>
        
        <h4>源代码:</h4>
        <pre class="sh_cpp" id="code_cen">{{ $statu->code }}</pre>
                
        
    </div>

@endsection