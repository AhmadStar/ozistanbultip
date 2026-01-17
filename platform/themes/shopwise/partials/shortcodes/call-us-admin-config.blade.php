{{-- <div class="form-group mb-3">
    <label class="control-label">{{ __('Years Of Excellence') }}</label>
    <input type="text" name="experince" value="{{ Arr::get($attributes, 'experince') }}" class="form-control" placeholder="{{ __('Experince') }}">
</div>
 --}}

<div class="form-group mb-3">
    <label class="control-label">{{ __('text') }}</label>
    <textarea class="form-control" id="text" name="text" rows="4" cols="50">{{ Arr::get($attributes, 'text') }}</textarea>
</div>
