
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{--<nav class="navbar navbar-toggler-md  navbar-light bg-faded">--}}
                    {{--<a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">Написать</a>--}}
                {{--</nav>--}}
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Заголовок</th>
                                <th>Автор</th>
                                <th>Дата публикации</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recipes as $recipe)
                                @php
                                    /** @var \App\Models\KitchenRecipe $recipe */
                                @endphp
                                <tr >
                                    <td>{{ $recipe->id }}</td>
                                    <td>
                                        <a href="{{ route('kitchen.recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
                                    </td>
                                    <td>{{ $recipe->user->name }}</td>
                                    <td>
                                        {{ $recipe->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($recipes->total() > $recipes->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $recipes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
