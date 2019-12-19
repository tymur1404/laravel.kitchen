@extends('layouts.admin')

@section('content')
    <div class="right_col" role="main" style="min-height: 971px;">
        <div >

            @include('kitchen.admin.recipes.includes.result_messages_ajax')

            <div class="page-title">
                <div class="title_left">
                    <h3>Recipe </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                        <div class="col-sm-12">
                                            <h4 class="brief"><i>{{ $recipe->title }}</i></h4>
                                            <div class="col-xs-12">
                                                <h2><strong>Author: </strong> {{ $recipe->user->name }}</h2>
                                                <p><strong>Description: </strong> {{ $recipe->description }} </p>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="brief">Ingredients:</h4>

                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">Title </th>
                                            <th class="description column-title">Quantity </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($recipe->ingredient as $i)
                                            <tr class="pointer">
                                                <td>{{ $i->title }}</td>
                                                <td>
                                                    @csrf
                                                    <input type="hidden" name="ingredient_id" value="{{ $i->id }}">
                                                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                                                    <input  data-toggle="tooltip" title="Press 'Enter' after changing" class="ingredient-update"  type="text"  value="{{ $quantity[$i->id] }}"/>
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
    </div>
@endsection
