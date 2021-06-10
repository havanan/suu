@extends('layouts.admin_auth')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="border p-4 rounded">
                <div class="text-center">
                    <h3 class="">Đăng Nhập</h3>
                </div>
                <div class="form-body">
                        @if($errors->any())
                            <p class="text-danger"><strong>{{$errors->first()}}</strong></p>
                        @endif
                        <form class="row g-3" method="post" action="{{route('manager.login')}}">
                            {{csrf_field()}}
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                            @error('email')
                            <p class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" name="password">
                            </div>
                            @error('password')
                            <p class="text-danger">
                                <strong>{{ $message }}</strong>
                            </p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Đăng nhập</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection