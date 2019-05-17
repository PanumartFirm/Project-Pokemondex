@extends('layouts.app')
@section('active')
<li class="nav-item">
    <a class="nav-link active" href="{{ url('/profile') }}">My Profile</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/favorite') }}">My Favorite</a>
</li>
@endsection
@section('content')
<div class="container" id="prodata">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card card-signin flex-row my-5 card border-3 shadow">
                <div class="card-img-left d-none d-md-flex">
                    <!-- Background image for card set in CSS! -->
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center " style=" font-weight:bold ; font-size: 22px;">{{ $user->name }}'s
                        Profile</h5>
                    <img src="/uploads/avatars/{{ $user->avatar }}" class="rounded mx-auto d-block rounded-circle"
                        width=200px height=200px>
                    <form enctype="multipart/form-data" id="profile" action="" method="POST">
                        <div class="form-group text-center"><br>
                            <input id="file_pro" type="file" name="profile" style="display: none">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button id="profile_up" type="button" class="btn btn-primary">Change Profile</button>
                        </div>
                    </form>
                    <hr>
                    <div class="form-label-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-12 control-label bg-white"
                            style="color:#4285F4; font-weight:bold ; font-size: 22px;"> Email :
                            {{ $user->email }}</label>
                    </div>
                    <hr class="mt-4 mb-4">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ url('changePassword') }}" autocomplete="off">
                        @csrf
                        <div class="form-label-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-12 control-label"
                                style="font-weight:900 ; front-size:25px">Current Password</label>
                            <div class="col-md-12">
                                <input id="current-password" type="password" class="form-control"
                                    name="current-password" required>
                                @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-label-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-12 control-label" style="font-weight:bold ; ">New
                                Password</label>
                            <div class="col-md-12">
                                <input id="new-password" type="password" class="form-control" name="new-password"
                                    required>
                                @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-label-group">
                            <label for="new-password-confirm" class="col-md-12 control-label"
                                style="font-weight:bold ;">Confirm New
                                Password</label>
                            <div class="col-md-12">
                                <input id="new-password-confirm" type="password" class="form-control"
                                    name="new-password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-label-group">
                            <div class="col-md-12 col-md-offset-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Change Password
                                </button>
                                <small>Latest update: {{ $user->updated_at }}</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    console.log('tasd');
</script>
@endsection
