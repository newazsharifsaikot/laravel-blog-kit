@extends("layouts.backend.master")

@section("title", "Post")

@section("css")
    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection

@section("content")
    <div class="container-fluid">
        <div class="block-header">

        </div>
        <form method="post" action="{{route('admin.post.update',$post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit New Post
                            </h2>
                        </div>
                        <div class="body">
                            <label for="Title">Post Title</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" id="Title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Post title" value="{{ $post->title }}" autocomplete="title" autofocus>
                                </div>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                            <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                </div>
                                <img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="img" width="120" height="70" class="img-responsive">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                            <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="status" class="filled-in" name="status" value="true" {{$post->status == true ? 'checked' : ''}}>
                                <label for="status">Publish</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Select Category & Tag
                            </h2>
                        </div>
                        <div class="body">
                            <label for="form-label">Select Category</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="categories[]" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                            <option
                                                  @foreach($post->categories as $postCat)
                                                          {{$postCat->id == $category->id ? 'selected' : ''}}
                                                  @endforeach
                                            value="{{$category->id}}" style="padding-left: 50px">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('categories')
                                <span class="invalid-feedback" role="alert">
                                            <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <label for="cat_name">Tag Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="tags[]" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option
                                                    @foreach($post->tags as $postTag)
                                                    {{$postTag->id == $tag->id ? 'selected' : ''}}
                                                    @endforeach

                                                    value="{{$tag->id}}" style="padding-left: 50px">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tags')
                                <span class="invalid-feedback" role="alert">
                                            <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                            <a href="{{route('admin.post')}}" class="btn btn-danger btn-sm m-t-15 waves-effect">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Write Your Post Details
                            </h2>
                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="description">{!! $post->description !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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