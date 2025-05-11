{{-- Dropdown item --}}

@if(isset($item['header']))

    {{-- Header --}}
    <li class="dropdown-header">{{ $item['header'] }}</li>

@elseif(isset($item['text']))

    {{-- Item with URL and icon --}}
    <a class="dropdown-item {{ isset($item['active']) && $item['active'] ? 'active' : '' }}"
       href="{{ isset($item['url']) ? $item['url'] : '#' }}"
       @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
       {!! isset($item['data-toggle']) ? 'data-toggle="'.$item['data-toggle'].'"' : '' !!}
       @if(isset($item['onclick'])) onclick="{{ $item['onclick'] }}" @endif>

        @isset($item['icon'])
            <i class="{{ $item['icon'] }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
        @endisset

        {{ $item['text'] }}

        @if(isset($item['label']))
            <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                {{ $item['label'] }}
            </span>
        @endif
    </a>

@elseif(isset($item['divider']))

    {{-- Divider --}}
    <div class="dropdown-divider"></div>

@endif
