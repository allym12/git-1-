<x-layouts.main>

    <section class="listing-title-area pb50">
        <div class="container">
            <div class="row mb30">
                <div class="col-lg-7 col-xl-7">
                    <div class="single_property_title mt30-767">
                        <div class="breadcrumb_content style3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Fashion</a></li>
                                <li class="breadcrumb-item active style2" aria-current="page">
                                    {{$fashion->title}}
                                </li>
                            </ol>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h2 class="mt-0">
                                    {{$fashion->title}}
                                </h2>
                                <p>
                                    {!! Str::limit($fashion->description, 50)  !!}
                                </p>




                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-5">
                    <div class="single_property_social_share_content text-right tal-md">
                        <div class="spss style2 mt30">
                            <ul class="mb0">
                                <li class="list-inline-item icon"><a href="#"><span class="flaticon-share"></span></a>
                                </li>
                                <li class="list-inline-item"><a href="#">Share</a></li>

                            </ul>
                        </div>
                        <div class="price mt20 mb10"><h3>
                                {{$fashion->price}} RWF
                            </h3></div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12 pr0 pl15-767 pr15-767">
                            <div class="spls_style_two mb30-md">
                                <a class="popup-img" href="{{asset('storage/'.$fashion->image)}} ">
                                    <img class="img-fluid first-img" src="{{asset('storage/'.$fashion->image)}}"
                                         alt="{{$fashion->title}}-image">
                                </a>

                                <a href="#"><span class="baddge_right">FOR
                                    {{$fashion->type}}
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        @foreach($fashion->other_photos as $photo)

                            <div class="col-sm-4 col-lg-4 pr5 pr15-767">
                                <div class="spls_style_two mb10">
                                    <a class="popup-img" href="{{asset('storage/'.$photo)}}">
                                        <img class="img-fluid w100" src="{{asset('storage/'.$photo)}}" alt="2.jpg">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-agent-single pt0 pb70">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="listing_single_description mb60">
                                <h4 class="mb30">Description</h4>
                                <p class="first-para mb25">
                                    {!! $fashion->description !!}
                                </p>

                                <span>Available colors</span>
                                <div class="row col-md-12 d-flex flex-wrap align-content-start">
                                    @foreach($fashion->colors as $color)

                                            <span class="badge badge-secondary mr-2 mb-2">{{$color}}</span>

                                    @endforeach
                                </div>

                            </div>
                        </div>



                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="listing_single_sidebar">
                        <div class="sidebar_agent_search_widget mb30">
                            <h2 class="fz18 mb15">Contact owner</h2>
                            <div class="media">
                                <img class="mr-3 author_img" src="{{asset('images/team/author.png')}}" alt="author.png">
                                <div class="media-body">
                                    <h5 class="mt10 mb5 fz16 heading-color fw600">
                                        {{$fashion->user_id ? $fashion->user->name : 'Admin'}}
                                    </h5>
                                    <p class="mb0">
                                        <a href="tel:{{$fashion->user_id ? $fashion->user->phone : '0783276274'}}">
                                            {{$fashion->user_id ? $fashion->user->phone : '0783276274'}}
                                        </a>
                                    </p>
                                    {{--                                    <a class="tdu text-thm" href="#">View Listings</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.main>
