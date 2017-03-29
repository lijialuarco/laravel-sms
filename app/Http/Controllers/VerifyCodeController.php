<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toplan\Sms\Facades\SmsManager;

class VerifyCodeController extends Controller
{
    public function show()
    {
        return view('verify-code', ['status' => false]);
    }

    public function validatorForPost(Request $request)
    {
        //验证数据
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|confirm_mobile_not_change|confirm_rule:mobile_required',
            'verifyCode' => 'required|verify_code',
            //more...
        ], [
            'mobile.required'                  => '你别删手机号啊',
            'mobile.confirm_mobile_not_change' => '你别变手机号啊',
            'verifyCode.required'              => '你要填验证码啊',
            'verifyCode.verify_code'           => '你填对验证码啊',
        ]);
        if ($validator->fails()) {
            //验证失败后建议清空存储的发送状态，防止用户重复试错
            SmsManager::forgetState();
            return redirect()->back()->withErrors($validator);
        }

        return view('verify-code', ['status' => true]);
    }
}
