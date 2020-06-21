@extends('layouts.frontend.master')

@section('title','Home')

@section('css')
    <link href="{{asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">

    <style>
        .favourite-post{
            color: #0610bf;
        }
    </style>

@endsection

@section('content')
    <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
             data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
             data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                    <div class="swiper-slide">
                    <a class="slider-category" href="{{route('category.post',$category->slug)}}">
                        <div class="blog-image"><img src="{{Storage::disk('public')->url('category/slider/'.$category->image)}}" alt="{{$category->name}}"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{$category->name}}</b></h3>
                                </div>
                            </div>
                        </div>

                    </a>
                </div><!-- swiper-slide -->
                @endforeach
            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div>

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
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
            </div>

            <a class="load-more-btn" href="{{route('all.post')}}"><b>LOAD MORE</b></a>

        </div>
    </section>
@endsection

@section('js')

@endsection