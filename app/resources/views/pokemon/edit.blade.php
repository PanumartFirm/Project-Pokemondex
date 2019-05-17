@extends('layouts.app')
@section('active')
<li class="nav-item">
    <a class="nav-link" href="{{ url('/profile') }}">My Profile</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/favorite') }}">My Favorite</a>
</li>
@endsection
@section('status')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@elseif ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 mb-4 bg-light">
        <h1 class="mt-5">หน้าแก้ไขข้อมูล Pokemon</h1>
        <form method="POST" action="{{ route('pokemon.update',$value->id)}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <form>
                <div class="form-group{{ $errors->has('poke_name') ? ' has-error' : '' }}">
                    <label>Pokemon Name</label>
                    <input class="form-control" name="poke_name" id="poke_name" placeholder="Name"
                        value="{{ $value->poke_name }}">
                    <small class="text-danger">{{ $errors->first('poke_name') }}</small>
                </div>

                <div class="form-group{{ $errors->has('poke_content') ? ' has-error' : '' }}">
                    <label>Pokemon Detail</label>
                    <textarea class="form-control" name="poke_content" id="poke_content"
                        rows="3 ">{{ $value->poke_content }}</textarea>
                    <small class="text-danger">{{ $errors->first('poke_content') }}</small>
                </div>

                <div class="form-group">
                    <label>Pokemon Picture</label>
                    <table>
                        <tr>
                            <td>
                                <img src="/uploads/pokemons/{{ $value->poke_pic }}" id="img" name="img" class="rounded"
                                    style="width:150px; height:150px; background-color:  #d9d9da ">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="file" name="poke_pic" id="poke_pic">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="form-group{{ $errors->has('spe_id') ? ' has-error' : '' }}">
                    <label>Species</label>
                    <select class="form-control" name="spe_id" id="spe_id">
                        <option value="{{ $value->spe->id }}">{{ $value->spe->spe_name }}</option>
                        @foreach($spe as $row)
                        @if ($value->spe->id != $row->id)
                        <option value="{{ $row->id }}">{{ $row->spe_name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('spe_id') }}</small>
                </div>

                <div class="form-group row">

                    <div class="col-md-6{{ $errors->has('type_id') ? ' has-error' : '' }}">
                        <label>Type</label>
                        <select class="form-control" name="type_id" id="type_id">
                            <option value="{{ $value->type->id }}">{{ $value->type->type_name }}</option>
                            @foreach($type as $row)
                            @if ($value->type->id != $row->id)
                            <option value="{{ $row->id }}">{{ $row->type_name }}</option>
                            @endif
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('type_id') }}</small>
                    </div>

                    <div class="col-md-6{{ $errors->has('stype_id') ? ' has-error' : '' }}">
                        <label>Sub Type</label>
                        <select class="form-control" name="stype_id" id="stype_id">
                            @if ($value->stype)
                            <option value="{{ $value->stype->id }}">{{ $value->stype->stype_name }}</option>
                            @else
                            <option value="">Select one if thay have</option>
                            @endif
                            @foreach($stype as $row)
                            @if ($value->stype != '' && $row->id != $value->stype->id)
                            <option value="{{ $row->id }}">{{ $row->stype_name }}</option>
                            @endif
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('stype_id') }}</small>
                    </div>

                </div>

                <div class="form-group row{{ $errors->has('abi_id') ? ' has-error' : '' }}">

                    <div class="col-md-6">
                        <label>Abilities</label>
                        <select class="form-control" name="abi_id" id="abi_id">
                            <option value="{{ $value->abi->id }}">{{ $value->abi->abi_name }}</option>
                            @foreach($abi as $row)
                            @if ($value->abi->id != $row->id)
                            <option value="{{ $row->id }}">{{ $row->abi_name }}</option>
                            @endif
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('abi_id') }}</small>
                    </div>

                    <div class="col-md-6{{ $errors->has('hid_id') ? ' has-error' : '' }}">
                        <label>Hidden Abilities</label>
                        <select class="form-control" name="hid_id" id="hid_id">
                            <option value="{{ $value->hid->id }}">{{ $value->hid->hid_name }}</option>
                            @foreach($hid as $row)
                            @if ($value->hid->id != $row->id)
                            <option value="{{ $row->id }}">{{ $row->hid_name }}</option>
                            @endif
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('hid_id') }}</small>
                    </div>

                </div>

                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label>Gender Type</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="{{ $value->gender }}">{{ $value->gender }}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Both">Both</option>
                        <option value="None">None</option>
                    </select>
                    <small class="text-danger">{{ $errors->first('gender') }}</small>
                </div>

                <div class="form-group row">

                    <div class="col-md-6{{ $errors->has('height') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Height (m)</label>
                            <input class="form-control" name="height" id="height" placeholder="15.00"
                                value="{{ $value->height }}">
                            <small class="text-danger">{{ $errors->first('height') }}</small>
                        </div>
                    </div>

                    <div class="col-md-6{{ $errors->has('weight') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Weight (kg)</label>
                            <input class="form-control" name="weight" id="weight" placeholder="2.03"
                                value="{{ $value->weight }}">
                            <small class="text-danger">{{ $errors->first('weight') }}</small>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success mb-5 " id="btnSubmit">Submit</button>
            </form>
        </form>
    </div>
</div>
@endsection
