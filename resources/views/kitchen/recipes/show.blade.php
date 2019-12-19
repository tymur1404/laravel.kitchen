@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\KitchenIngredient $ingrdients */
        /** @var \App\Models\KitchenRecipe $recipe */
    @endphp

    <div class="container">
            <h2>{{ $recipe->title }}</h2>
            <p>{{ $recipe->description }}</p>
            <h3>
                Ingredients
            </h3>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($recipe->ingredient as $i)
            <tr>
                <td>{{ $i->title }}</td>
                <td>{{ $quantity[$i->id] }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
