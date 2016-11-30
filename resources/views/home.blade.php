@extends('layouts.app')

@section('content')
    <div id="content">
        <ol>
            {{$articles->links()}}
            @foreach ($articles as $article)
            <li style="margin: 50px 0;">
                <div class="title">
                    <a href="{{ url('articles/'.$article->id) }}">
                        <h2>{{ $article->title }}</h2>
                    </a>
                </div>
                <div class="body">
                    <h4><p>{!! $article->body !!}</p><h4>
                </div>
            </li>
            @endforeach
        </ol>
    </div>
@endsection
