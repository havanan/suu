@extends('layouts.admin')

@section('title') Tổng quát @endsection
@section('content')
   <div class="row">
       <div class="container-fluid">
           <h3>Hello: {{auth()->user()->name}}</h3>
       </div>
   </div>
@endsection