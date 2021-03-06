@extends("layouts.backend.master")

@section("title", "Authors")

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
                            All Authors <span class="badge badge-pill">{{$authors->count()}}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th >Name</th>
                                    <th >Email</th>
                                    <th >Image</th>
                                    <th width="15%">Posts</th>
                                    <th >Favorite Posts</th>
                                    <th >Created At</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Serial</th>
                                    <th >Name</th>
                                    <th >Email</th>
                                    <th >Image</th>
                                    <th>Posts</th>
                                    <th >Favorite Posts</th>
                                    <th >Created At</th>
                                    <th >Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($authors as $key=>$author)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$author->name}}</td>
                                        <td>{{$author->email}}</td>
                                        <td>
                                            <img src="{{Storage::disk('public')->url('profile/'.$author->image)}}" alt="img" width="64" height="64" class="img-thumbnail">
                                        </td>
                                        <td>{{$author->posts_count}}</td>
                                        <td>{{$author->favourite_posts_count}}</td>
                                        <td>{{$author->created_at->toDateString()}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm waves-effect" title="Delete" onclick="removeAuthor({{$author->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-author-{{$author->id}}" method="post" action="{{route('admin.author.destroy',$author->id)}}" style="display: none;">
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
        function removeAuthor(id) {
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
                    document.getElementById('delete-author-'+id).submit();
                }
            })
        }

    </script>


@endsection