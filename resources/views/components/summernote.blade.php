{{-- Summernote Editor Configuration --}}
<script>
    $(document).ready(function() {
        // Summernote başlatma ayarları
        $('.summernote').summernote({
            height: 200,
            lang: '{{ app()->getLocale() }}', // Dil ayarını uygulama diline göre ayarla
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
           /* styleTags: [
                'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],*/
            callbacks: {
                onImageUpload: function(files) {
                    // Her dosya için yükleme işlemini gerçekleştir
                    for(let i = 0; i < files.length; i++) {
                        uploadImage(files[i], this);
                    }
                }
            },
            popover: {
                image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ]
            },
            codemirror: {
                theme: 'monokai'
            }
        });

        /*// Style dropdown ve diğer dropdown'ların her zaman çalışmasını sağlamak için
        $(document).on('click', '.note-btn.dropdown-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Tıklanan dropdown'un parent elementi
            var $btnGroup = $(this).closest('.note-btn-group');

            // Diğer tüm dropdown menüleri kapat
            $('.note-btn-group').not($btnGroup).removeClass('show');
            $('.note-btn-group').not($btnGroup).find('.dropdown-menu').hide();

            // Tıklanan dropdown'u aç veya kapat (toggle)
            $btnGroup.toggleClass('show');
            var $menu = $btnGroup.find('.dropdown-menu');

            if ($btnGroup.hasClass('show')) {
                $menu.show();

                // Pozisyon ayarlaması yap
                var pos = $(this).position();
                var menuHeight = $menu.height();
                var menuWidth = $menu.width();
                var btnWidth = $(this).outerWidth();

                // Dropdown menünün görünür olması için position ayarı
                $menu.css({
                    top: pos.top + $(this).outerHeight(),
                    left: pos.left
                });

                // Sayfa dışına taşma durumunda düzeltme
                if (pos.left + menuWidth > $(window).width()) {
                    $menu.css('left', pos.left + btnWidth - menuWidth);
                }
            } else {
                $menu.hide();
            }
        });

        // Dropdown dışına tıklandığında kapanmasını sağla
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.note-btn-group').length) {
                $('.note-btn-group').removeClass('show');
                $('.note-btn-group .dropdown-menu').hide();
            }
        });*/

        /**
         * Resim yükleme fonksiyonu
         * @param {File} file - Yüklenecek resim dosyası
         * @param {Object} editor - Summernote editör nesnesi
         */
        function uploadImage(file, editor) {
            // Yükleme işlemi başladığında gösterge
            var $editor = $(editor);
            var $indicator = $('<div class="upload-indicator" style="position:absolute;z-index:3000;padding:5px 10px;background:rgba(0,0,0,0.7);color:white;border-radius:5px;">{{ __("editor.uploading_image") }}</div>');
            $editor.next('.note-editor').find('.note-editing-area').append($indicator);

            // Yükleme verilerini hazırla
            var formData = new FormData();
            formData.append('image', file);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: "{{ route('admin.summernote.upload-image') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    // Göstergeyi kaldır
                    $indicator.remove();

                    if (response.success) {
                        // Resmi editöre ekle - daha güvenli yöntem kullanarak
                        var imageUrl = response.file.url;
                        $editor.summernote('insertImage', imageUrl, function($image) {
                            $image.css('max-width', '100%');
                        });
                    } else {
                        // Hata mesajını göster
                        showErrorMessage($editor, '{{ __("editor.image_upload_error") }}: ' + response.message);
                    }
                },
                error: function(xhr) {
                    // Göstergeyi kaldır
                    $indicator.remove();

                    // Hata mesajı göster
                    showErrorMessage($editor, '{{ __("editor.image_upload_error") }}');
                    console.error('{{ __("editor.image_upload_error") }}:', xhr.responseJSON ? xhr.responseJSON.message : xhr.statusText);
                }
            });
        }

        /**
         * Hata mesajını göster ve sonra kaldır
         * @param {Object} $editor - Editör jQuery nesnesi
         * @param {String} message - Hata mesajı
         */
        function showErrorMessage($editor, message) {
            var $errorMsg = $('<div class="error-message" style="color:red;padding:5px;margin:5px 0;">' + message + '</div>');
            $editor.next('.note-editor').after($errorMsg);

            setTimeout(function() {
                $errorMsg.fadeOut(function() {
                    $(this).remove();
                });
            }, 3000);
        }
    });
</script>

