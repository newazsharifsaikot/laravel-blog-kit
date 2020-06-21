@extends("layouts.backend.master")

@section("title", "Category")

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
                            Edit Category
                        </h2>
                    </div>
                    <div class="body">
                        <form method="post" action="{{route('admin.category.update', $category->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <label for="tag_name">Tag Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="name" id="tag_name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Tag Name" value="{{ $category->name }}" autocomplete="name" autofocus>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                </div>
                                <img src="{{asset('storage/category/'.$category->image)}}" alt="img" width="120" height="70">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                            <a href="{{route('admin.category')}}" class="btn btn-danger btn-sm m-t-15 waves-effect">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section("js")

@endsection