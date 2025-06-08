@extends('adminlte::page')
@push('css')
    {{-- Summernote CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    {{-- Lightbox2 CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    {{-- Summernote Dropdown Fix --}}
    <style>
        /* Summernote dropdown menülerinin düzgün görüntülenmesi için CSS düzeltmeleri */
        .note-editor .dropdown-toggle::after {
            all: unset;
        }
        .note-editor .note-dropdown-menu {
            box-sizing: content-box;
            min-width: 100px;
        }
        .note-editor .note-dropdown-menu a {
            display: block;
            margin: 2px 0;
            padding: 3px 20px;
            font-weight: normal;
        }
        .note-editor .dropdown-menu {
            z-index: 1050;
            position: absolute;
        }
        .note-editor .note-btn-group .dropdown-menu {
            min-width: 90px;
        }
        .note-editor.note-frame {
            border: 1px solid #ddd;
        }
        .note-popover .popover-content .note-color .dropdown-menu,
        .note-editor .note-color .dropdown-menu {
            min-width: 352px;
        }
        /* Dropdown sorununu çözmek için */
        .note-btn-group .dropdown-menu {
            z-index: 1060 !important;
            position: absolute !important;
            display: none;
        }
        .note-btn-group.show .dropdown-menu {
            display: block;
        }
    </style>
@endpush

@push('js')
    @include('components.toastr')
    {{-- Summernote JS --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    {{-- Lightbox2 JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    {{-- Fix Summernote Dropdowns --}}
    <script>
        $(document).ready(function() {
            // Summernote dropdown sorunlarını düzeltme
            if ($.fn.summernote && $.fn.summernote.dom) {
                $.fn.summernote.dom.emptyPara = "<p><br></p>";
            }

            // Style dropdown sorunu düzeltmesi
            $(document).on('click', function(e) {
                var $target = $(e.target);
                if (!$target.closest('.dropdown-menu').length && !$target.hasClass('dropdown-toggle')) {
                    $('.note-btn-group .dropdown-menu').hide();
                }
            });

            // Style dropdown butonları için olay
            $(document).on('click', '.note-btn-group .dropdown-toggle', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Tüm açık dropdown'ları kapat
                $('.note-btn-group .dropdown-menu').not($(this).next('.dropdown-menu')).hide();

                // Bu butona ait dropdown'u aç/kapat
                var $menu = $(this).next('.dropdown-menu');
                $menu.toggle();
            });
        });
    </script>
    {{-- Include Summernote Configuration --}}
    @include('components.summernote')
@endpush
