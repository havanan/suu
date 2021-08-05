@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb-title pe-3">Loại sản phẩm</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0" style="background-color: transparent">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Danh sách</li>
            </ol>
        </nav>
    </div>
@endsection
@section('title') Danh sách loại sản phẩm @endsection
@section('content')
    <div class="row">
        <div class="container-fluid">
            <category-list></category-list>
        </div>
    </div>
@endsection