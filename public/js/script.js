$(document).ready(function () {

    $('input.ingredient-update').keyup(function (e) {
        let keyCode = e.keyCode || e.which;
        if(keyCode === 13) {
            let _token = $(this).siblings('input[name="_token"]').val();
            let ingredient_id = $(this).siblings('input[name="ingredient_id"]').val();
            let recipe_id = $(this).siblings('input[name="recipe_id"]').val();
            let quantity = $(this).val();
            let url = removeParametrs();
             url += "/update_quantity_ingredient_ajax";

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });
            $.ajax({
                url: url,
                method: 'PATCH',
                data: {
                    ingredient_id: ingredient_id,
                    recipe_id: recipe_id,
                    quantity: quantity,
                },
                success: function (result) {
                    console.log(result);
                    showMessage('Quantity has been changed',true);
                },
                error: function (result) {
                    console.log(result);
                    showMessage('Update Error',false);

                }
            });
        }

    });

    $('button.quantity-destroy').click(function (e) {
        console.log('quantity-destroy');
        let _token = $(this).siblings('input[name="_token"]').val();
        let ingredient_id = $(this).siblings('input[name="ingredient_id"]').val();
        let recipe_id = $(this).siblings('input[name="recipe_id"]').val();
        let url = removeParametrs();
        let this_tr = $(this).closest('tr');
        url += "/delete_recipe_ingredient_ajax" ;
        e.preventDefault();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        $.ajax({
            url: url,
            method: 'DELETE',
            data: {
                ingredient_id: ingredient_id,
                recipe_id: recipe_id,
            },
            success: function (result) {
                console.log(result);
                this_tr.hide();
                showMessage('Delete success',true);
            },
            error: function (result) {
                console.log(result);
                showMessage('Delete success',false);
            },
        });
    });


    let prev_ingredient_id; // previous option of select

    $('select.category_id').on('focus', function () {
        prev_ingredient_id = this.value;

    }).change(function () {
        let recipe_id = $(this).data('recipe_id');
        let ingredient_id = $(this).val();
        let _token = $(this).data('token');
        let url = removeParametrs();
        url += "/update_recipe_ingredient_ajax" ;
        console.log(_token);
        console.log(ingredient_id);
        console.log(prev_ingredient_id);
        console.log(recipe_id);
        console.log(url);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        $.ajax({
            url: url,
            method: 'PATCH',
            data: {
                ingredient_id: ingredient_id,
                prev_ingredient_id: prev_ingredient_id,
                recipe_id: recipe_id,
            },
            success: function (result) {
                console.log(result);
                showMessage('Delete success',true);
            },
            error: function (result) {
                console.log(result);
                showMessage('Delete success',false);
            },
        });
    });


    $('#form-recipe-edit').on('keyup keypress', function(e) {
        let keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    function removeParametrs(){
        let url = window.location.href;
        let arrUrl = url.split('/');
        arrUrl.length = 6;
        url = arrUrl.join('/');
        return url;
    }
    //type - bool: true(success)/false(error)
    function showMessage(txt, type){
        if(type) {
            $('#error-message-text').text('');
            $('#success-message-text').text(txt);
            $('#success-message').removeClass('d-none');
            $('#error-message').addClass('d-none');
        }else{
            $('#error-message-text').text(txt);
            $('#success-message-text').text('');
            $('#error-message').removeClass('d-none');
            $('#error-message').addClass('d-none');
        }
    }
});
