@extends('seller.layouts.master')

@section('content')
<div class="text-right">
  <a href="{{route('seller.product.create')}}" class="btn btn-primary">+ Add Product</a>
</div>
<h2>Product Lists</h2>

<table class="table table-striped table-bordered">
  <tr>
    <th>Sr No.</th>
    <th>Product Name</th>
    <th>Product Shape</th>
    <th>Product Price</th>
    <!-- <th>Product Status</th> -->
    <th>Product Image</th>
    <th>Action</th>
  </tr>
  @foreach($items as $item)
  <tr>
    <td>{{$item->id}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->shape}}</td>
    <td>{{$item->price}} ₹</td>
    <td>
      <img src="{{ asset('assets/images/items/'.$item->image) }}" style="height: 100px;width:100px;">
    </td>
    <td>
      <a href="{{route('seller.product.edit',$item->id)}}" class="btn btn-primary">Edit</a>
      <form action="{{route('seller.product.destroy',$item->id)}}" method="POST">
       @csrf  
       @method('DELETE')
       <button type="submit" class="btn btn-danger">Delete</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>
@endsection