@extends('admin_layout')

@section('title','Product')
@push('css')
 <!-- Bootstrap Select Css -->
<link href="{{asset('assets')}}/backend/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

@endpush

@section('content')
<div class="container-fluid">
        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW PRODUCT
                            </h2>
                        </div>

                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter Product Name">
                                </div>
                            </div>

                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Product price</label>
                                        <input type="number" step="0.01" id="name" class="form-control" name="price" placeholder="Enter Product Price">
                                    </div>
                            </div>

                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Product Color</label>
                                        <input type="text" id="name" class="form-control" name="color" placeholder="Enter Product Color">
                                    </div>
                            </div>

                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Stock</label>
                                        <input type="text" id="name" class="form-control" name="stock" placeholder="Enter Product Availablity">
                                    </div>
                            </div>

                            <div class="form-group form-float">
                                    <label for="sizes">Sizes</label>
                                    <table class="table table-bordered" id="dynamic_field">
                                        <tr>
                                            <td><input type="text" name="sizes[]" id="sizes" class="form-control"
                                                       placeholder="Enter product size"></td>
                                            <td>
                                                <button id="add" name="add" class="btn btn-info">Add More</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>


                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                                <label for="publish"> Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    CATEGORIES AND SUBCATEGORIES NAME
                                </h2>
                            </div>
                            <div class="body">
                                <div class="form-group form-float">
                                    <div class="form-line {{ $errors->has('categories') ? 'focused error' : ''}}">
                                        <label for="category">Select Categories</label>
                                        <select name="category_id" id="category" class="form-control show-tick"
                                        >
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{ $errors->has('subcategories') ? 'focused error' : ''}}">
                                        <label for="subCategory">Select SubCategories</label>
                                        <select name="subcategory_id" id="subCategory" class="form-control show-tick"
                                        >
                                            <option value=""></option>

                                        </select>
                                    </div>
                                </div>

                                <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.subcategory.index')}}"> BACK</a>
                                <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    PRODUCT DESCRIPTION
                                    <small>(Short)</small>
                                </h2>
                            </div>
                            <div class="body">
                                <textarea id="tinymce" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        PRODUCT DESCRIPTION
                                        <small>(Long)</small>
                                    </h2>
                                </div>
                                <div class="body">
                                    <textarea id="tinymce" name="long_description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
        </form>

</div>
@endsection

@push('js')
<!-- Select Plugin Js -->
<script src="{{asset('assets')}}/backend/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- TinyMCE -->
<script src="{{asset('assets')}}/backend/plugins/tinymce/tinymce.js"></script>

<script>
    $(function () {
 //TinyMCE
 tinymce.init({
     selector: "textarea#tinymce",
     theme: "modern",
     height: 300,
     plugins: [
         'advlist autolink lists link image charmap print preview hr anchor pagebreak',
         'searchreplace wordcount visualblocks visualchars code fullscreen',
         'insertdatetime media nonbreaking save table contextmenu directionality',
         'emoticons template paste textcolor colorpicker textpattern imagetools'
     ],
     toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
     toolbar2: 'print preview media | forecolor backcolor emoticons',
     image_advtab: true
 });
 tinymce.suffix = ".min";
 tinyMCE.baseURL = '{{asset('assets')}}/backend/plugins/tinymce';
});

</script>

@endpush

@section('script')
<script>
    $(document).ready(function () {
        $('#category').on('change', function (event) {
            console.log(event.target.value);
            let cat_id = event.target.value;
            $.get('/ajax-subcat?cat_id=' + cat_id, function (data) {
                $('#subCategory').empty();
                $.each(data, function (index, subCatObj) {
                    $('#subCategory').append('<option value="'+subCatObj.id+'">'+subCatObj.name+'</option>');
                });
            });
        });

        var i = 1;
            $('#add').click(function (event) {
                event.preventDefault();
                i++;
                $('#dynamic_field').append(`<tr id="row${i}">
                                        <td><input type="text" name="sizes[]" id="sizes" class="form-control" placeholder="Enter Product size"></td>
                                        <td><button id="${i}" name="remove" class="btn btn-danger btn-remove"><span>x</span></button></td>
                                    </tr>`)
            })
            $(document).on('click', '.btn-remove', function () {
                const button_id = $(this).attr("id");
                $(`#row${button_id}`).remove();
            })
        });
</script>

@endsection








