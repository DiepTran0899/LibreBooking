/**
 * Reservation Camera & File Attachment Module
 * Handles camera capture and file upload functionality for reservations
 */
(function(window) {
    'use strict';

    const ReservationCamera = {
        cameraStream: null,
        capturedImages: [],
        allowedExtensions: [],
        
        /**
         * Initialize the camera module
         */
        init: function() {
            this.loadAllowedExtensions();
            this.setupEventListeners();
        },
        
        /**
         * Load allowed extensions from global variable
         */
        loadAllowedExtensions: function() {
            if (typeof allowedExtensionsList !== 'undefined' && allowedExtensionsList) {
                this.allowedExtensions = allowedExtensionsList.split(',').map(function(ext) {
                    return ext.trim().toLowerCase();
                });
            } else {
                // Default extensions if not configured
                this.allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'txt', 'xls', 'xlsx'];
            }
        },
        
        /**
         * Check if file extension is allowed
         */
        isExtensionAllowed: function(fileName) {
            const ext = fileName.split('.').pop().toLowerCase();
            return this.allowedExtensions.indexOf(ext) !== -1;
        },
        
        /**
         * Get file extension
         */
        getFileExtension: function(fileName) {
            return fileName.split('.').pop().toLowerCase();
        },
        
        /**
         * Check if file is an image
         */
        isImageFile: function(fileName) {
            const ext = this.getFileExtension(fileName);
            return ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].indexOf(ext) !== -1;
        },
        
        /**
         * Get file icon class based on extension
         */
        getFileIconClass: function(fileName) {
            const ext = this.getFileExtension(fileName);
            const iconMap = {
                'pdf': 'bi-file-earmark-pdf text-danger',
                'doc': 'bi-file-earmark-word text-primary',
                'docx': 'bi-file-earmark-word text-primary',
                'xls': 'bi-file-earmark-excel text-success',
                'xlsx': 'bi-file-earmark-excel text-success',
                'ppt': 'bi-file-earmark-ppt text-warning',
                'pptx': 'bi-file-earmark-ppt text-warning',
                'txt': 'bi-file-earmark-text text-secondary',
                'csv': 'bi-file-earmark-spreadsheet text-success',
                'zip': 'bi-file-earmark-zip text-warning',
                'rar': 'bi-file-earmark-zip text-warning'
            };
            return iconMap[ext] || 'bi-file-earmark text-secondary';
        },

        /**
         * Setup all event listeners for camera and upload buttons
         */
        setupEventListeners: function() {
            const self = this;
            
            // Capture photo button - can be anywhere on the page
            $(document).on('click', '[data-action="capture-photo"]', function(e) {
                e.preventDefault();
                self.openCameraModal();
            });

            // Upload photo button - can be anywhere on the page
            $(document).on('click', '[data-action="upload-photo"]', function(e) {
                e.preventDefault();
                const fileInput = document.getElementById('photoFileInput');
                if (fileInput) {
                    fileInput.click();
                }
            });

            // File input change
            const fileInput = document.getElementById('photoFileInput');
            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    self.handleFileUpload(this.files);
                });
            }

            // Camera modal buttons
            $('#btnTakePhoto').on('click', function() {
                self.capturePhoto();
            });

            $('#btnRetakePhoto').on('click', function() {
                self.retakePhoto();
            });

            $('#btnSaveCapturedPhoto').on('click', function() {
                self.saveCapturedPhoto();
            });

            // Modal events
            $('#cameraModal').on('shown.bs.modal', function() {
                self.initCamera();
            });

            $('#cameraModal').on('hidden.bs.modal', function() {
                self.resetCameraModal();
            });

            // Remove image buttons
            $(document).on('click', '.remove-new-image', function() {
                const index = parseInt($(this).data('index'));
                self.removeImage(index, $(this).closest('.col-md-4'));
            });

            // Remove existing attachment buttons
            $('.remove-image-attachment').on('click', function() {
                if (confirm('Bạn có chắc muốn xóa hình ảnh này?')) {
                    const fileId = $(this).data('file-id');
                    const item = $(this).closest('.image-attachment-item');
                    const checkbox = item.find('.removed-file-checkbox');
                    checkbox.prop('checked', true);
                    item.css('opacity', '0.5');
                    $(this).prop('disabled', true);
                }
            });

            // Add captured images to form when Update button is clicked
            $('.btnEdit.update, .save.update').on('click', function(e) {
                self.addCapturedImagesToForm();
            });
        },

        /**
         * Open camera modal
         */
        openCameraModal: function() {
            $('#cameraModal').modal('show');
        },

        /**
         * Initialize camera
         */
        initCamera: function() {
            const video = document.getElementById('cameraVideo');
            const constraints = {
                video: { facingMode: 'environment', width: { ideal: 1920 }, height: { ideal: 1080 } }
            };
            
            const self = this;
            navigator.mediaDevices.getUserMedia(constraints)
                .then(function(stream) {
                    self.cameraStream = stream;
                    video.srcObject = stream;
                })
                .catch(function(err) {
                    console.error('Camera error:', err);
                    alert('Không thể truy cập camera. Vui lòng kiểm tra quyền truy cập camera.');
                });
        },

        /**
         * Stop camera stream
         */
        stopCamera: function() {
            if (this.cameraStream) {
                this.cameraStream.getTracks().forEach(function(track) {
                    track.stop();
                });
                this.cameraStream = null;
            }
        },

        /**
         * Capture photo from camera
         */
        capturePhoto: function() {
            const video = document.getElementById('cameraVideo');
            const canvas = document.getElementById('cameraCanvas');
            const capturedImage = document.getElementById('capturedImage');
            
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0);
            
            const imageDataUrl = canvas.toDataURL('image/jpeg', 0.9);
            capturedImage.src = imageDataUrl;
            
            // Hide video, show captured image
            video.style.display = 'none';
            document.getElementById('capturedImageContainer').style.display = 'block';
            document.getElementById('btnTakePhoto').style.display = 'none';
            document.getElementById('btnRetakePhoto').style.display = 'inline-block';
            document.getElementById('btnSaveCapturedPhoto').style.display = 'inline-block';
            
            this.stopCamera();
        },

        /**
         * Retake photo
         */
        retakePhoto: function() {
            const video = document.getElementById('cameraVideo');
            video.style.display = 'block';
            document.getElementById('capturedImageContainer').style.display = 'none';
            document.getElementById('btnTakePhoto').style.display = 'inline-block';
            document.getElementById('btnRetakePhoto').style.display = 'none';
            document.getElementById('btnSaveCapturedPhoto').style.display = 'none';
            
            this.initCamera();
        },

        /**
         * Save captured photo
         */
        saveCapturedPhoto: function() {
            const imageDataUrl = document.getElementById('capturedImage').src;
            const now = new Date();
            const fileName = now.getFullYear() + 
                ('0' + (now.getMonth() + 1)).slice(-2) + 
                ('0' + now.getDate()).slice(-2) + '_' +
                ('0' + now.getHours()).slice(-2) + 
                ('0' + now.getMinutes()).slice(-2) + 
                ('0' + now.getSeconds()).slice(-2) + '.jpg';
            
            this.addImageToPreview(imageDataUrl, fileName);
            
            // Close modal and reset
            $('#cameraModal').modal('hide');
            this.resetCameraModal();
        },

        /**
         * Reset camera modal
         */
        resetCameraModal: function() {
            const video = document.getElementById('cameraVideo');
            video.style.display = 'block';
            document.getElementById('capturedImageContainer').style.display = 'none';
            document.getElementById('btnTakePhoto').style.display = 'inline-block';
            document.getElementById('btnRetakePhoto').style.display = 'none';
            document.getElementById('btnSaveCapturedPhoto').style.display = 'none';
            this.stopCamera();
        },

        /**
         * Add file to preview grid (supports both images and other file types)
         */
        addImageToPreview: function(fileDataUrl, fileName) {
            const previewContainer = document.getElementById('newImagesPreview');
            const grid = document.getElementById('newImagesGrid');
            const index = this.capturedImages.length;
            
            this.capturedImages.push({ dataUrl: fileDataUrl, fileName: fileName });
            
            const col = document.createElement('div');
            col.className = 'col-md-4 col-sm-6 col-12';
            
            let previewContent;
            if (this.isImageFile(fileName)) {
                previewContent = '<img src="' + fileDataUrl + '" class="card-img-top" alt="' + fileName + '" style="height: 200px; object-fit: cover;">';
            } else {
                const iconClass = this.getFileIconClass(fileName);
                previewContent = '<div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa;">' +
                    '<i class="bi ' + iconClass + '" style="font-size: 4rem;"></i>' +
                '</div>';
            }
            
            col.innerHTML = 
                '<div class="card">' +
                    previewContent +
                    '<div class="card-body p-2">' +
                        '<h6 class="card-title small mb-1 text-truncate" title="' + fileName + '">' + fileName + '</h6>' +
                        '<button type="button" class="btn btn-sm btn-outline-danger mt-2 remove-new-image" data-index="' + index + '">' +
                            '<i class="bi bi-trash"></i> Xóa' +
                        '</button>' +
                    '</div>' +
                '</div>';
            
            grid.appendChild(col);
            previewContainer.style.display = 'block';
        },

        /**
         * Handle file upload from input (supports all allowed file types)
         */
        handleFileUpload: function(files) {
            const self = this;
            Array.from(files).forEach(function(file) {
                // Validate file extension
                if (!self.isExtensionAllowed(file.name)) {
                    const allowedList = self.allowedExtensions.join(', ');
                    alert('Loại file không hợp lệ. Chỉ chấp nhận: ' + allowedList);
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    self.addImageToPreview(e.target.result, file.name);
                };
                reader.readAsDataURL(file);
            });
            
            // Reset file input
            document.getElementById('photoFileInput').value = '';
        },

        /**
         * Remove image from preview
         */
        removeImage: function(index, element) {
            this.capturedImages.splice(index, 1);
            element.remove();
            
            if (this.capturedImages.length === 0) {
                document.getElementById('newImagesPreview').style.display = 'none';
            }
        },

        /**
         * Add captured images to form before submission
         */
        addCapturedImagesToForm: function() {
            console.log('Adding captured images to form:', this.capturedImages.length);
            
            // Remove any previously added captured image inputs
            $('input[name^="captured_images"]').remove();
            
            // Add captured images as hidden inputs to the form
            const form = $('#form-reservation');
            this.capturedImages.forEach(function(img, index) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'captured_images[' + index + '][data]',
                    value: img.dataUrl
                }).appendTo(form);
                
                $('<input>').attr({
                    type: 'hidden',
                    name: 'captured_images[' + index + '][filename]',
                    value: img.fileName
                }).appendTo(form);
            });
            
            console.log('Added', this.capturedImages.length, 'images to form');
        }
    };

    // Expose to global scope
    window.ReservationCamera = ReservationCamera;

    // Auto-initialize when document is ready
    $(document).ready(function() {
        ReservationCamera.init();
    });

})(window);
