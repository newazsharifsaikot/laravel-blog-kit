@extends("layouts.backend.master")

@section("title", "Post")

@section("css")
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="block-header">
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Pending Post <span class="badge badge-pill">{{$posts->count()}}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>image</th>
                                    <th>Is Approve</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Serial</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>image</th>
                                    <th>Is Approv</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($posts as $key=>$post)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{Str::limit($post->title, 10)}}</td>
                                        <td>
                                            <img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="img" width="70" height="40" class="img-responsive">
                                        </td>
                                        <td>
                                            @if($post->is_approve == true)
                                                <span class="btn btn-success btn-sm">approved</span>
                                            @else
                                                <span class="btn btn-danger btn-sm">pending</span>
                                            @endif

                                        </td>
                                        <td>
                                            @if($post->status == true)
                                                <span class="btn btn-success btn-sm">Published</span>
                                            @else
                                                <span class="btn btn-danger btn-sm">pending</span>
                                            @endif

                                        </td>
                                        <td>
                                            @if($post->is_approve == false)
                                                <button class="btn btn-success btn-sm waves-effect pull-right" onclick="approvePost()" title="Approve Post">
                                                    <i class="material-icons">done</i>
                                                </button>
                                                <form method="post" action="{{route('admin.post.approval-post',$post->id)}}" id="approve-post" style="display: none" >
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            @endif

                                            @if($post->status == true)
                                                <a href="{{route('admin.post.pending',$post->id)}}" class="btn btn-danger btn-sm waves-effect pull-right" title=" Status Pending" onclick="return confirm('Are you Sure ?') ">
                                                    <i class="material-icons">clear</i>
                                                </a>
                                             @else
                                                <a href="{{route('admin.post.publish',$post->id)}}" class="btn btn-success btn-sm waves-effect pull-right" title="Status Publish" onclick="return confirm('Are you Sure ?') ">
                                                    <i class="material-icons">done</i>
                                                </a>
                                            @endif
                                            <a href="{{route('admin.post.show', $post->id)}}" class="btn btn-info btn-sm waves-effect" title="Show">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{route('admin.post.edit', $post->id)}}" class="btn btn-primary btn-sm waves-effect" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm waves-effect" title="Delete" onclick="deletePost({{$post->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-post-{{$post->id}}" method="post" action="{{route('admin.post.destroy',$post->id)}}" style="display: none;">
                                                @csrf
                                                @method('delete')
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

@section("js")
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>

    <script>
        function deletePost(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-post-'+id).submit();
                }
            })
        }

        function approvePost() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('approve-post').submit();
                }
            })
        }
    </script>


@endsection