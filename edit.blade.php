<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas - {{ $kelas->namakelas }}</title>
    <style>
        /* Reset dan Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Container */
        .container {
            width: 100%;
            max-width: 800px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: white;
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2d3748;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
        }

        .form-group input[readonly] {
            background: #edf2f7;
            color: #718096;
            cursor: not-allowed;
        }

        /* ID Field khusus */
        .id-field {
            grid-column: span 2;
        }

        /* Photo Upload */
        .photo-section {
            border-top: 2px solid #e2e8f0;
            padding-top: 30px;
            margin-top: 20px;
        }

        .photo-upload {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            margin-top: 20px;
        }

        .photo-preview {
            position: relative;
            cursor: pointer;
            width: 200px;
            height: 200px;
        }

        .current-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
            border: 3px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
            color: white;
            font-weight: 500;
        }

        .photo-preview:hover .current-photo {
            border-color: #667eea;
        }

        .photo-preview:hover .photo-overlay {
            opacity: 1;
        }

        .no-photo {
            width: 200px;
            height: 200px;
            background: #f7fafc;
            border: 3px dashed #cbd5e0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .no-photo:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .photo-instructions {
            flex: 1;
            padding: 15px;
            background: #f7fafc;
            border-radius: 12px;
            font-size: 14px;
            color: #4a5568;
        }

        .photo-instructions h4 {
            margin-bottom: 10px;
            color: #2d3748;
            font-weight: 600;
        }

        .photo-instructions ul {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .photo-instructions li {
            margin-bottom: 5px;
        }

        /* New Photo Preview */
        .new-photo-preview {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background: #f0fff4;
            border-radius: 8px;
            border: 1px solid #9ae6b4;
        }

        .new-photo-preview.show {
            display: block;
        }

        .new-photo-preview h5 {
            margin-bottom: 10px;
            color: #276749;
            font-weight: 600;
        }

        #preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #38a169;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e2e8f0;
        }

        .submit-btn {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .back-btn {
            flex: 1;
            background: #edf2f7;
            color: #4a5568;
            border: none;
            padding: 16px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .back-btn:hover {
            background: #e2e8f0;
        }

        /* File Input Hidden */
        .file-input {
            display: none;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .id-field {
                grid-column: span 1;
            }

            .photo-upload {
                flex-direction: column;
            }

            .photo-preview, .no-photo {
                width: 100%;
                height: 250px;
            }

            .form-actions {
                flex-direction: column;
            }

            .container {
                padding: 10px;
            }

            .form-card {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Update Data Kelas</h1>
            <p>Sistem pengelolaan data kelas</p>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form action="/kelas/{{ $kelas->id_kelas }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Form Grid -->
                <div class="form-grid">
                    <!-- ID Kelas -->
                    <div class="form-group id-field">
                        <label for="id_kelas">ID Kelas</label>
                        <input type="text"
                               name="id_kelas"
                               id="id_kelas"
                               value="{{ $kelas->id_kelas }}"
                               readonly>
                    </div>

                    <!-- Nama Kelas -->
                    <div class="form-group">
                        <label for="namakelas">Nama Kelas</label>
                        <input type="text"
                               name="namakelas"
                               id="namakelas"
                               value="{{ $kelas->namakelas }}"
                               required>
                    </div>

                    <!-- Wali Kelas -->
                    <div class="form-group">
                        <label for="walikelas">Wali Kelas</label>
                        <input type="text"
                               name="walikelas"
                               id="walikelas"
                               value="{{ $kelas->walikelas }}"
                               required>
                    </div>

                    <!-- Ketua Kelas -->
                    <div class="form-group">
                        <label for="ketuakelas">Ketua Kelas</label>
                        <input type="text"
                               name="ketuakelas"
                               id="ketuakelas"
                               value="{{ $kelas->ketuakelas }}"
                               required>
                    </div>

                    <!-- Jumlah Kursi -->
                    <div class="form-group">
                        <label for="kursi">Jumlah Kursi</label>
                        <input type="number"
                               name="kursi"
                               id="kursi"
                               value="{{ $kelas->kursi }}"
                               min="1"
                               required>
                    </div>

                    <!-- Jumlah Meja -->
                    <div class="form-group">
                        <label for="meja">Jumlah Meja</label>
                        <input type="number"
                               name="meja"
                               id="meja"
                               value="{{ $kelas->meja }}"
                               min="1"
                               required>
                    </div>
                </div>

                <!-- Photo Section -->
                <div class="photo-section">
                    <label style="font-weight: 600; color: #2d3748; font-size: 16px;">Foto Kelas</label>

                    <div class="photo-upload">
                        <!-- Current Photo Preview - HANYA SATU CLICK HANDLER -->
                        <div class="photo-preview" onclick="document.getElementById('gambar_kelas').click()">
                            @if ($kelas->gambar_kelas)
                                <img src="{{ asset('upload_gambar/' . $kelas->gambar_kelas) }}"
                                     alt="Foto Kelas {{ $kelas->namakelas }}"
                                     id="current-photo"
                                     class="current-photo">
                                <div class="photo-overlay">
                                    <span>Klik untuk ganti foto</span>
                                </div>
                            @else
                                <div class="no-photo" onclick="document.getElementById('gambar_kelas').click()">
                                    <div style="text-align: center;">
                                        <div style="font-size: 24px; margin-bottom: 5px;">📷</div>
                                        <span>Upload Foto Kelas</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Instructions -->
                        <div class="photo-instructions">
                            <h4>📸 Panduan Upload Foto</h4>
                            <ul>
                                <li>Klik area foto di samping untuk memilih file</li>
                                <li>Format yang didukung: JPG, PNG, GIF</li>
                                <li>Ukuran maksimal: 2MB</li>
                                <li>Foto akan langsung terlihat setelah dipilih</li>
                            </ul>
                            <p><strong>Tips:</strong> Gunakan foto yang jelas dan representatif</p>
                        </div>
                    </div>

                    <!-- File Input (Hidden) - HANYA SATU -->
                    <input type="file"
                           name="gambar_kelas"
                           id="gambar_kelas"
                           accept="image/*"
                           class="file-input"
                           onchange="previewImage(event)">

                    <!-- New Photo Preview -->
                    <div id="new-photo-preview" class="new-photo-preview">
                        <h5>🔄 Preview Foto Baru:</h5>
                        <img id="preview" class="preview-image">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="submit" class="submit-btn">
                        <span>💾</span> Simpan Perubahan
                    </button>
                    <a href="/kelas" class="back-btn">
                        <span>←</span> Kembali ke Daftar
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Manajemen Kelas • Menampilkan 1 data</p>
        </div>
    </div>

    <script>
        // Image preview functionality - SIMPLE
        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('new-photo-preview');
            const preview = document.getElementById('preview');
            const currentPhoto = document.getElementById('current-photo');

            if (input.files && input.files[0]) {
                // Validasi ukuran file (max 2MB)
                if (input.files[0].size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    // Show new preview
                    if (preview) {
                        preview.src = e.target.result;
                        previewContainer.classList.add('show');
                    }

                    // Update current photo
                    if (currentPhoto) {
                        currentPhoto.src = e.target.result;
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Form validation - SIMPLE
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            form.addEventListener('submit', function(e) {
                const requiredFields = ['namakelas', 'walikelas', 'ketuakelas', 'kursi', 'meja'];
                let isValid = true;

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#fc8181';
                    } else {
                        field.style.borderColor = '#e2e8f0';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Harap isi semua bidang yang wajib diisi!');
                }
            });

            // Number validation
            const numberFields = ['kursi', 'meja'];
            numberFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                field.addEventListener('input', function() {
                    if (this.value < 1) {
                        this.value = 1;
                    }
                });
            });

            // HAPUS SEMUA EVENT LISTENER LAIN UNTUK CLICK
            // HANYA GUNAKAN onclick di HTML
        });
    </script>
</body>
</html>
