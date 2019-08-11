@extends('admin_layout')

@section('title','SubCategory')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{asset('assets')}}/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
    <a class="btn btn-primary waves-effect" href="{{route('admin.subcategory.create')}}">
        <i class="material-icons">add</i>
        <span>Add New SubCategory</span>
    </a>
    </div>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ALL SUBCATEGORIES
                        <span class="badge bg-blue">{{$subcategories->count()}}</span>
                    </h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($subcategories as $key=>$subcategory)
                                <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $subcategory->name}}</td>
                                <td>{{ $subcategory->category->name}}</td>
                                <td>{!! str_limit($subcategory->subcategory_description,'20') !!}</td>
                                <td>
                                        @if( $subcategory->status == true)
                                        <span class="badge bg-blue">Active</span>
                                        @else
                                        <span class="badge bg-pink"> Inactive</span>
                                        @endif
                                </td>
                                <td><img width="80px" src="{{ Storage::disk('public')->url('subcategory/'.$subcategory->image)}}" alt="{{ $subcategory->name}}"></td>
                                <td class="text-center">
                                        @if($subcategory->status == false)
                                        <button type="button" class="btn btn-warning waves-effect" onclick="inactiveSubcategory({{ $subcategory->id}})">
                                            <form id="approval-form" action="{{route('admin.subcategory.inactive',$subcategory->id)}}"
                                                method="POST" style="display:none;">
                                               @csrf
                                               @method('PUT')
                                               </form>
                                            <i class="material-icons">done</i>
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-success waves-effect" onclick="activeSubcategory({{ $subcategory->id}})">
                                                <form id="disapproval-form" action="{{route('admin.subcategory.active',$subcategory->id)}}"
                                                    method="POST" style="display:none;">
                                                   @csrf
                                                   @method('PUT')
                                                   </form>
                                                <i class="material-icons">done</i>
                                            </button>
                                        @endif

                                <a href="{{route('admin.subcategory.edit',$subcategory->id)}}" class="btn btn-info waves-effect">
                                <i class="material-icons">edit</i>
                                </a>
                                <button class="btn btn-danger waves-effect" type="button"
                                onclick="deleteSubcategory({{$subcategory->id}})">
                                    <i class="material-icons">delete</i>
                                </button>
                            <form id="delete-form-{{$subcategory->id}}" action="{{route('admin.subcategory.destroy',$subcategory->id)}}"
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
    function deleteSubcategory(id){
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

    //Approve SubCategory
    function inactiveSubcategory(id){
                    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to active this SubCategory!",
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
                'The subcategory remains inactive :)',
                'info'
                )
            }
            })
                }

    //Dispprove SubCategory
    function activeSubcategory(id){
                    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to inactive this SubCategory!",
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
                'The Subcategory remains active :)',
                'info'
                )
            }
            })
                }
    </script>
@endpush
