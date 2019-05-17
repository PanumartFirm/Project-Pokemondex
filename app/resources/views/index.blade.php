@extends('layouts.app')
@section('active')
<li class="nav-item">
    <a class="nav-link" href="{{ url('/profile') }}">My Profile</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/favorite') }}">My Favorite</a>
</li>
@endsection
@section('content')
<div class="row" id="pages">
    <div class="col-lg-12 text-center">
        <header class="jumbotron my-4">
            <h1 class="intro-lead-in text-uppercase">Welcome to Pokemon world!</h1>
            <p class="intro-lead-in">This website is fucking badass.
            </p>
            {{-- <div class="intro-lead-in">Welcome To Our Studio!</div>
            <div class="intro-heading text-uppercase">It's Nice To Meet You</div> --}}
            @auth @if ($user->name == 'admin')
            <a href="{{ route('pokemon.create') }}" class="btn btn-primary btn-lg">Add New Pokemon!</a> @endif @endauth
        </header>
        <div class="input-group mb-4">
            <input type="text" class="form-control" placeholder="Search Pokemon with name" name="search" id="search">
            <div class="input-group-append">
                <span class="input-group-text bg-primary text-white"><i class="fa fa-search"></i></span>
            </div>
        </div>
        <div id="pokedata">

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

$(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var pagiurl = $(this).attr('href');
    fetch_data(pagiurl);
});

function fetch_data(page)
{
    console.log(page);
    $.ajax({
    url: page,
    }).done(
	    function(data)
	    {
	        $('#pokedata').html(data.html);
	    }
	);
}

});
</script>
@endsection
