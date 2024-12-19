<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Payment\MercadoPagoPayment;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController extends Controller
{
    public function show()
    {
        $games = Game::whereIn('id', [1,3])->get();

        $items = [];
        foreach($games as $game) {
            $items[] = [
                'id' => $game->id,
                'title' => $game->title,
                'unit_price' => $game->price,
                'quantity' => 1,
                'currency_id' => 'ARS',
            ];
        }

        try {
            MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

            $preferenceFactory = new PreferenceClient();

            $preference = $preferenceFactory->create([
                'items' => $items,
                'back_urls' => [
                    'success' => route('test.mercadopago.successProcess'),
                    'pending' => route('test.mercadopago.pendingProcess'),
                    'failure' => route('test.mercadopago.failureProcess'),
                ],
                'auto_return' => 'approved',
            ]);
        } catch(\Throwable $e) {
            dd($e);
        }

        return view('test.mercadopago', [
            'games' => $games,
            'preference' => $preference,
            'mpPublicKey' => config('mercadopago.public_key')
        ]);
    }

    public function showV2()
    {

        $games = Game::whereIn('id', [1, 3])->get();

        $items = [];

        foreach($games as $game) {
            $items[] = [
                'id' => $game->id,
                'title' => $game->title,
                'unit_price' => $game->price,
                'quantity' => 1,
            ];
        }

        try {
            $payment = new MercadoPagoPayment;
            $payment->setItems($items);
            $payment->setBackUrls(
                success: route('test.mercadopago.successProcess'),
                pending: route('test.mercadopago.pendingProcess'),
                failure: route('test.mercadopago.failureProcess'),
            );
            $payment->withAutoReturn();

            $preference = $payment->createPreference();
        } catch(\Throwable $e) {
            dd($e);
        }

        return view('test.mercadopago', [
            'games' => $games,
            'preference' => $preference,
            'mpPublicKey' => $payment->getPublicKey(),
        ]);


    }

    public function successProcess(Request $request)
    {
        dd($request->query);
    }

    public function pendingProcess(Request $request)
    {
        dd($request->query);
    }

    public function failureProcess(Request $request)
    {
        dd($request->query);
    }
}
