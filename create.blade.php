<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas Baru</title>
    <style>
        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }

        /* Container */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            font-size: 1.1rem;
            color: #7f8c8d;
        }

        .header::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #3498db;
            margin: 20px auto;
            border-radius: 2px;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #3498db, #27ae60);
        }

        .form-title {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-title::before {
            content: "+";
            font-size: 2rem;
            color: #27ae60;
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e6ed;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        }

        /* Photo Upload Section */
        .photo-section {
            background: #f8fafc;
            border-radius: 10px;
            padding: 30px;
            margin: 30px 0;
            border: 2px dashed #d1d9e6;
            transition: all 0.3s;
        }

        .photo-section:hover {
            border-color: #3498db;
            background: #f0f7ff;
        }

        .photo-label {
            display: block;
            margin-bottom: 20px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .photo-upload-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            cursor: pointer;
            position: relative;
            min-height: 300px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .photo-upload-area:hover {
            transform: translateY(-2px);
        }

        .upload-placeholder {
            text-align: center;
            color: #7f8c8d;
        }

        .upload-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #bdc3c7;
            transition: color 0.3s;
        }

        .photo-upload-area:hover .upload-icon {
            color: #3498db;
        }

        .upload-text {
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .upload-hint {
            font-size: 0.9rem;
            color: #95a5a6;
            margin-top: 10px;
        }

        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* Preview Container */
        .preview-container {
            display: none;
            width: 100%;
            text-align: center;
        }

        .preview-container.show {
            display: block;
        }

        #preview {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 3px solid white;
            margin-bottom: 20px;
        }

        .preview-info {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 8px;
            color: #2980b9;
            font-size: 0.9rem;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }

        .btn {
            flex: 1;
            padding: 16px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: #7f8c8d;
            font-size: 0.9rem;
            border-top: 1px solid #e0e6ed;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }

            .form-actions {
                flex-direction: column;
            }

            .photo-upload-area {
                min-height: 250px;
                padding: 30px 15px;
            }

            .upload-icon {
                font-size: 3rem;
            }

            .upload-text {
                font-size: 1rem;
            }

            .form-card {
                padding: 25px;
            }

            .header h1 {
                font-size: 2rem;
            }
        }

        /* Table-like look for form */
        .table-form {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .table-form tr {
            margin-bottom: 15px;
        }

        .table-form td {
            padding: 12px 0;
            vertical-align: top;
        }

        .table-form td:first-child {
            width: 200px;
            padding-right: 20px;
            font-weight: 600;
            color: #2c3e50;
        }

        /* Required field indicator */
        .required::after {
            content: " *";
            color: #e74c3c;
        }

        /* Loading state */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Manajemen Kelas</h1>
            <p>Sistem pengelolaan data kelas</p>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <h2 class="form-title">Tambah Kelas Baru</h2>

            <form action="/kelas" method="post" enctype="multipart/form-data" id="createForm">
                @csrf

                <!-- Form menggunakan tabel untuk struktur -->
                <table class="table-form">
                    <tr>
                        <td><label for="namakelas" class="required">Nama Kelas:</label></td>
                        <td>
                            <input type="text"
                                   name="namakelas"
                                   id="namakelas"
                                   class="form-control"
                                   placeholder="Contoh: XII IPA 1"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="walikelas" class="required">Wali Kelas:</label></td>
                        <td>
                            <input type="text"
                                   name="walikelas"
                                   id="walikelas"
                                   class="form-control"
                                   placeholder="Nama lengkap wali kelas"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="ketuakelas" class="required">Ketua Kelas:</label></td>
                        <td>
                            <input type="text"
                                   name="ketuakelas"
                                   id="ketuakelas"
                                   class="form-control"
                                   placeholder="Nama ketua kelas"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="kursi" class="required">Jumlah Kursi:</label></td>
                        <td>
                            <input type="number"
                                   name="kursi"
                                   id="kursi"
                                   class="form-control"
                                   placeholder="0"
                                   min="1"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="meja" class="required">Jumlah Meja:</label></td>
                        <td>
                            <input type="number"
                                   name="meja"
                                   id="meja"
                                   class="form-control"
                                   placeholder="0"
                                   min="1"
                                   required>
                        </td>
                    </tr>
                </table>

                <!-- Photo Upload Section -->
                <div class="photo-section">
                    <label class="photo-label required">Foto Kelas:</label>
                    <div class="photo-upload-area" id="uploadArea">
                        <div class="upload-placeholder" id="uploadPlaceholder">
                            <div class="upload-icon">📷</div>
                            <div class="upload-text">Klik untuk upload foto kelas</div>
                            <div class="upload-hint">Format: JPG, PNG, GIF | Maks: 2MB</div>
                        </div>
                        <div class="preview-container" id="previewContainer">
                            <img id="preview" alt="Preview Foto">
                            <div class="preview-info">Foto siap diupload. Klik area untuk mengganti.</div>
                        </div>
                        <input type="file"
                               name="gambar_kelas"
                               id="gambar_kelas"
                               class="file-input"
                               accept="image/*"
                               required
                               onchange="previewImage(event)">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span>💾</span> Simpan Data
                    </button>
                    <a href="/kelas" class="btn btn-secondary">
                        <span>←</span> Kembali ke Daftar
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2026 Manajemen Kelas • Sistem pengelolaan data kelas</p>
        </div>
    </div>

    <script>
        // Preview image functionality
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('previewContainer');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            const uploadArea = document.getElementById('uploadArea');

            if (input.files && input.files[0]) {
                // Validate file size (max 2MB)
                if (input.files[0].size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB');
                    input.value = '';
                    return;
                }

                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(input.files[0].type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    // Show preview
                    preview.src = e.target.result;
                    uploadPlaceholder.style.display = 'none';
                    previewContainer.classList.add('show');

                    // Change upload area style
                    uploadArea.style.border = '2px solid #27ae60';
                    uploadArea.style.background = '#f0fff4';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                // If no file selected, show placeholder again
                uploadPlaceholder.style.display = 'block';
                previewContainer.classList.remove('show');
                uploadArea.style.border = '2px dashed #d1d9e6';
                uploadArea.style.background = '#f8fafc';
            }
        }

        // Form validation and submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('createForm');
            const fileInput = document.getElementById('gambar_kelas');
            const submitBtn = document.getElementById('submitBtn');

            // Click on upload area to trigger file input
            const uploadArea = document.getElementById('uploadArea');
            uploadArea.addEventListener('click', function(e) {
                if (e.target !== fileInput) {
                    fileInput.click();
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                // Check required fields
                const requiredFields = ['namakelas', 'walikelas', 'ketuakelas', 'kursi', 'meja'];
                let isValid = true;

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#e74c3c';
                        field.style.animation = 'shake 0.5s';
                        setTimeout(() => {
                            field.style.animation = '';
                        }, 500);
                    } else {
                        field.style.borderColor = '#e0e6ed';
                    }
                });

                // Check file input
                if (!fileInput.files || fileInput.files.length === 0) {
                    isValid = false;
                    uploadArea.style.borderColor = '#e74c3c';
                    uploadArea.style.animation = 'shake 0.5s';
                    setTimeout(() => {
                        uploadArea.style.animation = '';
                    }, 500);
                }

                if (!isValid) {
                    e.preventDefault();
                    alert('Harap lengkapi semua data yang diperlukan!');
                    return false;
                }

                // If all valid, show loading
                submitBtn.innerHTML = '<span>⏳</span> Menyimpan...';
                submitBtn.disabled = true;
                form.classList.add('loading');
            });

            // Add shake animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
                }
            `;
            document.head.appendChild(style);

            // Drag and drop functionality
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#3498db';
                this.style.background = '#f0f7ff';
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                const previewContainer = document.getElementById('previewContainer');
                if (!previewContainer.classList.contains('show')) {
                    this.style.borderColor = '#d1d9e6';
                    this.style.background = '#f8fafc';
                }
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                fileInput.files = e.dataTransfer.files;
                const event = new Event('change');
                fileInput.dispatchEvent(event);
            });

            // Input validation for numbers
            const numberFields = ['kursi', 'meja'];
            numberFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                field.addEventListener('input', function() {
                    if (this.value < 1) {
                        this.value = 1;
                    }
                });
            });
        });
    </script>
</body>
</html>
