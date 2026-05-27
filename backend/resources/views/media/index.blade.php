@extends('layouts.app')

@section('page_title', 'Media Library')

@section('content')
    <div class="content-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-images"></i>
                Media Library
            </h2>
            <div class="section-actions">
                <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="bi bi-cloud-upload"></i>
                    Upload Media
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Media Gallery -->
        <div class="media-gallery">
            @forelse($media as $item)
                <div class="media-item" data-id="{{ $item->id }}">
                    <div class="media-preview">
                        @if(strpos($item->mime_type, 'image/') === 0)
                            <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->alt_text }}" class="img-fluid">
                        @elseif(strpos($item->mime_type, 'video/') === 0)
                            <video class="media-video">
                                <source src="{{ asset('storage/' . $item->file_path) }}" type="{{ $item->mime_type }}">
                                <i class="bi bi-play-circle-fill"></i>
                            </video>
                        @elseif(strpos($item->mime_type, 'audio/') === 0)
                            <i class="bi bi-music-note-beamed fs-1"></i>
                        @else
                            <i class="bi bi-file-earmark fs-1"></i>
                        @endif
                    </div>
                    <div class="media-info">
                        <h6 class="media-title">{{ $item->title ?: basename($item->file_path) }}</h6>
                        <small class="text-muted">{{ $item->created_at->format('M d, Y') }}</small>
                        <div class="media-actions mt-2">
                            <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ asset('storage/' . $item->file_path) }}')" title="Copy URL">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-info" onclick="showMediaDetails({{ $item->id }})" title="Details">
                                <i class="bi bi-info-circle"></i>
                            </button>
                            <form action="{{ route('media.destroy', $item) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this file?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state text-center py-5">
                    <i class="bi bi-images fs-1 text-muted"></i>
                    <h5 class="mt-3">No media files yet</h5>
                    <p class="text-muted">Upload your first image, video, or document to get started.</p>
                    <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        <i class="bi bi-cloud-upload"></i>
                        Upload Media
                    </button>
                </div>
            @endforelse
        </div>

        @if($media->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $media->links() }}
            </div>
        @endif
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-cloud-upload"></i> Upload Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="file-upload-area" id="fileUploadArea">
                            <i class="bi bi-cloud-upload-fill upload-icon"></i>
                            <div class="upload-text">
                                <strong>Drag & drop files here</strong><br>
                                or <label for="files" class="text-primary" style="cursor: pointer;">browse to choose files</label>
                            </div>
                            <input type="file" id="files" name="files[]" multiple accept="image/*,video/*,audio/*,.pdf,.doc,.docx" style="display: none;">
                            <small class="text-muted mt-2 d-block">Supported: Images, Videos, Audio, PDF, Word documents</small>
                        </div>

                        <div id="filePreview" class="mt-3" style="display: none;">
                            <h6>Selected Files:</h6>
                            <div id="fileList" class="row"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-custom" id="uploadBtn" disabled>
                            <i class="bi bi-cloud-upload"></i>
                            Upload Files
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Media Details Modal -->
    <div class="modal fade" id="mediaDetailsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-info-circle"></i> Media Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="mediaDetailsContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <style>
        .media-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .media-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .media-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }

        .media-preview {
            height: 200px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .media-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .media-preview video,
        .media-preview audio {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .media-info {
            padding: 15px;
        }

        .media-title {
            margin-bottom: 5px;
            font-weight: 600;
            color: var(--primary-green);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .media-actions {
            display: flex;
            gap: 5px;
        }

        .empty-state {
            grid-column: 1 / -1;
        }

        .file-upload-area.dragover {
            background: rgba(27, 99, 66, 0.1);
            border-color: var(--primary-green);
        }

        .file-preview-item {
            position: relative;
            margin-bottom: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 6px;
            border: 1px solid #e9ecef;
        }

        .file-preview-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .file-remove {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
        }
    </style>

    <script>
        // File upload handling
        const fileInput = document.getElementById('files');
        const fileUploadArea = document.getElementById('fileUploadArea');
        const filePreview = document.getElementById('filePreview');
        const fileList = document.getElementById('fileList');
        const uploadBtn = document.getElementById('uploadBtn');

        let selectedFiles = [];

        // Drag and drop functionality
        fileUploadArea.addEventListener('click', () => fileInput.click());

        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            selectedFiles = Array.from(files);
            updateFilePreview();
        }

        function updateFilePreview() {
            fileList.innerHTML = '';
            if (selectedFiles.length > 0) {
                filePreview.style.display = 'block';
                uploadBtn.disabled = false;

                selectedFiles.forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'col-md-6 file-preview-item';

                    let preview = '';
                    if (file.type.startsWith('image/')) {
                        preview = `<img src="${URL.createObjectURL(file)}" alt="${file.name}">`;
                    } else {
                        preview = `<i class="bi bi-file-earmark fs-2"></i>`;
                    }

                    fileItem.innerHTML = `
                        ${preview}
                        <div class="ms-2 flex-grow-1">
                            <strong>${file.name}</strong><br>
                            <small class="text-muted">${(file.size / 1024).toFixed(1)} KB</small>
                        </div>
                        <button type="button" class="file-remove" onclick="removeFile(${index})">
                            <i class="bi bi-x"></i>
                        </button>
                    `;

                    fileList.appendChild(fileItem);
                });
            } else {
                filePreview.style.display = 'none';
                uploadBtn.disabled = true;
            }
        }

        function removeFile(index) {
            selectedFiles.splice(index, 1);
            updateFilePreview();
        }

        // Copy to clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Simple feedback
                const btn = event.target.closest('button');
                const originalIcon = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check"></i>';
                btn.classList.add('btn-success');
                setTimeout(() => {
                    btn.innerHTML = originalIcon;
                    btn.classList.remove('btn-success');
                }, 1000);
            });
        }

        // Show media details
        function showMediaDetails(mediaId) {
            fetch(`/admin/media/${mediaId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('mediaDetailsContent').innerHTML = `
                        <div class="text-center mb-3">
                            ${data.mime_type.startsWith('image/') ?
                                `<img src="${data.url}" class="img-fluid rounded" style="max-height: 200px;">` :
                                `<i class="bi bi-file-earmark fs-1 text-muted"></i>`
                            }
                        </div>
                        <table class="table table-sm">
                            <tr><td><strong>Title:</strong></td><td>${data.title || 'N/A'}</td></tr>
                            <tr><td><strong>Filename:</strong></td><td>${data.filename}</td></tr>
                            <tr><td><strong>Type:</strong></td><td>${data.mime_type}</td></tr>
                            <tr><td><strong>Size:</strong></td><td>${data.size}</td></tr>
                            <tr><td><strong>Uploaded:</strong></td><td>${data.created_at}</td></tr>
                            <tr><td><strong>URL:</strong></td><td><code>${data.url}</code></td></tr>
                        </table>
                        <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('${data.url}')">
                            <i class="bi bi-clipboard"></i> Copy URL
                        </button>
                    `;
                    new bootstrap.Modal(document.getElementById('mediaDetailsModal')).show();
                });
        }
    </script>
@endsection
