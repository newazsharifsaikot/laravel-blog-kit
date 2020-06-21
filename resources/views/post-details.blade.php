@extends("layouts.frontend.master")

@section("title")
    {{$post->title}}
@endsection

@section("css")
    <link href="{{asset('assets/frontend/css/post-details/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/post-details/responsive.css')}}" rel="stylesheet">
    <style>
        .header-img{
            width: 100%;
            height: 400px;
            background-image: url({{Storage::disk('public')->url('post/'.$post->image)}});
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section("content")
    <div class="header-img">
{{--        <div class="display-table  center-text">--}}
{{--            <h1 class="title display-table-cell"><b>DESIGN</b></h1>--}}
{{--        </div>--}}
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="{{route('author.profile.post',$post->user->username)}}"><img src="{{Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="{{route('author.profile.post',$post->user->username)}}"><b>{{$post->user->name}}</b></a>
                                    <h6 class="date">on {{$post->created_at->diffForHumans()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

                            <div class="para">
                                {!! html_entity_decode($post->description) !!}
                            </div>

                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                <li><a href="{{route('tag.post',$tag->slug)}}">{{$tag->name}}</a></li>

                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                @guest
                                    <li>
                                        <a href="javascript:void(0);" onclick="toastr.info('You need to Login First','Info',{
                                                progressBar:true,
                                                closeButton:true,
                                                preventDuplicates:false
                                            })"><i class="fas fa-heart"></i>{{$post->favourite_to_users->count()}}</a>
                                    </li>
                                @else
                                    <li>
                                        <a class="{{Auth::user()->favourite_posts->where('pivot.post_id', $post->id)->count() == 1 ? 'favourite-post' : ''}}" onclick="document.getElementById('favourite-post-{{$post->id}}').submit()" href="javascript:void(0);"><i class="fas fa-heart"></i>{{$post->favourite_to_users->count()}}</a>
                                    </li>

                                    <form id="favourite-post-{{$post->id}}" method="post" action="{{route('favourite.post',$post->id)}}" style="display: none;">
                                        @csrf
                                    </form>
                                @endguest

                                <li><a href="#"><i class="fas fa-comment"></i>{{$post->comments->count()}}</a></li>
                                <li><a href="#"><i class="fas fa-eye"></i>{{$post->view_count}}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                            </ul>
                        </div>

                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                            <p>{{$post->user->about}}</p>
                        </div>

                        <div class="sidebar-area subscribe-area">

                            <h4 class="title"><b>SUBSCRIBE</b></h4>
                            <div class="input-area">
                                <form method="post" action="{{route('subscriber.store')}}">
                                    @csrf
                                    <input type="email" class="email-input @error('email') is-invalid @enderror" name="email" placeholder="Enter your email">
                                    <button class="submit-btn" type="submit"><i class="material-icons">mail</i></button>
                                </form>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                            </span>
                            @enderror

                        </div><!-- subscribe-area -->

                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORY CLOUD</b></h4>
                            <ul>
                                @foreach($post->categories as $category)
                                    <li><a href="{{route('category.post',$category->slug)}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($randoms as $random)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$random->image)}}" alt="Blog Image"></div>

                                <a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profile/'.$random->user->image)}}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{route('post.details',$random->slug)}}"><b>{{$random->title}}</b></a></h4>

                                    <ul class="post-footer">
                                        @guest
                                            <li>
                                                <a href="javascript:void(0);" onclick="toastr.info('You need to Login First','Info',{
                                                progressBar:true,
                                                closeButton:true,
                                                preventDuplicates:false
                                            })"><i class="fas fa-heart"></i>{{$random->favourite_to_users->count()}}</a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="{{Auth::user()->favourite_posts->where('pivot.post_id', $random->id)->count() == 1 ? 'favourite-post' : ''}}" onclick="document.getElementById('favourite-post-{{$random->id}}').submit()" href="javascript:void(0);"><i class="fas fa-heart"></i>{{$random->favourite_to_users->count()}}</a>
                                            </li>

                                            <form id="favourite-post-{{$random->id}}" method="post" action="{{route('favourite.post',$random->id)}}" style="display: none;">
                                                @csrf
                                            </form>
                                        @endguest

                                        <li><a href="#"><i class="fas fa-comment"></i>{{$random->comments->count()}}</a></li>
                                        <li><a href="#"><i class="fas fa-eye"></i>{{$random->view_count}}</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                    @guest
                        <p>For Comment, You need to Login first <a href="{{route('login')}}" style="font-weight: bold">Click here</a></p>
                    @else
                        <form method="post" action="{{route('comment.store',$post->id)}}" >
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                <textarea name="comment" rows="2" class="text-area-messge form-control @error('comment') is-invalid @enderror"
                                      placeholder="Enter your comment" aria-required="true" aria-invalid="false">

                                </textarea >
                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: #ba0000; font-weight: lighter">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div>

                            </div>
                        </form>
                    @endguest
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{$post->comments->count()}})</b></h4>
                    @if($post->comments->count() > 0)
                        @foreach($post->comments as $comment)
                            <div class="commnets-area ">

                                <div class="comment">

                                    <div class="post-info">

                                        <div class="left-area">
                                            <a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profile/'.$comment->user->image)}}" alt="Profile Image"></a>
                                        </div>

                                        <div class="middle-area">
                                            <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                            <h6 class="date">on {{$comment->created_at->diffForHumans()}}</h6>
                                        </div>

                                        <div class="right-area">
                                            <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                        </div>

                                    </div><!-- post-info -->

                                    <p>{{$comment->comment}}</p>

                                </div>

                            </div>
                        @endforeach
                    @else
                        <h5 class="more-comment-btn"><strong >No comments Found</strong></h5>
                     @endif

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@section("js")

@endsection