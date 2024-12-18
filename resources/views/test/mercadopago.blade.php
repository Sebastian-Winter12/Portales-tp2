@extends('layouts.main')

@section('title', 'prueba de integracion MP')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-3">Prueba de Integración con Mercado Pago</h2>
            <table class="table table-bordered table-striped mb-3">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game)
                    <tr>
                        <td>{{ $game->title }}</td>
                        <td>${{ $game->price }}</td>
                        <td>1</td>
                        <td>${{ $game->price }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><b>TOTAL:</b></td>
                        <td><b>${{ $games->sum('price') }}</b></td>
                    </tr>
                </tbody>
            </table>
            <div id="mercadopago-button"></div>

            <script src="https://sdk.mercadopago.com/js/v2"></script>
            <script>
                const mp = new MercadoPago('<?= $mpPublicKey;?>');
                mp.bricks().create('wallet', 'mercadopago-button', {
                    initialization: {
                        preferenceId: '<?= $preference->id;?>',
                    }
                });
            </script>
        </div>
    </div>
</div>

@endsection
