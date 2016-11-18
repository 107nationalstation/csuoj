@extends('layouts.app')

@section('content')
    <div id="content">
        <ul>
            <li style="margin: 50px 0;">
                <div class="title">
                    <a href="{{ url('articles/'.$article->id) }}">
                        <h4>{{ $article->title }}</h4>
                    </a>
                </div>
                <article>
                    <div class="body">
                        <p>{{ $article->body }}</p>
                    </div>
                </article>
            </li>
        </ul>
    </div>
@endsection
