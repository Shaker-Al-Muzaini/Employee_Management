<?php

namespace App\Http\Controllers\Payment;

use  App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


    public function pay($serviceId)
{
    try {
        DB::beginTransaction();
        $post = Post::find($serviceId);
        $paylink = Client::find(auth()->guard('client')->id())->charge($post->price, $post->content);
        $workerCash = WorkerCash::create([
            "post_id" => $post->id,
            "client_id" => auth()->guard('client')->id(),
            "total" => $post->price,
        ]);
        DB::commit();
        return response()->json([
            "payLink" => $paylink
        ]);
    } catch (Exception $e) {
        DB::rollBack();
        return response()->json([
            $e->getMessage()
        ]);
    }
}

}
