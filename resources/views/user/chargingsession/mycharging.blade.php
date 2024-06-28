@extends('user.layout.baselayout')
@section('title')
    My Charging Session
@endsection
@section('content')
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Mobil</th>
                    <th scope="col">Jenis Plug</th>
                    <th scope="col">Harga Charging</th>
                    <th scope="col">Remaining Baterai</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($my_charges as $key => $my_charge)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $my_charge->car->nama }}</td>
                        <td>{{ $my_charge->plug->nama }}</td>
                        <td>Rp. {{ number_format($my_charge->input_harga, 2, ',', '.') }}</td>
                        <td>{{ $my_charge->input_baterai }}%</td>
                        <td>{{ $my_charge->note ?? 'Tidak ada catatan' }}</td>
                        <td>
                            @if ($my_charge['status'] == 1)
                                Sudah Dibayar
                            @else
                                Belum Dibayar
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm detail-button" data-toggle="modal"
                                data-target="#detailModal{{ $my_charge->id }}">Detail</button>
                            <form action="{{ route('cancel', $my_charge->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                @if ($my_charge->status != 0)
                                    <button type="submit" class="btn btn-danger btn-sm">Batalkan Charging Session</button>
                                @else
                                    <button type="button" class="btn btn-sm btn-success pay-button"
                                        data-snap-token="{{ $my_charge->snap_token }}" style="width: 100px">Bayar</button>
                                    <button type="submit" class="btn btn-danger btn-sm">Batalkan Charging Session</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    <!-- Detail Modal -->
                    <div class="modal fade" id="detailModal{{ $my_charge->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="detailModalLabel{{ $my_charge->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $my_charge->id }}">Detail Charging
                                        Session</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Mobil: {{ $my_charge->car->nama }}</h5>
                                            <p class="card-text"><strong>Jenis Plug:</strong> {{ $my_charge->plug->nama }}
                                            </p>
                                            <p class="card-text"><strong>Tegangan:</strong>
                                                {{ $my_charge->voltage->voltage }}V</p>
                                            <p class="card-text"><strong>Harga Charging:</strong> Rp.
                                                {{ number_format($my_charge->input_harga, 2, ',', '.') }}</p>
                                            <p class="card-text"><strong>Remaining Baterai:</strong>
                                                {{ $my_charge->input_baterai }}%</p>
                                            <p class="card-text"><strong>Catatan:</strong>
                                                {{ $my_charge->note ?? 'Tidak ada catatan' }}</p>
                                            <p class="card-text"><strong>Status:</strong>
                                                {{ $my_charge->status == 1 ? 'Sudah Dibayar' : 'Belum Dibayar' }}</p>
                                            <p class="card-text"><strong>Total Harga Pembayaran:</strong> Rp.
                                                {{ number_format($my_charge->amount_price, 2, ',', '.') }}</p>
                                            <p class="card-text"><strong>Time Charging:</strong>
                                                {{ $my_charge->charging_time }}</p>
                                            <p class="card-text"><strong>Keterangan:</strong>
                                                @if ($my_charge->amount_price == $my_charge->input_harga)
                                                    Nominal Harga Pengisian Sudah Sesuai dengan Total Harga mencapai 100%
                                                @elseif ($my_charge->input_harga < $my_charge->amount_price)
                                                    Nominal Harga Pengisian tidak memenuhi Total Harga mencapai 100%
                                                @else
                                                    Nominal Harga Pengisian Melebihi Total Harga
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="8">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
@endsection
@push('js')
    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var payButtons = document.querySelectorAll('.pay-button');
            payButtons.forEach(function(payButton) {
                payButton.addEventListener('click', function() {
                    var snapToken = payButton.getAttribute('data-snap-token');
                    window.snap.pay(snapToken, {
                        onSuccess: function(result) {
                            alert("Payment successful!");
                            console.log(result);
                        },
                        onPending: function(result) {
                            alert("Waiting for your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            alert("Payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            alert('You closed the popup without finishing the payment');
                        }
                    });
                });
            });
        });
    </script>
@endpush
