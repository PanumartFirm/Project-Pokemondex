<div>
    @csrf
    @foreach($poke->chunk(4) as $row)
    <div class="row">
        @foreach($row as $col)
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-2 shadow mt-4">
                <div class="card h-100 ">
                    @auth @if ($user->name == 'admin')
                    <div class="card-header text-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href=" {{ route('pokemon.edit',$col->id) }} " class="btn btn-warning"><i
                                    class="fa fa-pencil"></i></a>
                            <button class="btn btn-danger" onclick="myPokeDelete('{{$col->id}}')"><i
                                    class="fa fa-trash-o"></i></button>
                        </div>
                    </div> @endif @endauth
                    <a href=" {{ route('pokemon.show',$col->id)}} ">
                        <img class="card-img-top" src="/uploads/pokemons/{{ $col->poke_pic }}">
                    </a>
                    <div class="card-body text-center">
                        @if (!Auth::guest())
                        @if (Fav::myCustomFav($col->id) == 1)
                        <a onclick="myFunction('{{$col->id}}')"><i class="heart fa fa-heart fa-2x"
                                id="fav-icon"></i></a>
                        @else
                        <a onclick="myFunction('{{$col->id}}')"><i class="heart fa fa-heart-o fa-2x"
                                id="fav-icon"></i></a>
                        @endif
                        @else
                        <a href=" {{ route('login') }} "><i class=" heart fa fa-heart-o fa-2x "></i></a>
                        @endif
                        <div class=" card-title h4">{{ $col->poke_name }}</div>
                        <div class="d-inline-flex text-black">
                            <span class="badge badge-{{ $col->type->type_name }} ">{{ $col->type->type_name }}</span>
                            @if ($col->stype)
                            <span
                                class="badge badge-{{ $col->stype->stype_name }} ">{{ $col->stype->stype_name }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
<br>
<div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">
    {{$poke->links()}}
</div>
