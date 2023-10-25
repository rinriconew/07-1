<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
        <x-slot name="header">
            <head>
                <meta charset="utf-8">
                <title>Blog</title>
                <!-- Fonts -->
                <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            </head>
        </x-slot>
        
        <body>
     
        <h1>Blog Name</h1>
        <a href='/posts/create'>create</a>
        <div class='posts'>
            @foreach ($posts ?? [] as $post)
                <div class='post'>
                        <h2 class='title'>
                            <a href="/posts/{{ $post->id }}">
                                <h2 class='title'>{{ $post->title }}
                            </a>
                        </h2>
                        <a href="/categories/
                            {{ $post->category->id }}">{{ $post->category->name }}
                        </a>
                        <p class='body'>{{ $post->body }}</p>
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                    </form>
                </div>
            @endforeach
            
        <!-- 検索機能ここから -->
            <div>
                <form action="{{ route('posts.search') }}" method="POST">
                 @csrf
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <input type="submit" value="検索">
                </form>
            </div>
        </div>
        <!-- 検索機能ここまで -->
        
        <script>
            function deletePost(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        {{ Auth::user()->name }}
        

        </body>
    </x-app-layout>
</html>
    