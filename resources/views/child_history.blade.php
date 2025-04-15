<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat {{ $child->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            padding: 15px 20px;
        }
        .card-body {
            padding: 20px;
        }
        .info-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .info-col {
            flex: 0 0 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
            padding: 0 10px;
            margin-bottom: 20px;
        }
        .info-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            height: 100%;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .info-card h5 {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #007bff;
        }
        .info-card p {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        @media (max-width: 767px) {
            .info-col {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }

        @media (min-width: 576px) {
            .modal-dialog-centered {
                min-height: calc(100% - 3.5rem);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
    <div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            
            <h1 class="d-inline-block mb-0">Riwayat {{ $child->nama }}</h1>
        </div>
        <button id="download-btn" class="btn btn-primary">
            <i class="fas fa-download me-2"></i>Download
        </button>
    </div>
    <!--buat tampilan list jadi wrap -->
    <div class="flex-wrap">
    @foreach($histories as $history)
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-light" role="button" onclick="toggleHistory({{ $history->id }})">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar me-2 text-muted"></i>
                        {{ \Carbon\Carbon::parse($history->tanggal)->format('d/m/Y') }}
                    </h5>
                    <i class="fas fa-chevron-down text-muted" id="toggle-icon-{{ $history->id }}"></i>
                </div>
            </div>
            <div class="card-body collapse" id="history-{{ $history->id }}">
                <div class="row g-3">
                    @php
                        $infoSections = [
                            ['icon' => 'utensils', 'title' => 'Makan', 'times' => ['Pagi', 'Siang', 'Sore'], 'field' => 'makan'],
                            ['icon' => 'bottle-water', 'title' => 'Susu', 'times' => ['Pagi', 'Siang', 'Sore'], 'field' => 'susu', 'unit' => 'ml'],
                            ['icon' => 'tint', 'title' => 'Air Putih', 'times' => ['Pagi', 'Siang', 'Sore'], 'field' => 'air_putih', 'unit' => 'ml'],
                            ['icon' => 'toilet', 'title' => 'BAK', 'times' => ['Pagi', 'Siang', 'Sore'], 'field' => 'bak', 'unit' => 'X'],
                            ['icon' => 'poop', 'title' => 'BAB', 'times' => ['Pagi', 'Siang', 'Sore'], 'field' => 'bab', 'unit' => 'X'],
                            ['icon' => 'bed', 'title' => 'Tidur', 'times' => ['Pagi', 'Siang', 'Sore'], 'field' => 'tidur', 'unit' => 'X']
                        ];
                    @endphp

                    @foreach($infoSections as $section)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-{{ $section['icon'] }} me-2 text-primary"></i>{{ $section['title'] }}
                                    </h5>
                                    @foreach($section['times'] as $time)
                                        <p class="mb-1">
                                            <small>
                                                @php
                                                    $fieldName = strtolower($section['field'] . '_' . strtolower($time));
                                                    $value = $history->$fieldName ?? '-';
                                                    $value .= isset($section['unit']) ? ' ' . $section['unit'] : '';
                                                @endphp
                                                <i class="fas fa-{{ $time == 'Pagi' ? 'sun text-warning' : ($time == 'Siang' ? 'cloud-sun text-primary' : 'moon text-info') }} me-2"></i>
                                                {{ $time }}: {{ $value }}
                                            </small>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-6">
                        <div class="card h-100 border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-home me-2 text-primary"></i>Kegiatan Indoor
                                </h5>
                                @php
                                    $kegiatanIndoor = json_decode($history->kegiatan_indoor, true) ?? [];
                                @endphp
                                @if(count($kegiatanIndoor) > 0)
                                    <ul class="list-unstyled mb-0">
                                        @foreach($kegiatanIndoor as $item)
                                            <li><i class="fas fa-circle me-2 text-muted" style="font-size: 0.5rem;"></i>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">Tidak ada kegiatan indoor</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-running me-2 text-primary"></i>Kegiatan Outdoor
                                </h5>
                                @php
                                    $kegiatanOutdoor = json_decode($history->kegiatan_outdoor, true) ?? [];
                                @endphp
                                @if(count($kegiatanOutdoor) > 0)
                                    <ul class="list-unstyled mb-0">
                                        @foreach($kegiatanOutdoor as $item)
                                            <li><i class="fas fa-circle me-2 text-muted" style="font-size: 0.5rem;"></i>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">Tidak ada kegiatan outdoor</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-heartbeat me-2 text-primary"></i>Kondisi
                                </h5>
                                @if($history->kondisi)
                                    <span class="badge {{ $history->kondisi === 'sehat' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($history->kondisi) }}
                                    </span>
                                @else
                                    <span class="text-muted">Belum diisi</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-pills me-2 text-primary"></i>Obat
                                </h5>
                                @foreach(['Pagi', 'Siang', 'Sore'] as $time)
                                    <p class="mb-1">
                                        <small>
                                            <i class="fas fa-{{ $time == 'Pagi' ? 'sun text-warning' : ($time == 'Siang' ? 'cloud-sun text-primary' : 'moon text-info') }} me-2"></i>
                                            {{ $time }}: {{ $history->{'obat_' . strtolower($time)} ?? 'Tidak ada' }}
                                        </small>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-cookie-bite me-2 text-primary"></i>Makanan & Camilan
                                </h5>
                                @foreach(['Pagi', 'Siang', 'Sore'] as $time)
                                    <p class="mb-1">
                                        <small>
                                            <i class="fas fa-{{ $time == 'Pagi' ? 'sun text-warning' : ($time == 'Siang' ? 'cloud-sun text-primary' : 'moon text-info') }} me-2"></i>
                                            {{ $time }}:
                                        </small>
                                    </p>
                                    @php
    $makananCamilanString = $history->{'makanan_camilan_' . strtolower($time)} ?? '';
    $makananCamilan = array_filter(array_map('trim', explode(',', $makananCamilanString)));
@endphp

                                    @if(is_array($makananCamilan) || $makananCamilan instanceof \Countable)
    @if(count($makananCamilan) > 0)
        <ul class="list-unstyled mb-0">
            @foreach($makananCamilan as $item)
                <li><i class="fas fa-circle me-2 text-muted" style="font-size: 0.5rem;"></i>{{ $item }}</li>
            @endforeach
        </ul>
    @else
        <p class="text-muted mb-0">Tidak ada</p>
    @endif
@else
    <p class="text-danger">Data makananCamilan tidak bisa dihitung</p>
@endif

                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-comment me-2 text-primary"></i>Keterangan
                                </h5>
                                <p class="text-muted">{{ $history->keterangan ?? 'Tidak ada' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
                    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $histories->links('pagination::bootstrap-4') }}
    </div>
</div>


        <div class="d-flex justify-content-center mt-4">
            {{ $histories->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="errorToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Terjadi kesalahan saat mengunduh Excel.
            </div>
        </div>
    </div>

    <div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateRangeModalLabel">Download Excel</h5>
                </div>
                <div class="modal-body">
                    <p>Pilih rentang tanggal yang ingin di download</p>
                    <input type="text" id="daterange" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="apply-daterange">Download</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        function toggleHistory(id) {
            var content = document.getElementById('history-' + id);
            var icon = document.getElementById('toggle-icon-' + id);
            content.classList.toggle('show');
            icon.classList.toggle('fa-chevron-up');
            icon.classList.toggle('fa-chevron-down');
        }

        $(document).ready(function() {
            $('#download-btn').on('click', function() {
                $('#dateRangeModal').modal('show');
            });

            var dateRangeModal = new bootstrap.Modal(document.getElementById('dateRangeModal'));

            $('#dateRangeModal').on('shown.bs.modal', function() {
                $('#daterange').daterangepicker({
                    opens: 'left',
                    locale: {
                        format: 'DD-MM-YYYY'
                    }
                });
            });

            $('#apply-daterange').on('click', function() {
                var dateRange = $('#daterange').val();
                var childId = {{ $child->id }};
                var childName = "{{ $child->nama }}";

                $.ajax({
                    url: '{{ route('children.downloadExcel', ['id' => $child->id]) }}',
                    type: 'POST',
                    data: {
                        daterange: dateRange,
                        _token: '{{ csrf_token() }}'
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        var blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = 'Riwayat ' + childName + '.xlsx';
                        link.click();
                        dateRangeModal.hide();
                    },
                    error: function() {
                        // Ganti alert dengan Toast
                        var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
                        errorToast.show();
                    }
                });
            });
        });
    </script>
</body>
</html>
