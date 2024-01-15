<x-layouts.main>

    <section class="listing-title-area pb50">
        <div class="container">
            <div class="row mb30">
                <div class="col-lg-7 col-xl-7">
                    <div class="single_property_title mt30-767">
                        <div class="breadcrumb_content style3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Houses</a></li>
                                <li class="breadcrumb-item active style2" aria-current="page">
                                    {{$car->title}}
                                </li>
                            </ol>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h2 class="mt-0">
                                    {{$car->title}}
                                </h2>
                                <p>
                                    {!! Str::limit($car->description, 50)  !!}
                                </p>
                                <ul class="prop_details mb0">
                                    <li class="list-inline-item mr20"><a class="mr20" href="#"><span
                                                class="flaticon-car pr5 vam"></span>
                                            {{$car->condition}}</a></li>
                                    <li class="list-inline-item mr20"><a class="mr20" href="#"><span
                                                class="flaticon-car-key pr5 vam"></span> {{$car->transmission}}</a>
                                    </li>

                                </ul>



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
                                {{$car->price}} RWF
                            </h3></div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12 pr0 pl15-767 pr15-767">
                            <div class="spls_style_two mb30-md">
                                <a class="popup-img" href="{{asset('storage/'.$car->image)}} ">
                                    <img class="img-fluid first-img" src="{{asset('storage/'.$car->image)}}"
                                         alt="{{$car->title}}-image">
                                </a>

                                <a href="#"><span class="baddge_right">FOR
                                    {{$car->type}}
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        @foreach($car->other_photos as $photo)

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
                                    {!! $car->description !!}
                                </p>

                                <div class="row col-md-12 d-flex flex-wrap align-content-start">
                                    @foreach($allcaroptions as $value => $option)
                                        @if(in_array($value, $car->car_options))
                                            <span class="badge badge-success mr-2 mb-2">{{$option}} <i class="flaticon-checked"></i></span>
                                        @else
                                            <span class="badge badge-danger mr-2 mb-2">{{$option}}</span>
                                        @endif

                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="location_details pb40 mt50 bb1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="mb15">About this item</h4>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <ul class="list-inline-item mb0">
                                            <li>Transmission: <b>{{$car->transmission}}</b></li>
                                            <li>Make/Model: <b>{{$car->make}}/{{$car->model}}</b></li>
                                        </ul>

                                    </div>


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
                                        {{$car->user_id ? $car->user->name : 'Admin'}}
                                    </h5>
                                    <p class="mb0">
                                        <a href="tel:{{$car->user_id ? $car->user->phone : '0783276274'}}">
                                            {{$car->user_id ? $car->user->phone : '0783276274'}}
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
