<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\AccountDetails;
use App\ApiToken;
use App\TransactionData;

class AccountController extends Controller
{
    public function addAccount(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), 
            $rules = [
                'account_number' => 'required|unique:account_details,account_number',
                'deposit_amount' => 'required',
                'api_token' => 'required'
            ]
        );

        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $checkToken = ApiToken::where('token', $request->api_token)->first();
        if(!$checkToken)
        {
        	return response()->json([
                'status' => false,
                'message' => "Please check your token"
            ]);
        }

        $checkAccount = AccountDetails::where('account_number', $request->account_number)->first();
    	if($checkAccount)
    	{
    		return response()->json([
                'status' => false,
                'message' => "Already we have this account try another one"
            ]);
        }

        $addAccount = AccountDetails::create([
            'account_number' => $request->account_number,
            'balance' => $request->deposit_amount,
            'user_id' => $checkToken->user_id,
        ]);
        if($addAccount)
        {
            $token = Str::random(50);
            $updateToken = ApiToken::where('user_id', $checkToken->id)->first();
            if($updateToken)
            {
                $updateToken = ApiToken::where('user_id', $checkToken->id)->update(['token'=>$token]);
            }
            else
            {
                $updateToken = ApiToken::create([
                    'user_id' => $checkToken->id,
                    'token' => $token
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => "Account Details Added",
                'data' => $addAccount,
                'api_token' => $token
            ]);
        }
    }

    public function checkAccount(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), 
            $rules = [
                'account_number' => 'required',
                'api_token' => 'required'
            ]
        );

        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $checkToken = ApiToken::where('token', $request->api_token)->first();
        if(!$checkToken)
        {
        	return response()->json([
                'status' => false,
                'message' => "Please check your token"
            ]);
        }

        $checkAccount = AccountDetails::where('account_number', $request->account_number)->first();
    	if(!$checkAccount)
    	{
    		return response()->json([
                'status' => false,
                'message' => "Already we have this account try another one"
            ]);
        }
        $checkUserAccount = AccountDetails::where('user_id', $checkToken->user_id)->where('account_number', $request->account_number)->first();
        if(!$checkUserAccount)
        {
        	return response()->json([
                'status' => false,
                'message' => "You dont have access of this account"
            ]);
        }


        $transactionDetails = TransactionData::where('account_from', $request->account_number)->orWhere('account_to', $request->account_number)->get();

        $token = Str::random(50);
        $updateToken = ApiToken::where('user_id', $checkToken->id)->first();
        if($updateToken)
        {
        	$updateToken = ApiToken::where('user_id', $checkToken->id)->update(['token'=>$token]);
        }
        else
        {
        	$updateToken = ApiToken::create([
                'user_id' => $checkToken->id,
                'token' => $token
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "These are Account Details",
            'data' => $checkAccount,
            'transaction_details' => isset($transactionDetails)?$transactionDetails:null,
            'api_token' => $token
        ]);
    }

    public function createTransaction(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), 
            $rules = [
                'account_from' => 'required',
                'account_to' => 'required',
                'amount' => 'required',
                'api_token' => 'required'
            ]
        );

        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $checkToken = ApiToken::where('token', $request->api_token)->first();
        if(!$checkToken)
        {
        	return response()->json([
                'status' => false,
                'message' => "Please check your token"
            ]);
        }

        $checkFromAccount = AccountDetails::where('account_number', $request->account_from)->first();
    	if(!$checkFromAccount)
    	{
    		return response()->json([
                'status' => false,
                'message' => "Please Check the Sender Account details"
            ]);
        }

        $checkUserAccount = AccountDetails::where('user_id', $checkToken->user_id)->where('account_number', $request->account_from)->first();
        if(!$checkUserAccount)
        {
        	return response()->json([
                'status' => false,
                'message' => "Check Your account and try"
            ]);
        }

        $checkBalanceAccount = AccountDetails::where('account_number', $request->account_from)->where('balance', '>=', $request->amount)->first();
        if(!$checkBalanceAccount)
    	{
    		return response()->json([
                'status' => false,
                'message' => "Insuffecient Balance"
            ]);
        }
        else
        {
        	$balance = $checkBalanceAccount->balance - $request->amount;
        	$checkBalanceAccount = AccountDetails::where('account_number', $request->account_from)
        		->where('balance', '>=', $request->amount)
        		->update([
        			'balance' => $balance
        		]);
        	$checkFromAccount = AccountDetails::where('account_number', $request->account_from)->first();
        }

        $checkToAccount = AccountDetails::where('account_number', $request->account_to)->first();
        if(!$checkToAccount)
    	{
    		return response()->json([
                'status' => false,
                'message' => "Please Check the Recepited Account details"
            ]);
        }

        $addTransaction = TransactionData::create([
            'account_from' => $request->account_from,
            'account_to' => $request->account_to,
            'transaction_amount' => $request->amount,
            'transaction_notes' => $request->notes,
        ]);
        $addBalance = $checkToAccount->balance + $request->amount;
        $checkBalanceAccount = AccountDetails::where('account_number', $request->account_to)
        	->update([
        		'balance' => $addBalance
        	]);
        $checkToAccount = AccountDetails::where('account_number', $request->account_to)->first();

    	$transactionDetails = TransactionData::where('account_from', $request->account_from)->orWhere('account_to', $request->account_from)->get();

        $token = Str::random(50);
        $updateToken = ApiToken::where('user_id', $checkToken->id)->first();
        if($updateToken)
        {
            $updateToken = ApiToken::where('user_id', $checkToken->id)->update(['token'=>$token]);
        }
        else
        {
            $updateToken = ApiToken::create([
                'user_id' => $checkToken->id,
                'token' => $token
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "Transaction Added",
            'data' => $checkFromAccount,
            'last_transaction' => $addTransaction,
            'last_transaction_status' => "Debeted",
            'transaction_details' => $transactionDetails,
            'api_token' => $token
        ]);
    }

    public function myAccounts(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), 
            $rules = [
                'api_token' => 'required'
            ]
        );

        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $checkToken = ApiToken::where('token', $request->api_token)->first();
        if(!$checkToken)
        {
        	return response()->json([
                'status' => false,
                'message' => "Please check your token"
            ]);
        }

        $checkAccount = AccountDetails::where('user_id', $checkToken->user_id)->get();

        $token = Str::random(50);
        $updateToken = ApiToken::where('user_id', $checkToken->id)->first();
        if($updateToken)
        {
        	$updateToken = ApiToken::where('user_id', $checkToken->id)->update(['token'=>$token]);
        }
        else
        {
        	$updateToken = ApiToken::create([
                'user_id' => $checkToken->id,
                'token' => $token
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "These are Account Details",
            'data' => isset($checkAccount) ? $checkAccount : null,
            'api_token' => $token
        ]);
    }
}
