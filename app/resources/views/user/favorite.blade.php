@extends('layouts.app')
@section('active')
<li class="nav-item">
    <a class="nav-link" href="{{ url('/profile') }}">My Profile</a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="{{ url('/favorite') }}">My Favorite</a>
</li>
@endsection
@section('content')
<div class="row" id="pages">
    <div class="col-lg-12 text-center">
        <div class="card mt-4 border mb-3" style="background:rgba(233, 30, 99, 0.7)">
            <div class="card-body border-3 shadow">
                <div class="pb-2 mb-2 border-bottom ">
                    <h1 class="display-3  p-2 mb-2 " style="color:white;">
                        <strong>My Favorites Pokemon</strong>
                        <hr>
                    </h1>
                    <hr class="border-0">
                    <div id="favdata">
                    </div>
                </div>
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
	        $('#favdata').html(data.html);
	    }
	);
}

});
    </script>
    @endsection
