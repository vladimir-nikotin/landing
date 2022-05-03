<?php

namespace Vladi\Landing\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Vladi\Landing\Facades\JsonRpcClient;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowActivityController extends Controller
{
    public function handle()
    {
        $validator = Validator::make($params, [
            'page' => 'nullable|integer|gt:0',
        ]);

        if ($validator->fails()) {
            throw new Exception('Invalid params');
        }

        $dataPage = JsonRpcClient::send('get', [
            'perPage' => config('activitylog.perPay'),
            'page' => request()->input('page'),
        ]);

        $paginator = new LengthAwarePaginator(
            $dataPage['result']['data'],
            $dataPage['result']['total'],
            5,
            request()->input('page'),
            ['path' => request()->url()]
        );

        return view('activitylog::activity', [
            'activities' => $paginator,
        ]);
    }
}
