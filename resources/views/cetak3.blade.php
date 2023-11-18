<!DOCTYPE html>

    <head>
        <meta charset="utf-8" />
		<title>Cetak Nota</title>
        <style>
                table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
        </style>
    </head>

    <body>
    <h2>Nota penjualan barang</h2>

<table>
  <tr>
    <th>Tanggal transaksi</th>
    <th>Barang</th>
    <th>Jumlah</th>
    <th>Total</th>
    <th>Customer</th>
  </tr>
  @foreach($jual as $note)
  <tr>
    <td>{{$note->tanggal_transaksi}}</td>
    <td>{{$note->barang}}</td>
    <td>{{$note->jumlah}}</td>
    <td>{{$note->total_harga}}</td>
    <td>{{$note->customer}}</td>
  </tr>
  @endforeach
</table>
    </body>
</html>
