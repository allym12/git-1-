<section class="our-listing pb30-991">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="listing_sidebar dn db-lg">
                    <div class="sidebar_content_details style3">
                        <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                        <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
                            <div class="siderbar_widget_header">
                                <h4 class="title mb0">Find Your New Fashion items class="filter_closed_btn float-right"
                                    href="#"><small>x</small><span
                                        class="flaticon-close"></span></a></h4>
                            </div>
                            <div class="sidebar_advanced_search_widget">
                                <ul class="sasw_list mb0">
                                    <li class="search_area">
                                        <div class="form-group">
                                            <input type="text" class="form-control form_control"
                                                   placeholder="Enter Keyword" wire:model="test">
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_content style2 mb100">
                    <h2 class="breadcrumb_title">
                        Our listed Fashion items
                    </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('home')}}>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Fashion Listing
                        </li>
                    </ol>
                </div>
            </div>

        </div>
        <div class="row">
            @forelse($fashions as $fashion)
                <div class="item col-xl-3">
                    <div class="feat_property">
                        <div class="thumb">

                            <a href="{{route('fashions.show',$fashion->slug)}}">
                                <img class="img-whp"
                                     src="{{asset('storage/'.$fashion->image)}}"
                                     alt="{{$fashion->title}}-image">
                            </a>
                            <div class="thmb_cntnt">

                            </div>
                            <div class="thmb_cntnt2">

                            </div>
                        </div>
                        <div class="details">
                            <div class="tc_content">

                                <h4><a href="{{route('fashions.show',$fashion->slug)}}">
                                        {{$fashion->title}}
                                    </a></h4>
                                <ul class="prop_details mb0">


                                </ul>
                            </div>
                            <div class="fp_footer">
                                <ul class="fp_meta float-left mb0">
                                    <li class="list-inline-item">
                                        <a href="#">
                                                        <span class="heading-color fw600">
                                                            {{number_format($fashion->price)}} RWF
                                                        </span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="fp_meta float-right mb0">
                                    <a href="" class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                    {{--                                                <li class="list-inline-item"><a class="icon" href="#"><span--}}
                                    {{--                                                            class="flaticon-resize"></span></a></li>--}}
                                    {{--                                                <li class="list-inline-item"><a class="icon" href="#"><span--}}
                                    {{--                                                            class="flaticon-add"></span></a></li>--}}
                                    {{--                                                <li class="list-inline-item"><a class="icon" href="#"><span--}}
                                    {{--                                                            class="flaticon-heart-shape-outline"></span></a></li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <x-not-found/>
            @endforelse

            <div class="col-lg-12">
                {{$fashions->links('vendor.pagination.new')}}
            </div>

        </div>
    </div>


    <br><br>
    <hr>


</section>


