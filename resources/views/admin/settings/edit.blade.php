@extends('adminlte::page')
@section('title', __('settings.title'))

@section('content_header')
    <h1>{{ __('settings.title') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-header bg-light">
                <h3 class="card-title"><i class="fas fa-cog mr-2"></i>{{ __('settings.edit_title') }}</h3>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Hidden lat/lng inputs -->
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $setting->latitude) }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $setting->longitude) }}">

                <div class="card-body">
                    <!-- Map Row -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="font-weight-medium">{{ __('settings.select_location') }}</label>
                            <div id="map" style="width: 100%; height: 400px; border: 1px solid #ced4da;"></div>
                            <small class="form-text text-muted">{{ __('settings.click_to_set') }}</small>
                        </div>
                    </div>

                    <!-- Inputs Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $setting->phone) }}" placeholder="{{ __('settings.phone_placeholder') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $setting->email) }}" placeholder="{{ __('settings.email_placeholder') }}">
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">{{ __('Whatsapp') }}</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $setting->whatsapp) }}" placeholder="{{ __('settings.whatsapp_placeholder') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_en">{{ __('Address (EN)') }}</label>
                                <textarea name="address_en" id="address_en" class="form-control" rows="2" placeholder="{{ __('settings.address_placeholder') }}">{{ old('address_en', $setting->address_en) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="address_tr">{{ __('Address (TR)') }}</label>
                                <textarea name="address_tr" id="address_tr" class="form-control" rows="2" placeholder="{{ __('settings.address_placeholder') }}">{{ old('address_tr', $setting->address_tr) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="address_nl">{{ __('Address (NL)') }}</label>
                                <textarea name="address_nl" id="address_nl" class="form-control" rows="2" placeholder="{{ __('settings.address_placeholder') }}">{{ old('address_nl', $setting->address_nl) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-2"></i>{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endpush

@push('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            const initialLat = parseFloat(latInput.value) || 39.0;
            const initialLng = parseFloat(lngInput.value) || 35.0;

            const map = L.map('map').setView([initialLat, initialLng], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker([initialLat, initialLng], {draggable: true}).addTo(map);

            // Search (geocoder) control
            const geocoder = L.Control.geocoder({
                defaultMarkGeocode: false
            })
                .on('markgeocode', function(e) {
                    const latlng = e.geocode.center;
                    map.setView(latlng, 16);
                    marker.setLatLng(latlng);
                    updateLatLng(latlng.lat, latlng.lng);
                })
                .addTo(map);

            function updateLatLng(lat, lng) {
                latInput.value = lat.toFixed(7);
                lngInput.value = lng.toFixed(7);
                reverseGeocode(lat, lng);
            }

            // Reverse geocode sequentially (politeness to API)
            async function reverseGeocode(lat, lng) {
                const langs = { en: 'address_en', tr: 'address_tr', nl: 'address_nl' };

                for (const [lang, fieldId] of Object.entries(langs)) {
                    let attempts = 0;
                    while (attempts < 3) {
                        try {
                            const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=jsonv2&accept-language=${lang}&addressdetails=1`;
                            const resp = await fetch(url, { headers: { 'User-Agent': 'tourism-admin-panel/1.0' } });
                            if (!resp.ok) {
                                attempts++;
                                await new Promise(r => setTimeout(r, 1200));
                                continue;
                            }
                            const data = await resp.json();
                            if (data && data.display_name) {
                                const el = document.getElementById(fieldId);
                                if (el) el.value = data.display_name;
                                break; // success for this lang
                            }
                        } catch (e) {
                            // retry after wait
                        }
                        attempts++;
                        await new Promise(r => setTimeout(r, 1200));
                    }
                }
            }

            // Initial reverse geocode once if coords exist
            if (!isNaN(initialLat) && !isNaN(initialLng)) {
                reverseGeocode(initialLat, initialLng);
            }

            // Update inputs when marker dragged
            marker.on('dragend', function (e) {
                const pos = marker.getLatLng();
                updateLatLng(pos.lat, pos.lng);
            });

            // When map clicked move marker
            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                updateLatLng(e.latlng.lat, e.latlng.lng);
            });
        });
    </script>
@endpush
