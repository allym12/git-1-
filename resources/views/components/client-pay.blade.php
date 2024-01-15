<div class="container">

    <div class="row m-5 mr-auto">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="col-lg-8 h-100 d-flex align-items-center justify-content-center">
                    <div class="form_grid mt100">
                        <div class="text-center">
                            <h2 class="text-center ">To view other items, you will need to pay {{config('payouts.viewing_cost')}} RWF</h2>
                            <span class="text-center mb50">Refresh this page after successful payment</span>
                        </div>

                        <h1>
                            {{--                                {{auth()->user()->isAllowedToView() ? 'allowed' : 'not allowed'}}--}}
                        </h1>
                        <form class="mt-5 contact_form h-100 d-flex align-items-center justify-content-center paymentForm" id="paymentForm"
                                  autocomplete="off">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="phone" type="number" class="form-control" required="required" placeholder="Format: 07XXXXXXXX" pattern="[0-9]{10}" id="phoneNumberInput" min="10">
                                            @error('phone')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb0">
                                        <button type="button"
                                                class="btn btn-thm" id="buttondPay" onclick="initiatePayment()" >CONFIRM PAYMENT</button>
                                    </div>

                                    <!-- Loader element -->
                                    <div class="form-group mb0" style="display:none;" id="paymentLoader"> 
                                        <img src="/spinner/ajax-loader.gif" width="50"/>
                                        <span class="text-info">Check the message on your phone, or dial *182*7*1# to pay</span>
                                    </div>

                                </div>

                                <hr>
                            </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
