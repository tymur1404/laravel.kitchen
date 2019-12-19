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
                        @include('kitchen.admin.ingredients.includes.result_messages')

                        @if($ingredient->exists)
                            <form id="form-ingredient-edit" class="form-horizontal form-label-left" novalidate=""
                                  method="POST"
                                  action="{{ route('kitchen.admin.ingredients.update', $ingredient->id) }}">
                        @method('PATCH')
                        @else
                            <form method="POST" class="form-horizontal form-label-left"  action="{{ route('kitchen.admin.ingredients.store') }}">
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
                                           value="{{ $ingredient->title }}">
                                </div>

                            </div>
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

@endsection
