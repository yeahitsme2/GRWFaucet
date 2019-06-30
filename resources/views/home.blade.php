@extends('layouts.app')

@push('css-override')
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .g-recaptcha {
            /* display: inline-block; */
        }
    </style>
@endpush

@section('content')
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title m-b-md">
                Faucet balance: <br /><strong>{{ $faucetBalance }} {{ config('faucet.ticker') }}</strong>
            </div>
            <div class="col-md-8">
                <div class="mb-5">
                    Send some {{ config('faucet.ticker') }} here: <span class="font-weight-bold">{{ config('faucet.faucetAddress') }}</span> to keep this faucet running.
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        @if(is_array(session()->get('success')))
                        <ul class="text-left">
                            @foreach (session()->get('success') as $message)
                                <li>{!! $message !!}</li>
                            @endforeach
                        </ul>
                        @else
                            {!! session()->get('success') !!}
                        @endif
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        @if(is_array(session()->get('error')))
                        <ul class="text-left">
                            @foreach (session()->get('error') as $message)
                                <li>{!! $message !!}</li>
                            @endforeach
                        </ul>
                        @else
                            {!! session()->get('error') !!}
                        @endif
                    </div>
                @endif
                <div class="card">
                    <div class="card-header"><h2>Join our community by claiming some {{ config('faucet.ticker') }}!</h2></div>

                    <div class="card-body">
                        <h3>Enter your address and start claiming!</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="text-left">
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('ask') }}" method="POST">
                          <div class="form-group">
                            <label>{{ config('faucet.coinName') }} address</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fa fa-chevron-right"></i>
                                </div>
                              </div>
                              <input id="grw-address" name="grwaddress" placeholder="Enter your {{ config('faucet.coinName') }} address" type="text" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="g-recaptcha flex-center" data-sitekey="{{ config('faucet.recaptchaSiteKey') }}"></div>
                            <button name="submit" type="submit" class="btn btn-primary">Ask</button>
                          </div>
                          @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
