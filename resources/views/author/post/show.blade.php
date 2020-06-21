@extends("layouts.backend.master")

@section("title", "Post")

@section("css")
    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection

@section("content")
    <div class="container-fluid">
        <div class="block-header">
            <a href="{{route('author.post')}}" class="btn btn-primary waves-effect btn-sm">Back</a>

            @if($post->is_approve == false)
                <a href="#" class="btn btn-success btn-sm waves-effect pull-right">
                    <i class="material-icons">done</i>
                    <span>Approve</span>
                </a>
             @else
                <button class="btn btn-success btn-sm waves-effect disabled pull-right">
                    <i class="material-icons">done</i>
                    <span>Approved</span>
                </button>
            @endif
        </div>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{$post->title}}
                                <small>Posted by <strong><a href="#">{{$post->user->name}}</a></strong> on {{$post->created_at->toFormattedDateString()}} </small>
                            </h2>
                        </div>
                        <div class="body">
                              {!! $post->description !!}

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                Categories
                            </h2>
                        </div>
                        <div class="body">
                            @foreach($post->categories as $category)
                                <label class="label label-info">{{$category->name}}</label>
                            @endforeach
                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-pink">
                            <h2>
                                 Tags
                            </h2>
                        </div>
                        <div class="body">
                            @foreach($post->tags as $tag)
                                <label class="label label-danger">{{$tag->name}}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Feature Image
                            </h2>
                        </div>
                        <div class="body">
                            <img src="{{Storage::disk('public')->url('post/'.$post->image)}}" class="img-responsive">

                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section("js")
    <!-- Select Plugin Js -->
    <script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <!-- TinyMCE -->
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>
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
            tinyMCE.baseURL = '{{asset('assets/backend/plugins/tinymce')}}';
        });
    </script>

@endsection