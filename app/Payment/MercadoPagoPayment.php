<?php

namespace App\Payment;

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Preference\MercadoPagoConfig;
use MercadoPago\Client\Preference\Preference;
use MercadoPago\Client\Preference\UidProcessor;

class MercadoPagoPayment
{

    private string $accessToken;
    private string $publicKey;
    private array $items = [];
    private array $backUrls = [];
    private bool $autoReturn = false;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->accessToken = config('mercadopago.access_token');
        $this->publicKey = config('mercadopago.public_key');

        if(strlen($this->accessToken) === 0 ) throw new \Exception('No esta definido el token de acceso de Mercado Pago. Creá la clave MERCADOPAGO_ACCESS_TOKEN en tu archivo [.env].');
        if(strlen($this->publicKey) === 0) throw new \Exception('No esta definida la clave pública de Mercado Pago. Creá la clave MERCADOPAGO_PUBLIC_KEY en tu archivo [.env].');

        MercadoPagoConfig::setAccessToken($this->accessToken);
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

    public function setBackUrls(?string $success = null, ?string $pending = null, ?string $failure = null)
    {
        if(is_string($success)) $this->backUrls['success'] = $success;
        if(is_string($pending)) $this->backUrls['pending'] = $pending;
        if(is_string($failure)) $this->backUrls['failure'] = $failure;
    }

    public function createPreference(): Preference
    {
        if(count($this->items) === 0) throw new \Exception('No se han definido los items de la compra. Usá el método setItems() para definir los items de la compra.');

        $config = [
            'items' => $this->items,
        ];
        if(count($this->backUrls) > 0) $config['back_urls'] = $this->backUrls;
        if($this->autoReturn) $config['auto_return'] = 'approved';

        $preferenceFactory = new PreferenceClient();
        return $preferenceFactory->create($config);
    }
}
