@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <nav class="navbar navbar-toggler navbar-light col-12 pl-0 pb-3">
                <a href="{{ route('blog.admin.posts.create') }}" class="btn btn-primary">Написать</a>
            </nav>
            @if(session('success'))
                <div class="col-md-12 p-0">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{ session()->get('success') }}


                        @if(!session('restore'))
                            <a href="{{ route('blog.admin.posts.restore', session()->get('id')) }}" class="btn btn-primary ml-5">восстановить</a>
                        @endif
                    </div>
                </div>
            @endif
            <div class="card col-12">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>№ </th>
                            <th>Автор</th>
                            <th>Категория</th>
                            <th>Заголовок</th>
                            <th>Дата публикации</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paginator as $post)
                            @php /** @var \App\Models\BlogPost $item */ @endphp
                            <tr @if(!$post->is_published) style="background: #ccc;" @endif>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->category->title }}</td>
                                <td>
                                    <a href="{{ route('blog.admin.posts.edit', $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 p-0">
                {{ $paginator->links() }}
            </div>
        </div>
    </div>
@endsection
