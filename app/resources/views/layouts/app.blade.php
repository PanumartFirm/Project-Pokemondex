<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pokemon') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        .heart {
            color: red;
        }

        .badge-Grass {
            background-color: #007E33 !important;
            color: white;
        }

        .badge-Fire {
            background-color: #CC0000 !important;
            color: white;
        }

        .badge-Water {
            background-color: #0099CC !important;
            color: white;
        }

        .badge-Ground {
            background-color: #8d6e63 !important;
            color: white;
        }

        .badge-Electric {
            background-color: #FF8800 !important;
            color: white;
        }

        .badge-Normal {
            background-color: #9e9e9e !important;
            color: white;
        }

        .badge-Poison {
            background-color: #673ab7 !important;
            color: white;
        }

        .badge-Flying {
            background-color: #82b1ff !important;
            color: white;
        }

        .badge-Bug {
            background-color: #009688 !important;
            color: white;
        }

        .card-signin {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-signin .card-title {
            margin-bottom: 2rem;
            font-weight: 300;
            font-size: 1.5rem;
        }

        .card-signin .card-img-left {
            width: 45%;
            /* Link to your background image using in the property below! */
            background: scroll center url('{{ asset('uploads/PROFILEPIKA.jpg') }}');
            /* background: scroll center url('/uploads/avatars/03.jpg'); */
            background-size: cover;
        }

        .card-signin .card-body {
            padding: 2rem;
            /* background-image: url('{{ asset('uploads/3.jpg') }}');
            background-size: cover; */

        }

        .form-signin {
            width: 100%;
        }

        .form-signin .btn {
            font-size: 80%;
            border-radius: 5rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            transition: all 0.2s;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .jumbotron {
            background-image: url('{{ asset('uploads/PIKACHU.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .intro-lead-in {
            color: #fff;
            font-size: 22px;
            font-style: italic;
            line-height: 22px;
            margin-bottom: 25px;
            font-family: 'Droid Serif', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'
        }

        .type_2 {
            border: 0;
            height: 55px;
            background-image: url('{{ asset('images/type_2.png') }}');
            background-repeat: no-repeat;
        }
    </style>
</head>

<body background="https://i.pinimg.com/originals/37/fa/ac/37faac0dddf1669ec7bf488b46f8e453.jpg">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light static-top mb-5 shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ url('pokemon') }}">
                    {{ config('app.name', 'Pokemon') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif @else
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                v-pre style="position:relative; padding-left:50px;">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}"
                                    style="width:36px; height:36px; position:absolute; top:3px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        @yield('active')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="mt-3">@yield('status')</div>
        @yield('content')
    </div>
    <script>
        $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");

        //เพิ่ม script ตรงนี้นะครับ
    $('#pokedata').html('');
    $('#favdata').html('');
    $.ajax( //ดึงข้อมูลเป็น json ใส่หน้า index
	{
	    url: "{{url('pokemon/index')}}",
	    type: 'GET',
	}).done(
	    function(data)
	    {
	        $('#pokedata').html(data.html);
	    }
	);
    $.ajax( //ดึงข้อมูลเป็น json ใส่หน้า favorite
	{
	    url: "{{url('favorite/index')}}",
	    type: 'GET',
	}).done(
	    function(data)
	    {
	        $('#favdata').html(data.html);
	    }
    );
    function archiveFunction() { //ปุ่มลบสำหรับหน้า detail
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        swal({
            title: "Are you sure!",
            icon: "warning",
            dangerMode: true,
            buttons: [true,'Yes!'],
        }).then((result) => {
            if (result) {
                form.submit();
            }else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        })
    };
    function myPokeDelete($del) { //ปุ่มลบข้อมูลหน้า index
        swal({
            title: "Are you sure!",
            icon: "warning",
            dangerMode: true,
            buttons: [true,'Yes!'],
        }).then((result) => {
		    if (result){
			    $.ajax({
                    url: "{{url('pokemon/delete')}}",
                    method: 'get',
                    data: {id:$del},
                }).done(function(data){
                    $('#pokedata').html(data.html);
                });
		    }else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
	    })
    };
    function myFavDelete($del) { //ปุ่มลบข้อมูลหน้า favorite
        swal({
            title: "Are you sure!",
            icon: "warning",
            dangerMode: true,
            buttons: [true,'Yes!'],
        }).then((result) => {
		    if (result){
			    $.ajax({
                    url: "{{url('favorite/delete')}}",
                    method: 'get',
                    data: {id:$del},
                }).done(function(data){
                    $('#favdata').html(data.html);
                });
		    }else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
	    })
    };
    $("#search").autocomplete({ //autocomplete นั่นแหละ
        source: function (request, response) {
            $.ajax({
                url: "{{url('autocomplete')}}",
                data: {
                    term : request.term
                },
                dataType: "json",
                success: function(data){
                   var resp = $.map(data,function(obj){
                        return obj.poke_name;
                   });
                   response(resp);
                }
            });
        },
        minLength: 1
    });
    $('#search').on('keyup',function () { //live search พิมพ์แล้วค้นเลย แสดงเลย
        $val = $(this).val();
        $.ajax({
            url: "{{url('search')}}",
            method: 'get',
            data: {search:$val},
        }).done(
            function(data)
            {
                $('#pokedata').html(data.html);
            }
        );
    })
    $(".heart").click(function() {
        $(this).toggleClass("fa-heart fa-heart-o");
    });
    $("#pokedata").on("click", ".heart", function() {
        $(this).toggleClass("fa-heart fa-heart-o");
    });
    function myFunction($var) { //กดแล้วหากยังไม่เพิ่มใน fav จะทำการเพิ่มให้ หากมีแล้วจะลบทิ้ง
        $.ajax({
            url: "{{url('like')}}",
            method: 'get',
            data: {id:$var},
        });
    };
    function myFavFunction($var) { //กดแล้วหากยังไม่เพิ่มใน fav จะทำการเพิ่มให้ หากมีแล้วจะลบทิ้ง
        $.ajax({
            url: "{{url('like')}}",
            method: 'get',
            data: {id:$var},
        }).done(
	    function(data)
	    {
	        $.ajax({ //ดึงข้อมูลเป็น json ใส่หน้า fav
	            url: "{{url('favorite/index')}}",
	            type: 'GET',
	        }).done(
	        function(data)
	        {
	            $('#favdata').html(data.html);
	        }
	        );
	    }
	    );
    };
    $(".checkeq").on('change',"#type_id",function(e){ //เช็คไม่ให้ข้อมูลใน selete เลือกซ้ำกันได้
        console.log($(this).val());
    	$("#stype_id option[value!='"+$(this).val()+"']").show();
        $("#stype_id option[value='"+$(this).val()+"']").hide();
        $('#type_id option:selected',this).show();
	});
    $(".checkeq").on('change',"#stype_id",function(e){ //เช็คไม่ให้ข้อมูลใน selete เลือกซ้ำกันได้
        console.log($(this).val());
    	$("#type_id option[value!='"+$(this).val()+"']").show();
        $("#type_id option[value='"+$(this).val()+"']").hide();
        $('#stype_id option:selected',this).show();
	});
    $('#poke_pic').on('change',function(e){ //นำรูปที่เลือกมาแสดงตัวอย่างให้ดู
        var fileInput = this;
        if (fileInput.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#img').attr('src',e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    });
    $("#prodata").on("click", "#profile_up", function() {
        $('#file_pro').click();
    });
    $("#prodata").on("change", "#file_pro", function() {
        $.ajax({
            url: "{{url('profile/update')}}",
            type: 'POST',
            data: new FormData($('#profile')[0]),
            processData: false,
            contentType: false,
        }).done(function(data) {
            location.reload();
        });
    });
    </script>
</body>

</html>
