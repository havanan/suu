<?php
$title = $id ? 'Sửa' : 'Tạo';
$title.=' sản phẩm'
?>
@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb-title pe-3">Sản phẩm</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0" style="background-color: transparent">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('title') {{$title}}  @endsection
@section('content')
    <from-product id="{{$id}}"></from-product>
@endsection