<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas</title>
    <link rel="stylesheet" href="{{ asset('css/kelas/index.css') }}">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Manajemen Kelas</h1>
            <p>Sistem pengelolaan data kelas</p>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="total-count">
                <div class="number">{{ $totalkelas }}</div>
                <div class="label">Total Kelas</div>
            </div>

            <form action="/cari" method="get" class="search-box">
                @csrf
                <input type="text" name="kolomcari" id="kolomcari" placeholder="Cari kelas...">
                <button type="submit" class="search-btn">Cari</button>
            </form>
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <form action="{{ route('kelas.create') }}" method="GET">
                <button type="submit" class="add-btn">+ Tambah Kelas Baru</button>
            </form>
        </div>

        <!-- Table -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Ketua Kelas</th>
                        <th>Kursi</th>
                        <th>Meja</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($kelas->isEmpty())
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="icon">📁</div>
                                    <h3>Belum Ada Data</h3>
                                    <p>Mulai dengan menambahkan kelas pertama</p>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach($kelas as $kls)
                        <tr>
                            <td class="class-id">{{ $kls['id_kelas'] }}</td>
                            <td>
                                <div class="class-name">{{ $kls['namakelas'] }}</div>
                            </td>
                            <td>{{ $kls['walikelas'] }}</td>
                            <td>{{ $kls['ketuakelas'] }}</td>
                            <td>{{ $kls['kursi'] }}</td>
                            <td>{{ $kls['meja'] }}</td>
                            <td class="photo-cell">
                                <a href="{{ asset('upload_gambar') . '/' . $kls->gambar_kelas }}" target="_blank">
                                    <img src="{{ asset('upload_gambar') . '/' . $kls->gambar_kelas }}"
                                         alt="Foto Kelas"
                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIGZpbGw9IiNlMmU4ZjAiIHJ4PSI2Ij48L3JlY3Q+PHBhdGggZD0iTTMwIDM1QzMzLjMxMzcgMzUgMzYgMzIuMzEzNyAzNiAyOUMzNiAyNS42ODYzIDMzLjMxMzcgMjMgMzAgMjNDMjYuNjg2MyAyMyAyNCAyNS42ODYzIDI0IDI5QzI0IDMyLjMxMzcgMjYuNjg2MyAzNSAzMCAzNVoiIGZpbGw9IiM5NGEzYjgiPjwvcGF0aD48cGF0aCBkPSJNMzAgMzcuNUMyMi41NDA5IDM3LjUgMTYuNSAzMy44MTAzIDE2LjUgMjlDMTYuNSAyNC4xODk3IDIyLjU0MDkgMjAuNSAzMCAyMC41QzM3LjQ1OTEgMjAuNSA0My41IDI0LjE4OTcgNDMuNSAyOUM0My41IDMzLjgxMDMgMzcuNDU5MSAzNy41IDMwIDM3LjVaIiBmaWxsPSIjZTJlOGYwIj48L3BhdGg+PC9zdmc+'">
                                </a>
                            </td>
                            <td>
                                <div class="actions">
                                    <form action="/kelas/{{ $kls['id_kelas'] }}/edit">
                                        @csrf
                                        <button type="submit" class="action-btn edit-btn">Edit</button>
                                    </form>
                                    <form action="/kelas/{{ $kls->id_kelas }}" method="post"
                                          onsubmit="return confirm('Hapus kelas {{ $kls['namakelas'] }}?')">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="action-btn delete-btn">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© {{ date('Y') }} Manajemen Kelas • Menampilkan {{ $kelas->count() }} data</p>
        </div>
    </div>

    <script>
        // Simple confirmation for delete
        document.addEventListener('DOMContentLoaded', function() {
            // Delete confirmation
            const deleteForms = document.querySelectorAll('form[method="post"]');
            deleteForms.forEach(form => {
                if (form.querySelector('.delete-btn')) {
                    form.addEventListener('submit', function(e) {
                        if (!confirm('Yakin ingin menghapus data ini?')) {
                            e.preventDefault();
                        }
                    });
                }
            });

            // Table row hover effect
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8fafc';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
        });
    </script>
</body>
</html>
