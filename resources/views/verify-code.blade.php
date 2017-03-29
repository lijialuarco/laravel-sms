@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Test VerifyCode</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('verify-code') }}">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label">Phone number</label>

                                <div class="col-md-4">
                                    <input id="mobile" type="text" class="form-control" name="mobile"
                                           value="{{ old('mobile') }}" required>

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <button type="button" class="btn btn-warning col-md-2"
                                        id="sendVerifySmsButton">Get verifyCode
                                </button>
                            </div>

                            <div class="form-group">

                            </div>

                            <div class="form-group {{ $errors->has('verifyCode') ? ' has-error' : '' }}">
                                <label for="verifyCode" class="col-md-4 control-label">Verify Code</label>

                                <div class="col-md-4">
                                    <input id="verifyCode" type="text" class="form-control" name="verifyCode"
                                           value="{{ old('verifyCode') }}" required>

                                    @if ($errors->has('verifyCode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('verifyCode') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>

                            @if($status)
                                <div class="form-group">
                                    <label for="result" class="col-md-4 col-md-offset-4 control-label" >
                                        <span style="color: salmon">success</span></label>
                                </div>
                            @endif


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/vendor/jquery.min.js"></script>
    <script src="/js/laravel-sms.js"></script>
    <script>
        $('#sendVerifySmsButton').sms({
            //laravel csrf token
            token: "{{csrf_token()}}",
            //请求间隔时间
            interval: 60,
            //请求参数
            requestData: {
                //手机号
                mobile: function () {
                    return $('input[name=mobile]').val();
                },
                //手机号的检测规则
                mobile_rule: 'mobile_required'
            }
        });

    </script>
@endsection