@extends('layouts.app')

@section('content')
    <div id="content">
        <ul>
            {{$articles->links()}}
            @foreach ($articles as $article)
            <li style="margin: 50px 0;">
                <div class="title">
                    <a href="{{ url('articles/'.$article->id) }}">
                        <h4>{{ $article->title }}</h4>
                    </a>
                </div>
                <div class="body">
                    <p>{{ $article->body }}</p>
                </div>
            </li>
            @endforeach
            {{$articles->links()}}
        </ul>
    </div>
@endsection
