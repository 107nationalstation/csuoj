<!-- Styles -->
<link href="/css/problem.css" rel="stylesheet">


@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div id="problem_body" class="col-sm-12">
            <div class="center-block" id="problem_title">
                <h1 id="title_text">{{$problem->title}}

                </h1>

                <p>Time Limit: <span id="timelimit_text">{{$problem->time_limit}} ms</s></span></p>

                <p>Memory Limit: <span id="memorylimit_text">{{$problem->memory_limit}} ms</span></p>

            </div>
            <div id="problem_description">
                <a class="target-fix" id="description"></a>

                <h2>Description</h2>
                <div class="desc_text" id="description_text"><p>{!! $problem->description !!}</p></div>
            </div>
            <div id="problem_input">
                <a class="target-fix" id="input"></a>

                <h2>Input</h2>

                <div class="desc_text" id="inputdescription_text">{!! $problem->input !!}</div>
            </div>
            <div id="problem_output">
                <a class="target-fix" id="output"></a>

                <h2>Output</h2>

                <div class="desc_text" id="outputdescription_text">{!! $problem->output !!}</div>
            </div>
            <div id="problem_sampleinput">
                <a class="target-fix" id="sampleinput"></a>

                <h2>Sample Input</h2>

                <div class="desc_text" id="inputsample_text"><pre>{{$problem->sample_input}}</pre></div>
            </div>
            <div id="problem_sampleoutput">
                <a class="target-fix" id="sampleoutput"></a>

                <h2>Sample Output</h2>

                <div class="desc_text" id="outputsample_text"><pre>{{$problem->sample_output}}</pre></div>
            </div>
            <div id="problem_hint">
                <a class="target-fix" id="hint"></a>

                <h2>Hint</h2>

                <div class="desc_text" id="hint_text"><p>{!! $problem->hint !!}</p></div>
            </div>

            <div id="problem_source">
                <a class="target-fix" id="source"></a>

                <h2>Source</h2>

                <div class="desc_text" id="source_text">{{$problem->source}}</div>
            </div>

        </div>

    </div>
    <br>


    <a class="btn btn-primary center-block" id="btn_submit"
       href="{{ url( 'contests/'.($contest->id).'/'.($problem_tag).'/submit' ) }}">提交代码</a>

    <br>
</div>
@endsection
