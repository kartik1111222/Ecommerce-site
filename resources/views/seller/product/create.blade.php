@extends('seller.layouts.master')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="{{route('seller.product.store')}}" method="POST" id="productForm" enctype="multipart/form-data">
        @csrf
        <h2>Add Items:</h2>

        <label>Product Image:</label>
        <input type="file" name="image" class="form-control"><br>

        <!-- <label>Item Type:</label> -->
        <!-- <label for="html">New Type</label>
        <input type="radio" id="html" name="item_type" value="new_type">
        <label for="css">Existing Type</label>
        <input type="radio" id="css" name="item_type" value="existing_type"><br> -->
        <label for="cars">Choose Item Type:</label>

        <select name="item_type" id="item_type" class="form-control">
          <option value="0">Men</option>
          <option value="1">Women</option>
          <option value="2">Shoes</option>
          <option value="3">Watches</option>
          <option value="4">Bags</option>
        </select><br>
        <label>Item Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Item Name"><br>

        <label>Item Shape:</label>
        <input type="text" name="shape" class="form-control" placeholder="Item Shape"><br>

        <label>Item Price:</label>
        <input type="text" name="price" class="form-control" placeholder="Item Price"><br>

        <label>Product Description:</label>
        <textarea type="text" name="description" class="form-control" placeholder="Item Description"></textarea><br>

        <label>Item Length:</label>
        <input type="text" name="length" class="form-control" placeholder="Item Length (mm)"><br>

        <label>Item Width:</label>
        <input type="text" name="width" class="form-control" placeholder="Item Width (mm)"><br>

        <label>Item Depth:</label>
        <input type="text" name="depth" class="form-control" placeholder="Item Depth (mm)"><br>

        <div class="text-center">
          <a href="{{route('seller.product.index')}}" class="btn btn-primary">Back</a>
          <button type="submit" class="btn btn-danger">Submit</button>
        </div>

      </form>
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

    $('#productForm').submit(function(e) {
      event.preventDefault();

      var productForm = new FormData(this);
      var url = "{{route('seller.product.store')}}";

      $.ajax({
        url: url,
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
              text: 'Item added successfully!',
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
  $("#productForm").validate({
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