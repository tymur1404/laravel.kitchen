@extends('layouts.admin')

@section('content')

    <div class="right_col" role="main">
        <div >
            <div class="row">

                @include('kitchen.admin.recipes.includes.result_messages')

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Recipes </h2>
                            <a class="float-right" href="{{ route('kitchen.admin.recipes.create') }}"><button class="btn btn-success">Create Recipe</button></a>
                        </div>

                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">Title </th>
                                        <th class="description column-title">Description </th>
                                        <th class="column-title">Author </th>
                                        <th class="crud column-title no-link last">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($recipes as $recipe)
                                    <tr class="pointer">
                                        <td>{{ $recipe->title }}</td>
                                        <td >{{ $recipe->description }}</td>
                                        <td>{{ $recipe->user->name }}</td>
                                        <td >
                                            <a href="{{ route('kitchen.admin.recipes.show', $recipe->id) }}">
                                                <button class="btn btn-info"> <i class="fa fa-eye"></i></button></a>
                                            <a href="{{ route('kitchen.admin.recipes.edit', $recipe->id) }}">
                                                <button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>

                                            <form class="recipe-destroy" method="POST" action="{{ route('kitchen.admin.recipes.destroy', $recipe->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i  data-id="{{ $recipe->id }}" class="fa fa-trash-o"></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
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
