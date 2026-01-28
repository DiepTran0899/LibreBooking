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
        currentCapturedImage: null,
        zaloConfig: {},
        
        /**
         * Initialize the camera module
         */
        init: function() {
            this.loadAllowedExtensions();
            this.setupEventListeners();
        },
        
        /**
         * Load Zalo configuration
         */
        loadZaloConfig: function() {
            if (typeof window.ZaloConfig !== 'undefined' && window.ZaloConfig) {
                this.zaloConfig = window.ZaloConfig;
            } else {
                console.warn('[ReservationCamera] Zalo config not found. Zalo features disabled.');
                this.zaloConfig = { apiUrl: '', apiKey: '', recipientUID: '', recipientGroupID: '' };
            }
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

            // Zalo send buttons
            $(document).on('click', '#btnSendCheckIn', function() {
                self.saveCapturedPhoto('checkin');
            });

            $(document).on('click', '#btnSendCheckOut', function() {
                self.saveCapturedPhoto('checkout');
            });

            $(document).on('click', '#btnSaveOnly', function() {
                self.saveCapturedPhoto(null);
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
            
            // Convert to WebP for better compression
            const imageDataUrl = canvas.toDataURL('image/webp', 0.85);
            capturedImage.src = imageDataUrl;
            
            // Hide video, show captured image
            video.style.display = 'none';
            document.getElementById('capturedImageContainer').style.display = 'block';
            document.getElementById('btnTakePhoto').style.display = 'none';
            document.getElementById('btnRetakePhoto').style.display = 'inline-block';
            
            // Show Zalo action buttons instead of single Save button
            const zaloButtons = document.getElementById('zaloActionButtons');
            if (zaloButtons) {
                zaloButtons.style.display = 'flex';
            }
            
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
            
            const zaloButtons = document.getElementById('zaloActionButtons');
            if (zaloButtons) {
                zaloButtons.style.display = 'none';
            }
            
            this.initCamera();
        },

        /**
         * Save captured photo (with optional Zalo action)
         */
        saveCapturedPhoto: function(zaloAction) {
            const imageDataUrl = document.getElementById('capturedImage').src;
            const now = new Date();
            const fileName = now.getFullYear() + 
                ('0' + (now.getMonth() + 1)).slice(-2) + 
                ('0' + now.getDate()).slice(-2) + '_' +
                ('0' + now.getHours()).slice(-2) + 
                ('0' + now.getMinutes()).slice(-2) + 
                ('0' + now.getSeconds()).slice(-2) + '.webp';
            
            this.addImageToPreview(imageDataUrl, fileName);
            
            // Store current image for Zalo sending
            this.currentCapturedImage = { dataUrl: imageDataUrl, fileName: fileName };
            
            // Close modal and reset
            $('#cameraModal').modal('hide');
            this.resetCameraModal();
            
            // If Zalo action selected, send immediately
            if (zaloAction && (zaloAction === 'checkin' || zaloAction === 'checkout')) {
                this.sendToZalo(zaloAction);
            }
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
            
            const zaloButtons = document.getElementById('zaloActionButtons');
            if (zaloButtons) {
                zaloButtons.style.display = 'none';
            }
            
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
                    // Convert images to WebP for better compression
                    if (self.isImageFile(file.name)) {
                        self.convertImageToWebP(e.target.result, file.name);
                    } else {
                        self.addImageToPreview(e.target.result, file.name);
                    }
                };
                reader.readAsDataURL(file);
            });
            
            // Reset file input
            document.getElementById('photoFileInput').value = '';
        },

        /**
         * Convert uploaded image to WebP format
         */
        convertImageToWebP: function(imageDataUrl, originalFileName) {
            const self = this;
            const img = new Image();
            img.onload = function() {
                const canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);
                
                // Convert to WebP with 85% quality
                const webpDataUrl = canvas.toDataURL('image/webp', 0.85);
                
                // Change file extension to .webp
                const newFileName = originalFileName.replace(/\.[^.]+$/, '.webp');
                
                self.addImageToPreview(webpDataUrl, newFileName);
            };
            img.src = imageDataUrl;
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
        },

        /**
         * Send image to Zalo with check-in/check-out message
         */
        sendToZalo: function(type) {
            const self = this;
            
            if (!this.currentCapturedImage) {
                alert('Không tìm thấy hình ảnh để gửi');
                return;
            }
            
            // Validate configuration
            if (!this.zaloConfig.recipientUID && !this.zaloConfig.recipientGroupID) {
                alert('Chưa cấu hình người nhận Zalo. Vui lòng liên hệ admin.');
                return;
            }
            
            // Show loading notification
            const loadingToast = this.showToast('info', 'Đang gửi tin nhắn Zalo...', 0);
            
            // Get reservation info from form
            const reservationTitle = ($('#reservationTitle').val() || 'Không có tiêu đề').trim();
            const resourceName = ($('.resourceDetails').first().text() || 'Không rõ').trim();
            const ownerName = ($('#userName').text() || 'Không rõ').trim();
            
            // Prepare message text with reservation details
            const actionText = type === 'checkin' 
                ? this.zaloConfig.messages.checkIn.trim()
                : this.zaloConfig.messages.checkOut.trim();
            
            const messageText = actionText + ' ' + new Date().toLocaleString('vi-VN') + '\n📋 Tiêu đề: ' + reservationTitle + '\n🏢 Tài nguyên: ' + resourceName + '\n👤 Người đặt: ' + ownerName;
            
            // Convert base64 to Blob
            this.base64ToBlob(this.currentCapturedImage.dataUrl, function(blob) {
                // Create FormData
                const formData = new FormData();
                formData.append('text', messageText);
                formData.append('file', blob, self.currentCapturedImage.fileName);
                
                // Add recipient
                if (self.zaloConfig.recipientGroupID) {
                    formData.append('toGROUPID', self.zaloConfig.recipientGroupID);
                }
                if (self.zaloConfig.recipientUID) {
                    formData.append('toUID', self.zaloConfig.recipientUID);
                }
                
                // Send to Zalo API
                fetch(self.zaloConfig.apiUrl, {
                    method: 'POST',
                    body: formData
                    // No API key header needed - handled by server session
                })
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(function(data) {
                    loadingToast.hide();
                    if (data.success) {
                        self.showToast('success', '✓ Đã gửi tin nhắn Zalo thành công!', 3000);
                    } else {
                        self.showToast('error', 'Lỗi: ' + (data.error || 'Unknown error'), 5000);
                    }
                })
                .catch(function(error) {
                    console.error('Zalo send error:', error);
                    loadingToast.hide();
                    
                    let errorMsg = 'Lỗi kết nối Zalo API. ';
                    if (error.message.includes('Failed to fetch')) {
                        errorMsg += 'Kiểm tra:\n• Zalo server đã chạy?\n• CORS đã cấu hình?\n• URL/API Key đúng?';
                    } else {
                        errorMsg += error.message;
                    }
                    
                    self.showToast('error', errorMsg, 8000);
                });
            });
        },

        /**
         * Show toast notification
         */
        showToast: function(type, message, autoHideDuration) {
            const toastId = 'toast-' + Date.now();
            const iconMap = {
                'success': 'bi-check-circle-fill text-success',
                'error': 'bi-exclamation-triangle-fill text-danger',
                'info': 'bi-info-circle-fill text-primary'
            };
            
            const toastHtml = 
                '<div id="' + toastId + '" class="toast align-items-center border-0" role="alert" style="position: fixed; top: 80px; right: 20px; z-index: 9999; min-width: 300px;">' +
                    '<div class="d-flex">' +
                        '<div class="toast-body">' +
                            '<i class="bi ' + iconMap[type] + ' me-2"></i>' +
                            '<span style="white-space: pre-line;">' + message + '</span>' +
                        '</div>' +
                        '<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>' +
                    '</div>' +
                '</div>';
            
            $('body').append(toastHtml);
            
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, {
                autohide: autoHideDuration > 0,
                delay: autoHideDuration
            });
            
            toast.show();
            
            // Auto remove after hide
            toastElement.addEventListener('hidden.bs.toast', function() {
                toastElement.remove();
            });
            
            return toast;
        },

        /**
         * Convert base64 data URL to Blob
         */
        base64ToBlob: function(dataUrl, callback) {
            const arr = dataUrl.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            
            callback(new Blob([u8arr], { type: mime }));
        }
    };

    // Expose to global scope
    window.ReservationCamera = ReservationCamera;

    // Auto-initialize when document is ready
    $(document).ready(function() {
        // Load Zalo config after DOM is ready
        ReservationCamera.loadZaloConfig();
        // Then initialize
        ReservationCamera.init();
    });

})(window);
