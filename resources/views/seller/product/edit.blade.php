@extends('seller.layouts.master')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="{{route('seller.product.update', $data['id'])}}" method="POST" id="productupdateForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2>Add Items:</h2>
        <input type="hidden" name="id" value="{{$data->id}}" id="id">

        <label>Product Image:</label>
        <input type="file" name="image" class="form-control"><br>

        <label>Item Type:</label>
        <label for="html">New Type</label>
        <input type="radio" id="html" name="item_type" value="new_type" {{ ($data->item_type=="new_type")? "checked" : "" }}>
        <label for="css">Existing Type</label>
        <input type="radio" id="css" name="item_type" value="existing_type" {{ ($data->item_type=="existing_type")? "checked" : "" }}><br>

        <label>Item Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Item Name" value="{{$data['name']}}"><br>

        <label>Item Shape:</label>
        <input type="text" name="shape" class="form-control" placeholder="Item Shape" value="{{$data['shape']}}"><br>

        <label>Item Price:</label>
        <input type="text" name="price" class="form-control" placeholder="Item Price" value="{{$data['price']}}"><br>

        <label>Product Description:</label>
        <textarea type="text" name="description" class="form-control" placeholder="Item Description">{{$data['description']}}</textarea><br>

        <label>Item Length:</label>
        <input type="text" name="length" class="form-control" placeholder="Item Length (mm)" value="{{$data['length']}} mm"><br>

        <label>Item Width:</label>
        <input type="text" name="width" class="form-control" placeholder="Item Width (mm)" value="{{$data['width']}} mm"><br>

        <label>Item Depth:</label>
        <input type="text" name="depth" class="form-control" placeholder="Item Depth (mm)" value="{{$data['depth']}} mm"><br>

        <div class="text-center">
          <a href="{{route('seller.product.index')}}" class="btn btn-primary">Back</a>
          <button type="submit" class="btn btn-danger">Update</button>
        </div>

      </form>
    </div>
    <div class="text-center">
        <h3>Image Preview:</h3><br>
    <img src="{{ asset('assets/images/items/'.$data->image) }}" style="height: 300px;width:300px;">
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
  $(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#productupdateForm').submit(function(e) {
      event.preventDefault();

      var productForm = new FormData(this);
      var id = $('#id').val();
      var url = "{{route('seller.product.update',['_id_'])}}";
      var update_url = url.replace(['_id_'], id);
      

      $.ajax({
        url: update_url,
        type: 'POST',
        data: productForm,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
          if (response) {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Item updated successfully!',
              footer: "<a href={{route('seller.product.index')}}>Home Page</a>"
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Something went wrong!',
              footer: "<a href={{route('seller.product.index')}}>Home Page</a>"
            })
          }
        }

      });
    });
  });

   //validation
   $("#productupdateForm").validate({
      rules: {
        item_type: {
          required: true,
        },
        name: {
          required: true,
        },
        shape: {
          required: true,
        },
        price: {
          required: true,
        },
        description: {
          required: true,
        },
        length: {
          required: true,
        },
        width: {
          required: true,
        },
        depth: {
          required: true,
        },
        image: {
          required: true,
        },
       
      },
      messages: {
        item_type: {
          required: "Item type is required",
        },
        name: {
          required: "Name is required",
        },
        shape: {
          required: "Shape is required",
        },
        price: {
          required: "Price is required",
        },
        description: {
          required: "Description is required",
        },
        length: {
          required: "Length is required",
        },
        width: {
          required: "Width is required",
        },
        depth: {
          required: "Depth is required",
        },
        image: {
          required: "Image is required",
        },
      }
    });
</script>
@endpush