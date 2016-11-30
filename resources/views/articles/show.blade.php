@extends('layouts.app')

@section('content')
    <div id="content">
        <ul>
            <li style="margin: 50px 0;">
                <div class="title">
                    <a href="{{ url('articles/'.$article->id) }}">
                        <h2>{{ $article->title }}</h2>
                    </a>
                </div>
                <article>
                    <div class="body">
                        <h4><p>{!! $article->body !!}</p><h4>
                    </div>
                </article>
            </li>
        <ul>
    </div>
@endsection
