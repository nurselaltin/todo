<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            body {
                background-color: #8f4df8
            }

            .button {
                background-color: white;
                color: black;
                border: 2px solid #4CAF50;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin-left:20px;
            }

            .a-button-link{
                margin: 0 0 0 140px;
            }
            .main-todo-input {
                background: #fff;
                padding: 0 120px 0 0;
                border-radius: 1px;
                margin-top: 200px;
                box-shadow: 0px 0px 0px 6px rgba(255, 255, 255, 0.3)
            }

            .fl-wrap {
                float: left;
                width: 100%;
                position: relative
            }

            .main-todo-input:before {
                content: '';
                position: absolute;
                bottom: -40px;
                width: 50px;
                height: 1px;
                background: rgba(255, 255, 255, 0.41);
                left: 50%;
                margin-left: -25px
            }

            .main-todo-input-item {
                float: left;
                width: 100%;
                box-sizing: border-box;
                border-right: 1px solid #eee;
                height: 50px;
                position: relative
            }

            .main-todo-input-item input:first-child {
                border-radius: 100%
            }

            .main-todo-input-item input {
                float: left;
                border: none;
                width: 100%;
                height: 50px;
                padding-left: 20px
            }

            .main-search-button {
                background: #4DB7FE
            }

            .main-search-button {
                position: absolute;
                right: 0px;
                height: 50px;
                width: 120px;
                color: #fff;
                top: 0;
                border: none;
                border-top-right-radius: 0px;
                border-bottom-right-radius: 0px;
                cursor: pointer
            }

            .main-todo-input-wrap {
                max-width: 500px;
                margin: 20px auto;
                position: relative
            }

            :focus {
                outline: 0
            }

            @media only screen and (max-width: 768px) {
                .main-todo-input {
                    background: rgba(255, 255, 255, 0.2);
                    padding: 14px 20px 10px;
                    border-radius: 10px;
                    box-shadow: 0px 0px 0px 10px rgba(255, 255, 255, 0.0)
                }

                .main-todo-input-item {
                    width: 100%;
                    border: 1px solid #eee;
                    height: 50px;
                    border: none;
                    margin-bottom: 10px
                }

                .main-todo-input-item input {
                    border-radius: 6px !important;
                    background: #fff
                }

                .main-search-button {
                    position: relative;
                    float: left;
                    width: 100%;
                    border-radius: 6px
                }
            }

            .remove {
                float: right;
                color: #757575 !important;
                font-size: 14px
            }

            #list-items {
                padding-left: 20px;
                padding-top: 15px
            }

            ul {
                padding: 0;
                text-align: left;
                list-style: none
            }

            .todo-text {
                color: #757575;
                margin-left: 10px
            }

            .strike {
                color: blue
            }

            .todo-listing {
                padding: 0px 29px 0 0;
                margin-top: 54px !important
            }
        </style>
    </head>
    <body>

    <div class="row">
        <div class="col-md-12">
            <div class="main-todo-input-wrap">
                <div class="a-button-link">
                    <a href="{{route('shoplists')}}" class="button" >Anasayfa</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-todo-input-wrap">
                <div class="main-todo-input fl-wrap">
                    <div class="main-todo-input-item"> <input type="text" name="title" id="todo-list-item" placeholder="'{{session()->get('list_title')}}' adlı listene ürün ekle"> </div> <button   class="add-items main-search-button">EKLE</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-todo-input-wrap">
                <div class="main-todo-input fl-wrap todo-listing">
                    @if($products != null)
                        <ul>
                           @foreach($products as $product)
                                <li style="padding-left: 20px;">
                                    <input type="hidden" id="remove-id" remove-id={{$product->id}} >
                                    <input class='checkbox' type='checkbox' />
                                    <a href="{{route('add.product.page',$product->id)}}"><span class='todo-text'>{{$product->title}}</span></a>
                                    <a class='remove text-right'>
                                        <i class='fa fa-trash'></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                        <ul id="list-items"></ul>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {



            $('.add-items').click(function(event)
            {

                event.preventDefault();

                var item = $('#todo-list-item').val();

                if(item)
                {
                    $('#list-items').append("<li><input class='checkbox' type='checkbox' /><a href=''> <span class='todo-text'>" + item + "</span></a><a class='remove text-right'><i class='fa fa-trash'></i></a> </li>");
                    $.ajax({
                        type:'GET',
                        url:'{{route('add.product')}}',
                        data:{product_title:item},
                        success:function (data) {
                            console.log(data)
                        },
                        error: (error) => {
                            console.log(JSON.stringify(error));
                        }
                    });
                    $('#todo-list-item').val("");
                }

            });



            $(document).on('change', '.checkbox', function()
            {
                if($(this).attr('checked'))
                {
                    $(this).removeAttr('checked');




                }
                else
                {
                    $(this).attr('checked', 'checked');




                }

                $(this).parent().toggleClass('completed');

                localStorage.setItem('listItems', $('#list-items').html());
            });

            $(document).on('click', '.remove', function()
            {


                id = $('#remove-id')[0].getAttribute('remove-id');
                $.get('{{route('remove.product')}}',{remove_id:id},function (data) {
                });
                $(this).parent().remove();

            });

        });

    </script>
</html>
