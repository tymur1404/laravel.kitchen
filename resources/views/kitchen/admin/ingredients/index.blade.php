@extends('layouts.admin')

@section('content')

    <div class="right_col" role="main">
        <div >
            <div class="row">

                @include('kitchen.admin.ingredients.includes.result_messages')

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Ingredients </h2>
                            <a class="float-right" href="{{ route('kitchen.admin.ingredients.create') }}"><button class="btn btn-success">Create Ingredient</button></a>
                        </div>

                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-id">ID </th>
                                        <th class="column-title">Title </th>
                                        <th class="crud column-title no-link last">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($ingredients as $ingredient)
                                        <tr class="pointer">
                                            <td>{{ $ingredient->id }}</td>
                                            <td>{{ $ingredient->title }}</td>
                                            <td >
                                                <a href="{{ route('kitchen.admin.ingredients.edit', $ingredient->id) }}">
                                                    <button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>

                                                <form class="ingredient-destroy" method="POST" action="{{ route('kitchen.admin.ingredients.destroy', $ingredient->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i  data-id="{{ $ingredient->id }}" class="fa fa-trash-o"></i>
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
        @if($ingredients->total() > $ingredients->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $ingredients->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


@endsection
