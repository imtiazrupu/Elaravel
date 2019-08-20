@extends('admin_layout')

@section('title','SubCategory')
@push('css')
 <!-- Bootstrap Select Css -->
<link href="{{asset('assets')}}/backend/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
        <form name="subCategoryEditForm" action="{{route('admin.subcategory.update',$subcategory->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT SUBCATEGORY
                                <small>With floating label</small>
                            </h2>
                        </div>
                        <div class="body">
                                <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="name" class="form-control" name="name" value="{{ $subcategory->name}}">
                                            <label class="form-label">SubCategory Name</label>
                                        </div>
                                    </div>
                            <div class="form-group">
                                <label for="image">SubCategory Image</label>
                                <input type="file" name="image">
                                <img width="120px" src="{{ Storage::disk('public')->url('subcategory/'.$subcategory->image)}}" alt="{{ $subcategory->name}}">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1"
                                {{ $subcategory->status == true? 'checked': ''}}>
                                <label for="publish"> Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    CATEGORIES NAME
                                    <small>With floating label</small>
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
                                    SUBCATEGORY DESCRIPTION
                                    <small>With floating label</small>
                                </h2>
                            </div>
                            <div class="body">
                                <textarea id="tinymce" name="subcategory_description">{{ $subcategory->subcategory_description}}</textarea>
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
   <script>
    document.forms['subCategoryEditForm'].elements['category_id'].value = '{{ $subcategory->category_id}}';
</script>

@endpush
