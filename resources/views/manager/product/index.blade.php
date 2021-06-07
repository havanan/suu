@extends('layouts.admin')

@section('title') Danh sách sản phẩm @endsection
@section('content')
    <div class="row">
        <div class="container-fluid">
            <h3>Danh sách sản phẩm</h3>
            <product-list></product-list>
        </div>
    </div>
@endsection