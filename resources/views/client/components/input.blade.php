@if(!isset($attributes['type']))
    {{ $attributes['type'] = 'text' }}
@endif

@if(empty($attributes['icon']))
    @php
        $attributes['classes'] .= ' no-ico';
    @endphp
@endif

@switch($attributes['type'])
    @case('textarea')
        @php
            $input = '<textarea name="' . $attributes['name'] . '" placeholder="' . $attributes['placeholder'] . '" ' . $attributes['attrs'] . '></textarea>'
        @endphp
    @break
    @default
        @php
            $input = '<input type="' . (in_array($attributes['type'], ['phone']) ? 'text' : $attributes['type']) . '" name="' . $attributes['name'] . '" placeholder="' . $attributes['placeholder'] . '" ' . $attributes['attrs'] . '>'
        @endphp
@endswitch

@if($attributes['type'] === 'phone')
    @php
        $input = '
            <div class="phone-prefix-select">
                <select class="select" name="phone_prefix"' . (strpos($attributes['attrs'], 'required') !== false ? ' required="required"' : '') . '>
                    <option value="386" selected>+386</option>
                    <option value="385">+385</option>
                </select>
            </div>' . $input
    @endphp
@endif

<div class="input input-type-{{ $attributes['type'] . ' ' . $attributes['classes'] }}">{{ !empty($attributes['labelText']) ? '<strong>' . $attributes['labelText'] . '</strong>' : '' }}
    <div class="input-inner">
        {!! $input !!}
        <div class="input-decor">
            <i class="decor {{ $attributes['icon'] }}"></i>
            <i class="error-ico fas fa-exclamation-circle"></i>
            {!! isset($attributes['belowText']) ? '<p class="below-msg">' . $attributes['belowText'] . '</p>' : '' !!}
            <p class="error-msg">{{ $attributes['errorMessage'] ?? '' }}</p>
            {!! isset($attributes['afterText']) ? '<span class="after-text">' . $attributes['afterText'] . '</span>' : '' !!}
        </div>
    </div>
</div>
