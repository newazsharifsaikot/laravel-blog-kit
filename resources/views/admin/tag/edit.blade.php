@extends("layouts.backend.master")

@section("title", "Tag")

@section("css")

@endsection

@section("content")
    <div class="container-fluid">
        <div class="block-header">

        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit Tag
                        </h2>
                    </div>
                    <div class="body">
                        <form method="post" action="{{route('admin.tag.update', $tag->id)}}">
                            @csrf
                            @method('put')
                            <label for="tag_name">Tag Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="name" id="tag_name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Tag Name" value="{{ $tag->name }}" autocomplete="name" autofocus>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                            <a href="{{route('admin.tag')}}" class="btn btn-danger btn-sm m-t-15 waves-effect">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section("js")

@endsection