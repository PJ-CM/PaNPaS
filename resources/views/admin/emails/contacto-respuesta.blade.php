<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'PaNPaS') }} :: Respuesta de Contacto</title>
</head>
<body>
    Hello <i>{{ $objResponseData->to_nombre }}</i>,
    <p>Te respondemos a tu consulta efectuada el [ {{ $objResponseData->to_fecha }} ].</p>

    <p><u>Respuesta:</u></p>

    <div>
        <p>
            {{ $objResponseData->respuesta }}
        <p>
    </div>

    Gracias,
    <br/>
    <i>{{ $objResponseData->from_nombre }}</i>
</body>
</html>
