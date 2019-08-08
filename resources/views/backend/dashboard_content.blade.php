@extends('admin_layout')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL POSTS</div>
                        <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">favorite</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL FAVORITE</div>
                        <div class="number count-to" data-from="0" data-to="" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">library</i>
                    </div>
                    <div class="content">
                        <div class="text">PENDING POSTS</div>
                        <div class="number count-to" data-from="0" data-to="" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL VIEWS</div>
                        <div class="number count-to" data-from="0" data-to="" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="info-box bg-pink hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="content">
                        <div class="text">CATEGORIES</div>
                        <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <div class="info-box bg-blue-grey hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">labels</i>
                    </div>
                    <div class="content">
                        <div class="text">TAGS</div>
                        <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

                <div class="info-box bg-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">account_cirle</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL AUTHORS</div>
                        <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
                <div class="info-box bg-deep-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">fiber_new</i>
                    </div>
                    <div class="content">
                        <div class="text">TODAY'S AUTHORS</div>
                        <div class="number count-to" data-from="0" data-to="" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
            <div class="card">
                <div class="header">
                    <h2>MOST POPULAR POST</h2>
                </div>
                <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>Rank List</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Views</th>
                                        <th>Favorite</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>

        </div>

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>TOP 10 ACTIVE AUTHOR</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                            <th>Rank List</th>
                                            <th>Name</th>
                                            <th>Posts</th>
                                            <th>Comments</th>
                                            <th>Favorite</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
@endsection

@push('js')
<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('assets')}}/backend/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="{{asset('assets')}}/backend/plugins/raphael/raphael.min.js"></script>
<script src="{{asset('assets')}}/backend/plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="plugins/chartjs/Chart.bundle.js"></script>

<!-- Flot Charts Plugin Js -->
<script src="{{asset('assets')}}/backend/plugins/flot-charts/jquery.flot.js"></script>
<script src="{{asset('assets')}}/backend/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="{{asset('assets')}}/backend/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="{{asset('assets')}}/backend/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="{{asset('assets')}}/backend/plugins/flot-charts/jquery.flot.time.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="{{asset('assets')}}/backend/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="{{asset('assets')}}/backend/js/pages/index.js"></script>
@endpush
