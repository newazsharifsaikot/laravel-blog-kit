@extends("layouts.backend.master")

@section("title", "Comment")

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
                            All Comment <span class="badge badge-pill">{{$comments->count()}}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th width="45%">Comment Info</th>
                                    <th width="45%">Post Info</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th width="45%">Comment Info</th>
                                    <th width="45%">Post Info</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($comments as $key=>$comment)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object img-thumbnail" src="{{Storage::disk('public')->url('profile/'.$comment->user->image)}}" alt="img" width="64" height="64">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">{{$comment->user->name}} <small class="text-muted">on {{$comment->created_at->diffForHumans()}}</small></h4>
                                                    <p>{{Str::limit($comment->comment, 25)}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object img-thumbnail" src="{{Storage::disk('public')->url('post/'.$comment->post->image)}}" alt="img" width="64" height="64">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">{{Str::limit($comment->post->title, 20)}}</h4>
                                                    <p> by {{$comment->user->name}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm waves-effect" title="Delete" onclick="removePost({{$comment->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-comment-{{$comment->id}}" method="post" action="{{route('author.comment.destroy',$comment->id)}}" style="display: none;">
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
        function removePost(id) {
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
                    document.getElementById('delete-comment-'+id).submit();
                }
            })
        }

    </script>


@endsection