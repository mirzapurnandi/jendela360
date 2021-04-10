@component('mail::message')
# {{ $title }}

## Terimakasih atas pembelian Mobilnya!

## Detail Pembelian

Nama: {{ $result->nama }}

No HP: {{ $result->no_hp }}

Mobil: {{ $result->car->nama }}

Harga: @currency($result->car->harga)

<br><br>Thanks,<br>
{{ $result->nama }}
@endcomponent
