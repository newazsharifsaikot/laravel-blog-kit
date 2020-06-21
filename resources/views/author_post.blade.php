@extends("layouts.frontend.master")

@section("title")
    {{$author->name}}
@endsection

@section("css")

    <link href="{{asset('assets/frontend/css/author-post/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/author-post/responsive.css')}}" rel="stylesheet">
@endsection

@section("content")
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{$author->name}}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        @if($posts->count() > 0)
                            @foreach($posts as $post)
                                <div class="col-lg-6 col-md-6">
                                    <div class="card h-100">
                                        <div class="single-post post-style-1">

                                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="Blog Image"></div>

                                            <a class="avatar" href="{{route('author.profile.post',$post->user->username)}}"><img src="{{Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="Profile Image"></a>

                                            <div class="blog-info">

                                                <h4 class="title"><a href="{{route('post.details',$post->slug)}}"><b>{{$post->title}}</b></a></h4>

                                                <ul class="post-footer">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                         @else
                            <div class="col-lg-12 col-md-12">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">
                                        <div class="blog-info">
                                            <h5 class="text-center">No Post Found</h5>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                    </div><!-- row -->

{{--                    <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>--}}

                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 ">

                    <div class="single-post info-area ">

                        <div class="about-area">
                            <h4 class="title"><b>{{$author->name}}</b></h4>
                            <p>{{$author->about}}</p>
                            <strong>Author Since : {{$author->created_at->toDateString()}} </strong>
                        </div>

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->
@endsection

@section("js")

@endsection