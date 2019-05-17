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
<div class="card mt-4 border">
    <div class="card-body">
        <h1 class="mt-4 text-center">My Detail</h1>
        <hr class="mt-4 mb-5 style-one">
        <div style="height: auto">


            <div class="row">
                <div class="col-3">
                <div id="mdb-lightbox-ui"></div>
                    <div class="card border-3 shadow">
                        <div class="card h-100">
                            <div class="mdb-lightbox">
                                @auth @if ($user->name == 'admin')
                                <div class="card-header text-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href=" {{ route('pokemon.edit',$value->id) }} " class="btn btn-warning"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <form class="delete" action="{{ route('pokemon.destroy',$value->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="archiveFunction()"><i
                                                    class="fa fa-trash-o"></i> Delete</button>
                                        </form>
                                    </div>
                                </div> @endif @endauth
                                <div class="mdb-lightbox">
                                <a href="/uploads/pokemons/{{  $value->poke_pic  }}" data-size="1980x1067">
                                <img class="card-img-top img-fluid"  src="/uploads/pokemons/{{  $value->poke_pic  }}" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <div class="d-inline-flex text-black">
                                        @if (!Auth::guest())
                                        @if (Fav::myCustomFav($value->id) == 1)
                                        <a onclick="myFunction('{{$value->id}}')"><i
                                                class=" heart fa fa-heart fa-2x "></i></a>
                                        @else
                                        <a onclick="myFunction('{{$value->id}}')"><i
                                                class=" heart fa fa-heart-o fa-2x "></i></a>
                                        @endif
                                        @else
                                        <a href=" {{ route('login') }} "><i class=" heart fa fa-heart-o fa-2x "></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <table class="w3-table w3-striped w3-bordered w3-border mb-5">
                        <h2 id="content">Content</h2>
                        <p id="content">
                            {{ $value->poke_content }}
                        </p>
                        <tr>
                            <th>Name</th>
                            <td>{{ $value->poke_name }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <div class="d-inline-flex text-black">
                                <th>Type</th>
                                <td><span
                                        class="badge badge-{{ $value->type->type_name }} ">{{ $value->type->type_name }}</span>
                                @if ($value->stype)
                                    <span
                                        class="badge badge-{{ $value->stype->stype_name }} ">{{ $value->stype->stype_name }}</span>
                                </td>
                                @endif
                                <th>Species</th>
                                <td>{{ $value->spe->spe_name }}</td>
                            </div>
                        </tr>
                        <tr>
                            <th>Ability</th>
                            <td>{{ $value->abi->abi_name }} <br> {{ $value->abi->abi_effect }}</td>
                            <!-- <td>{{ $value->abi->abi_effect }}</td> -->
                            <th>Hiden Ability</th>
                            <td>{{ $value->hid->hid_name }} <br>{{ $value->hid->hid_effect}}</td>
                        </tr>
                       
                        <tr>
                            <th>Gender</th>
                            <td>{{ $value->gender }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Height</th>
                            <td>{{ $value->height }} m</td>
                            <th>Weight</th>
                            <td>{{ $value->weight }} kg</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
