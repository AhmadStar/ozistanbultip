<div class="form-group mb-3">
    <label class="control-label">{{ __('Years Of Excellence') }}</label>
    <input type="text" name="experince" value="{{ Arr::get($attributes, 'experince') }}" class="form-control" placeholder="{{ __('Experince') }}">
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('Welcome') }}</label>
    <input type="text" name="welcome" value="{{ Arr::get($attributes, 'welcome') }}" class="form-control" placeholder="{{ __('Welcome') }}">
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('text') }}</label>
    <textarea class="form-control" id="text" name="text" rows="4" cols="50">{{ Arr::get($attributes, 'text') }}</textarea>
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('youtube') }}</label>
    <input type="text" name="youtube" value="{{ Arr::get($attributes, 'youtube') }}" class="form-control" placeholder="{{ __('youtube') }}">
</div>


