@extends('admin_layout')

@section('title','Product')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{asset('assets')}}/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
    <a class="btn btn-primary waves-effect" href="{{route('admin.product.create')}}">
        <i class="fa fa-plus"></i>
        <span>Add New Product</span>
    </a>
    </div>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ALL PRODUCTS
                        <span class="badge bg-blue">{{$products->count()}}</span>
                    </h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>SubCategory Name</th>
                                    <th>Short Description</th>
                                    <th>Price</th>
                                    <th>Color</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Sizes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>SubCategory Name</th>
                                    <th>Short Description</th>
                                    <th>Price</th>
                                    <th>Color</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Sizes</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($products as $key=>$product)
                                <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->name}}</td>
                                <td>{{ $product->category->name}}</td>
                                <td>{{ $product->subCategory->name}}</td>
                                <td>{!! str_limit($product->description,'20') !!}</td>
                                <td>{{ $product->price}}</td>
                                <td>{{ $product->color}}</td>
                                <td>{{ $product->stock}}</td>
                                <td>
                                        @if( $product->status == true)
                                        <span class="badge bg-blue">Active</span>
                                        @else
                                        <span class="badge bg-pink"> Inactive</span>
                                        @endif
                                </td>
                                <td><img width="80px" src="{{ Storage::disk('public')->url('product/'.$product->image)}}" alt="{{ $product->name}}"></td>

                                <td> @foreach ($product->productSizes as $siz)
                                        {{ $siz->size}}
                                @endforeach

                                </td>

                                <td class="text-center">
                                        @if($product->status == false)
                                        <button type="button" class="btn btn-warning waves-effect" onclick="inactiveProduct({{ $product->id}})">
                                            <form id="approval-form" action="{{route('admin.product.inactive',$product->id)}}"
                                                method="POST" style="display:none;">
                                               @csrf
                                               @method('PUT')
                                               </form>
                                            <i class="material-icons">done</i>
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-success waves-effect" onclick="activeProduct({{ $product->id}})">
                                                <form id="disapproval-form" action="{{route('admin.product.active',$product->id)}}"
                                                    method="POST" style="display:none;">
                                                   @csrf
                                                   @method('PUT')
                                                   </form>
                                                <i class="material-icons">done</i>
                                            </button>
                                        @endif

                                <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-info waves-effect">
                                <i class="material-icons">edit</i>
                                </a>
                                <button class="btn btn-danger waves-effect" type="button"
                                onclick="deleteProduct({{$product->id}})">
                                    <i class="material-icons">delete</i>
                                </button>
                            <form id="delete-form-{{$product->id}}" action="{{route('admin.product.destroy',$product->id)}}"
                                 method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                                </form>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
@endsection

@push('js')
<script src="{{asset('assets')}}/backend/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{asset('assets')}}/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{asset('assets')}}/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{asset('assets')}}/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{asset('assets')}}/backend/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{asset('assets')}}/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{asset('assets')}}/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{asset('assets')}}/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{asset('assets')}}/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="{{asset('assets')}}/backend/js/pages/tables/jquery-datatable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
    function deleteProduct(id){
        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false,
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
   event.preventDefault();
   document.getElementById('delete-form-'+id).submit();
  } else if (
    // Read more about handling dismissals
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your data is safe :)',
      'error'
    )
  }
})
    }

    //Approve Product
    function inactiveProduct(id){
                    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to active this Product!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, active it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
            event.preventDefault();
            document.getElementById('approval-form').submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'The Product remains inactive :)',
                'info'
                )
            }
            })
                }

    //Dispprove Product
    function activeProduct(id){
                    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to inactive this Product!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, inactive it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
            event.preventDefault();
            document.getElementById('disapproval-form').submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'The Product remains active :)',
                'info'
                )
            }
            })
                }
    </script>
@endpush
