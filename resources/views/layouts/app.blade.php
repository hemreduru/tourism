@extends('adminlte::page')
@push('css')
    <style>
        .card.card-outline {
            padding: 10px !important;
        }
    </style>
@endpush
@push('js')
    @include('components.toastr')
@endpush
