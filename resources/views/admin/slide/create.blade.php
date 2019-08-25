@extends('admin_layout')

@section('title','Slide')

@push('css')
@endpush

@section('content')
<div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ADD NEW SLIDE

                        </h2>

                    </div>
                    <div class="body">
                    <form action="{{route('admin.slide.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group">
                                    <label for="image">Slide Image</label>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                                <label for="publish"> Publish</label>
                            </div>

                            <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.slide.index')}}"> BACK</a>
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

@endpush
