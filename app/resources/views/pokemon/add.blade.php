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
        <h1 class="mt-5">เพิ่มข้อมูล Pokemon</h1>
        <form method="POST" action="{{ route('pokemon.store')}}" enctype="multipart/form-data">
            @csrf
            <form>
                <div class="form-group{{ $errors->has('poke_name') ? ' has-error' : '' }}">
                    <label>Pokemon Name</label>
                    <input class="form-control" name="poke_name" id="poke_name" placeholder="Name">
                    <small class="text-danger">{{ $errors->first('poke_name') }}</small>
                </div>
                <div class="form-group{{ $errors->has('poke_content') ? ' has-error' : '' }}">
                    <label>Pokemon Detail</label>
                    <textarea class="form-control" name="poke_content" id="poke_content" rows="3 "></textarea>
                    <small class="text-danger">{{ $errors->first('poke_content') }}</small>
                </div>
                <div class="form-group{{ $errors->has('poke_pic') ? ' has-error' : '' }}">
                    <label>Pokemon Picture</label>
                    <table>
                        <tr>
                            <td>
                                <img src="" id="img" class="rounded"
                                    style="width:150px; height:150px; background-color:  #d9d9da ">
                            </td>
                        </tr>
                        <tr>

                            <td>
                                <br>
                                <input type="file" name="poke_pic" id="poke_pic">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small class="text-danger">{{ $errors->first('poke_pic') }}</small>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-group{{ $errors->has('spe_id') ? ' has-error' : '' }}">
                    <label>Species</label>
                    <select class="form-control" name="spe_id" id="spe_id">
                        <option value="">Please Select</option>
                        @foreach($spe as $row)
                        <option value="{{ $row->id }}">{{ $row->spe_name }}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('spe_id') }}</small>
                </div>
                <div class="form-group row checkeq">
                    <div class="col-md-6 {{ $errors->has('type_id') ? ' has-error' : '' }}">
                        <label>Type</label>
                        <select class="form-control" name="type_id" id="type_id">
                            <option value="">Please Select</option>
                            @foreach($type as $row)
                            <option value="{{ $row->id }}">{{ $row->type_name }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('type_id') }}</small>
                    </div>
                    <div class="col-md-6{{ $errors->has('stype_id') ? ' has-error' : '' }}">
                        <label>Sub Type</label>
                        <select class="form-control" name="stype_id" id="stype_id">
                            <option value="">Select one if thay have</option>
                            @foreach($stype as $row)
                            <option value="{{ $row->id }}">{{ $row->stype_name }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('stype_id') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6{{ $errors->has('abi_id') ? ' has-error' : '' }}">
                        <label>Abilities</label>
                        <select class="form-control" name="abi_id" id="abi_id">
                            <option value="">Please Select</option>
                            @foreach($abi as $row)
                            <option value="{{ $row->id }}">{{ $row->abi_name }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('abi_id') }}</small>
                    </div>
                    <div class="col-md-6{{ $errors->has('hid_id') ? ' has-error' : '' }}">
                        <label>Hidden Abilities</label>
                        <select class="form-control" name="hid_id" id="hid_id">
                            <option value="">Please Select</option>
                            @foreach($hid as $row)
                            <option value="{{ $row->id }}">{{ $row->hid_name }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('hid_id') }}</small>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label>Gender Type</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="">Please Select</option>
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
                            <label>Height (m) </label>
                            <input class="form-control" name="height" id="height" placeholder="15.00">
                            <small class="text-danger">{{ $errors->first('height') }}</small>
                        </div>
                    </div>
                    <div class="col-md-6{{ $errors->has('weight') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Weight (kg)</label>
                            <input class="form-control" name="weight" id="weight" placeholder="2.03">
                            <small class="text-danger">{{ $errors->first('weight') }}</small>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mb-5" id="btnSubmit">Submit</button>
            </form>
        </form>
    </div>
</div>
@endsection
