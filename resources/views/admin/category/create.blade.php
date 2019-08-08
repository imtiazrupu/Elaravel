@extends('admin_layout')

@section('title','Category')

@push('css')
@endpush

@section('content')
<div class="container-fluid">

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADD NEW CATEGORY

                    </h2>

                </div>
                <div class="body">
                <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control" name="name">
                                <label class="form-label">Category Name</label>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            CATEGORY DESCRIPTION
                                        </h2>
                                    </div>
                                    <div class="body">
                                        <textarea id="tinymce" name="category_description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                            <label for="publish"> Publish</label>
                        </div>

                        <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.category.index')}}"> BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
