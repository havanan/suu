@extends('layouts.admin_auth')

@section('content')
    <div class="row justify-content-center h-100 align-items-center" style="margin-top: 20%">
        <div class="col-md-6">
            <div class="authincation-content">
                <div class="row no-gutters">
                    <div class="col-xl-12">
                        <form class="auth-form" method="post" action="{{route('manager.login')}}">
                            {{csrf_field()}}
                            <div class="text-center mb-3">
                                <h2 class="text-white"><strong>Suukids</strong></h2>
                            </div>
                            <h4 class="text-center mb-4 text-white">Đăng nhập tài khoản</h4>
                            <div>
                                <div class="form-group">
                                    <label class="mb-1 text-white"><strong>Email</strong></label>
                                    <input type="email" class="form-control" placeholder="Vui lòng nhập email..." name="email">
                                    @error('email')
                                        <span class="text-white">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 text-white"><strong>Mật khẩu</strong></label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password')
                                        <span class="text-white">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-white text-primary btn-block">Đăng nhập</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection