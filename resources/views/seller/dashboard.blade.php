@extends('seller.layouts.master')

@section('content')
<strong>Hey! {{Auth()->user()->name}}</strong>, Welcome to your Dashboard.
@endsection