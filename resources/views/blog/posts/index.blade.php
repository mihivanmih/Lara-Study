@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="mx-auto">
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
