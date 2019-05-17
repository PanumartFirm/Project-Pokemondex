<div>
    @csrf
    @foreach($fav->chunk(4) as $row)
    <div class="row">
        @foreach($row as $col)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-3 shadow">
                <div class="card h-100">
                    @auth @if ($user->name == 'admin')
                    <div class="card-header text-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href=" {{ route('pokemon.edit',$col->fpoke->id) }} " class="btn btn-warning"><i
                                    class="fa fa-pencil"></i></a>
                            <button class="btn btn-danger" onclick="myFavDelete('{{$col->fpoke->id}}')"><i
                                    class="fa fa-trash-o"></i></button>
                        </div>
                    </div> @endif @endauth
                    <a href=" {{ route('pokemon.show',$col->fpoke->id) }} ">
                        <img class="card-img-top" src="/uploads/pokemons/{{ $col->fpoke->poke_pic }}" alt="">
                    </a>
                    <div class="card-body text-center">
                        @if (Fav::myCustomFav($col->fpoke->id) == 1)
                        <a onclick="myFavFunction('{{$col->fpoke->id}}')"><i class=" heart fa fa-heart fa-2x "></i></a>
                        @else
                        <a onclick="myFavFunction('{{$col->fpoke->id}}')"><i
                                class=" heart fa fa-heart-o fa-2x "></i></a>
                        @endif
                        <div class=" card-title h4">{{ $col->fpoke->poke_name }}</div>
                        <div class="d-inline-flex text-black">
                            <span
                                class="badge badge-{{ $col->fpoke->type->type_name }} ">{{ $col->fpoke->type->type_name }}</span>
                            @if ($col->fpoke->stype)
                            <span
                                class="badge badge-{{ $col->fpoke->stype->stype_name }} ">{{ $col->fpoke->stype->stype_name }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
    <br>
</div>
<div class="panel-heading" style="display:flex; justify-content:center;align-items:center;">
    {{$fav->links()}}
</div>
<script>
    console.log('test');
</script>
