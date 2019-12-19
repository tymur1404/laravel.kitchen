@extends('layouts.admin')

@section('content')

    <div class="right_col" role="main">
        <div>
            <div class="page-title">
                <div class="title_left">
                    <h3>Recipe create/edit</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                        </div>
                        <div class="x_content">
                            @include('kitchen.admin.recipes.includes.result_messages')
                            @include('kitchen.admin.recipes.includes.result_messages_ajax')

                            @if($recipe->exists)
                                <form id="form-recipe-edit" class="form-horizontal form-label-left" novalidate=""
                                      method="POST"
                                      action="{{ route('kitchen.admin.recipes.update', $recipe->id) }}">
                                    @method('PATCH')
                            @else
                                <form method="POST" class="form-horizontal form-label-left"  action="{{ route('kitchen.admin.recipes.store') }}">
                            @endif
                                            @csrf
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="name" class="form-control col-md-7 col-xs-12"
                                                           data-validate-length-range="6"
                                                           data-validate-words="2"
                                                           name="title"
                                                           required="required"
                                                           type="text"
                                                           value="{{ $recipe->title }}">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="textarea"
                                                  required="required"
                                                  name="description"
                                                  rows="15"
                                                  class="form-control col-md-12 col-xs-12">{{ $recipe->description }}</textarea>
                                                </div>
                                            </div>
                                    @if($recipe->exists)
                                            <div class="ln_solid"></div>
                                            <div class="item form-group">
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Quantity</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($recipe->ingredient as $i)
                                                            <tr>
                                                                <td>
                                                                    <select data-token="{{ csrf_token() }}"
                                                                            data-recipe_id="{{ $recipe->id }}"
                                                                            name="ingredient"
                                                                            class="form-control category_id">
                                                                        @foreach($ingredientList as $ingredientOption)
                                                                            <option value="{{ $ingredientOption->id }}"
                                                                                    @if($ingredientOption->id == $i->id) selected @endif>
                                                                                {{ $ingredientOption->id }} :
                                                                                {{ $ingredientOption->title }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    @csrf
                                                                    <input type="hidden" name="ingredient_id"
                                                                           value="{{ $i->id }}">
                                                                    <input type="hidden" name="recipe_id"
                                                                           value="{{ $recipe->id }}">
                                                                    <input data-toggle="tooltip"
                                                                           title="Press 'Enter' after changing"
                                                                           class="ingredient-update" type="text"
                                                                           value="{{ $quantity[$i->id] }}"/>
                                                                </td>
                                                                <td>
                                                                    @csrf
                                                                    <input type="hidden" name="ingredient_id"
                                                                           value="{{ $i->id }}">
                                                                    <input type="hidden" name="recipe_id"
                                                                           value="{{ $recipe->id }}">
                                                                    <button class="btn btn-danger quantity-destroy">
                                                                        <i data-id="{{ $recipe->id }}"
                                                                           class="fa fa-trash-o"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-3">

                                                    <button type="button"
                                                            class="btn btn-success"
                                                            data-toggle="modal"
                                                            data-target="#ingredientModal">
                                                        Add
                                                    </button>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label col-md-6" >Don't you find such an ingredient?
                                                    </label>
                                                    <div class="col-md-6 ">
                                                        <button type="button"
                                                                class="btn btn-info"
                                                                data-toggle="modal"
                                                                data-target="#newIngredientModal">
                                                            Add new ingredient
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                    @else
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <p > To add ingredients, fill in the fields and click "save" </p>
                                            </div>
                                        </div>
                                    @endif
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button  class="btn btn-primary">Save
                                                    </button>
                                                </div>
                                            </div>

                                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newIngredientModal" tabindex="-1" role="dialog" aria-labelledby="newIngredientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newIngredientModalLabel">Add new ingredient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('kitchen.admin.ingredients.store') }}">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" name="title">
                            <div class="clearfix"></div>
                            <label for="recipient-name" class="col-form-label">Quantity:</label>
                            <input type="text" class="form-control" name="quantity">
                            <input type="hidden" class="form-control" name="recipe_id" value="{{ $recipe->id }}">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>

                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ingredientModal" tabindex="-1" role="dialog" aria-labelledby="ingredientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ingredientModalLabel">Add ingredient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('kitchen.admin.recipes.add_relation_recipe_ingredient') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <select  name="ingredient_id"
                                    class="form-control">
                                @foreach($ingredientList as $ingredientOption)
                                    <option value="{{ $ingredientOption->id }}">
                                        {{ $ingredientOption->id }} :
                                        {{ $ingredientOption->title }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="clearfix"></div>
                            <label for="recipient-name" class="col-form-label">Quantity:</label>
                            <input type="text" class="form-control" name="quantity">
                            <input type="hidden" class="form-control" name="recipe_id" value="{{ $recipe->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
