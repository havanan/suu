@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb-title pe-3">Dashboard</div>
@endsection
@section('title') Dashboard @endsection
@section('content')
   <div class="row">
       <div class="container-fluid">
           <h3>Hello: {{auth()->user()->name}}</h3>
           <table-component></table-component>
       </div>
   </div>
@endsection