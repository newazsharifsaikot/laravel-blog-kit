@extends("layouts.backend.master")

@section("title", "Dashboard")

@section("css")

@endsection

@section("content")
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text">ALL POST</div>
                        <div class="number count-to" data-from="0" data-to="{{$all_post}}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">lock</i>
                    </div>
                    <div class="content">
                        <div class="text">PENDING POST</div>
                        <div class="number count-to" data-from="0" data-to="{{$pending_post}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">visibility</i>
                    </div>
                    <div class="content">
                        <div class="text">VIEW COUNT</div>
                        <div class="number count-to" data-from="0" data-to="{{$view}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL AUTHOR</div>
                        <div class="number count-to" data-from="0" data-to="{{$author}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-blue hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">category</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL CATEGORY</div>
                        <div class="number count-to" data-from="0" data-to="{{$category}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-teal hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">label</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL TAG</div>
                        <div class="number count-to" data-from="0" data-to="{{$tag}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_search</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW AUTHOR</div>
                        <div class="number count-to" data-from="0" data-to="{{$new_author}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-grey hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">admin_panel_settings</i>
                    </div>
                    <div class="content">
                        <div class="text">ADMIN FAVORITE POST</div>
                        <div class="number count-to" data-from="0" data-to="{{Auth::user()->favourite_posts()->count()}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- #END# Widgets -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Favorite Post</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>title</th>
                                    <th>View </th>
                                    <th>Favorite</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($popular_posts as $key=>$post)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{ Str::limit($post->title, 35)}}</td>
                                        <td>{{$post->view_count}}</td>
                                        <td>{{$post->favourite_to_users_count}}</td>
                                        <td>{{$post->comments_count}}</td>
                                        <td>
                                            @if($post->is_approve == true)
                                                <span class="label label-success">Approved</span>
                                            @else
                                                <span class="label label-danger">Pending</span>
                                            @endif
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
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Active Author</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Favorite</th>
                                    <th>Comment</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($active_authors as $key=>$author)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$author->name}}</td>
                                        <td>{{$author->posts_count}}</td>
                                        <td>{{$author->favourite_posts_count}}</td>
                                        <td>{{$author->comments_count}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <!-- Morris Plugin Js -->
    <script src="{{asset('assets/backend/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/morrisjs/morris.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{asset('assets/backend/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
@endsection