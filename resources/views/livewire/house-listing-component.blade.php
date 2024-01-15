<section class="our-listing pb30-991"
@if($paymentProcessStarted)
    wire:poll.keep-alive = 'checkPayment'
@endif
>
    <x-loading-spinner wire:loading wire:target="pay" class="text-center"/>

    @php
        $allowed = \App\Helpers\Kpay::hasPaid();
    @endphp

    @if($allowed)
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="listing_sidebar dn db-lg">
                        <div class="sidebar_content_details style3">
                            <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                            <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
                                <div class="siderbar_widget_header">
                                    <h4 class="title mb0">Find Your New Home<a class="filter_closed_btn float-right" href="#"><small>x</small><span class="flaticon-close"></span></a></h4>
                                </div>
                                <div class="sidebar_advanced_search_widget">
                                    <ul class="sasw_list mb0">
                                        <li class="search_area">
                                            <div class="form-group">
                                                <input type="text" class="form-control form_control" placeholder="Enter Keyword" wire:model="test">
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
                            Our listed properties
                        </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{route('home')}}>Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Properties Listing
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="dn db-lg mb30-md text-center">
                        <div id="main2"><a id="open2" class="filter_open_btn btn-thm" href="#">Show Filter <span class="flaticon-setting-lines ml10"></span></a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3">
                    <div class="sidebar_listing_grid1 mb30">
                        <div class="sidebar_listing_list">
                            <div class="sidebar_advanced_search_widget">
                                <ul class="sasw_list mb0">
                                    <li><h4 class="mb0">Find by location</h4></li>

                                    <li class="search_area">
                                        <div class="form-group">
                                            <select wire:model="selectedProvince" class="select2  " id="province" name="state" style="width: 100%">
                                                <option value="" selected disabled>Select Province</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{$province->id}}">{{$province->province_name}}</option>

                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <select wire:model="selectedDistrict" class="select2  " id="district" name="district" style="width: 100%">
                                                <option value="" selected disabled>Select District</option>
                                                @foreach($districts as $district)
                                                    <option value="{{$district->id}}">{{$district->district_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select wire:model="selectedSector" class="select2  " id="sector" name="sector" style="width: 100%">
                                                <option value="" selected disabled>Select Sector</option>
                                                @foreach($sectors as $sector)
                                                    <option value="{{$sector->id}}">{{$sector->sector_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select wire:model="selectedCell" class="select2  " id="cell" name="cell" style="width: 100%">
                                                <option value="" selected disabled>Select Cell</option>
                                                @foreach($cells as $cell)
                                                    <option value="{{$cell->id}}">{{$cell->cell_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-9">

                    <div class="row">
                        @forelse($houses as $house)
                            <div class="col-lg-6 col-xl-4">
                                <div class="feat_property">
                                    <div class="thumb">
                                        <a href="{{route('houses.show', $house->slug)}}">
                                            <img class="img-whp" src="{{asset('storage/'.$house->image)}}" alt="fp1.jpg">
                                        </a>
                                        <div class="thmb_cntnt">
                                            <ul class="tag mb0">
                                                <li class="list-inline-item"><a href="#">
                                                        {{$house->type}}
                                                    </a></li>
                                            </ul>
                                            <ul class="tag2 mb0">
                                                <li class="list-inline-item"><a href="#">
                                                        {{$house->province_name}}
                                                    </a></li>
                                            </ul>
                                        </div>
                                        <div class="thmb_cntnt2">
                                            {{--                                        <ul class="listing_gallery mb0">--}}
                                            {{--                                            <li class="list-inline-item"><a class="text-white" href="#"><span class="flaticon-photo-camera mr5"></span> 22</a></li>--}}
                                            {{--                                            <li class="list-inline-item"><a class="text-white" href="#"><span class="flaticon-play-button mr5"></span> 3</a></li>--}}
                                            {{--                                        </ul>--}}
                                        </div>
                                    </div>
                                    <div class="details">
                                        <div class="tc_content">

                                            <h4><a href="{{route('houses.show', $house->slug)}}">
                                                    {{$house->title}}
                                                </a></h4>
                                            <p>
                                                {{$house->district_name}} | {{$house->province_name}}
                                            </p>
                                            <ul class="prop_details mb0">
                                                <li class="list-inline-item"><a href="#"><span class="flaticon-bed"></span>
                                                        <br>
                                                        {{$house->bedrooms}}
                                                        Beds</a></li>
                                                <li class="list-inline-item"><a href="#"><span class="flaticon-bath"></span>
                                                        <br>
                                                        {{$house->bathrooms}}
                                                        Bath</a></li>
                                                <li class="list-inline-item"><a href="#"><span
                                                            class="flaticon-ruler"></span> <br>
                                                        {{$house->sqm}}
                                                        Sq Ft</a></li>
                                            </ul>
                                        </div>
                                        <div class="fp_footer">
                                            <ul class="fp_meta float-left mb0">
                                                <li class="list-inline-item">
                                                    <a href="#">

                                                    <span class="heading-color fw600">
                                                        {{number_format($house->price)}} RWF
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="fp_meta float-right mb0">
                                                <a class="btn btn-sm btn-outline-primary" href="{{route('houses.show', $house->slug)}}">
                                                    View Details
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-not-found/>
                        @endforelse


                        <div class="col-lg-12">
                            {{$houses->links('vendor.pagination.new')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <x-client-pay/>
    @endif

    <br><br>
    <hr>









</section>


@push('scripts')

    <script>
        $('#province').on('change', function (e) {
            let dt = $(this).val()
            @this.set('selectedProvince', dt);
            livewire.emit('getDistricts');
            console.log(dt);
        });

        $('#district').on('change', function (e) {
            let dt = $(this).val()
            @this.set('selectedDistrict', dt);
            livewire.emit('getSectors');
            console.log(dt);
        });

        $('#sector').on('change', function (e) {
            let dt = $(this).val()
            @this.set('selectedSector', dt);
            livewire.emit('getCells');
            console.log(dt);
        });
    </script>
@endpush

