@extends('layouts.app')

@section('content')
    <div class="container">
         <div class="row justify-content-center">
             <nav class="navbar navbar-toggler navbar-light col-12 pl-0 pb-3">
                 <a href="{{ route('blog.admin.categories.create') }}" class="btn btn-primary">Добавить</a>
             </nav>
             <div class="card col-12">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>№ </th>
                                <th>Категория</th>
                                <th>Родитель</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($paginator as $item)
                            @php /** @var \App\Models\BlogCategory $item */ @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href="{{ route('blog.admin.categories.edit', $item->id) }}">
                                        {{ $item->title }}
                                    </a>
                                </td>
                                <td @if(in_array($item->parent_id, [0, 1])) style="color: #ccc" @endif>
                                    {{ $item->parent_id }}
                                </td>
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
