<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Member</title>
</head>
<body>
    <table width="100%">
        <tr>
            @foreach ($dataMember as $key => $member )

            <tr>
                @foreach ($member as $item )
                    <td>
                        <div class="box">
                            <img src="" alt="card">
                            <div class="logo">
                                <p>POS APP</p>
                                <img src="" alt="logo">
                            </div>
                            <div class="nama">{{ $item->nama_member }}</div>
                            <div class="nama">{{ $item->telpon }}</div>
                            <div class="barcode">
                                <img src="data:image/png;base64,
                                {{DNS2D::getBarcodePNG($item->kode_member, 'QRCODE')}}"
                                alt="qrcode"
                                width="60" height="60"   />
                            </div>
                        </div>
                    </td>
                @endforeach
            </tr>
                {{-- <td style="text-align: center; border:1px solid">
                    <p>{{$member->nama_member}}-{{format_idr($member->harga_jual)}}</p>
                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($member->kode_member, 'C39+')}}" alt="{{$member->kode_member}}"
                    width="180" height="60"   />
                    <br>
                    {{$member->kode_member}}
                </td>
                @if ($no++ % 3 == 0)
                    <tr></tr>
                @endif --}}
            @endforeach
        </tr>
    </table>
</body>
</html>
