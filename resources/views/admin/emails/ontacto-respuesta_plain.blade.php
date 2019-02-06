Hello {{ $objResponseData->to_nombre }},
Te respondemos a tu consulta efectuada el [ {{ $objResponseData->to_fecha }} ].

Respuesta:

{{ $objResponseData->respuesta }}

Gracias,
{{ $objResponseData->from_nombre }}
