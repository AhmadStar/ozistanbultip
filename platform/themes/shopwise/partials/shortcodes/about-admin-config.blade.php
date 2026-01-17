<div class="form-group mb-3">
    <label class="control-label">{{ __('title1') }}</label>
    <input type="text" name="title1" value="{{ Arr::get($attributes, 'title1') }}" class="form-control" placeholder="{{ __('title1') }}">
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('title2') }}</label>
    <input type="text" name="title2" value="{{ Arr::get($attributes, 'title2') }}" class="form-control" placeholder="{{ __('title2') }}">
</div>

<div class="form-group">
    <label class="control-label">{{ __('image1') }}</label>
    {!! Form::mediaImage('image1', Arr::get($attributes, 'image1')) !!}
</div>

<div class="form-group">
    <label class="control-label">{{ __('image2') }}</label>
    {!! Form::mediaImage('image2', Arr::get($attributes, 'image2')) !!}
</div>

<div class="form-group">
    <label class="control-label">{{ __('image3') }}</label>
    {!! Form::mediaImage('image3', Arr::get($attributes, 'image3')) !!}
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('mission') }}</label>
    <textarea class="form-control" id="mission" name="mission" rows="4" cols="50">{{ Arr::get($attributes, 'mission') }}</textarea>
</div>

<div class="form-group mb-3">
    <label class="control-label">{{ __('vision') }}</label>
    <textarea class="form-control" id="vision" name="vision" rows="4" cols="50">{{ Arr::get($attributes, 'vision') }}</textarea>
</div>


