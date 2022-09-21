<label class="{{ "ch" . isset($attributes['large']) ? ' lrg' : '' }}">
    <input type="checkbox"
           name="{{ $attributes['name'] ?? '' }}"
           value="{{ $attributes['value'] ?? 1 }}"
        {{ isset($attributes['isRequired']) ? 'required="required' : '' }}
        {{ isset($attributes['isChecked']) ? 'checked="checked' : '' }}>
    @if(isset($attributes['text']))
        <span class="box"><i class="far fa-check"></i> </span><span class="text">{!! $attributes['text'] !!}</span>
    @endif
</label>
