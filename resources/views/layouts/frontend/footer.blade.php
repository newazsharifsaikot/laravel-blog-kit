<footer>

    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <p class="copyright">{{config('app.name')}} @ {{date('yy')}}. All rights reserved.</p>
                    <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a> Develoved By <a href="https://www.facebook.com/mdNewazsharifsaikot" style="color: #2c21a6;"><strong>Newaz Sharif</strong></a></p>
                    <ul class="icons">
                        <li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
                    </ul>

                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="title"><b>CATAGORIES</b></h4>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{route('category.post',$category->slug)}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>

                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">

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

                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

        </div><!-- row -->
    </div><!-- container -->
</footer>