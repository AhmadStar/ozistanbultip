@php
    $supportedLocales = Language::getSupportedLocales();
    if (!isset($options) || empty($options)) {
        $options = [
            'before' => '',
            'lang_flag' => true,
            'lang_name' => true,
            'class' => '',
            'after' => '',
        ];
    }
@endphp

@php
    $languageDisplay = setting('language_display', 'all');
    $showRelated = setting('language_show_default_item_if_current_version_not_existed', true);
@endphp

<ul>
@foreach ($supportedLocales as $localeCode => $properties)
    <li>
        @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
            <a href="{{ $showRelated ? Language::getLocalizedURL($localeCode) : url($localeCode) }}">
                <span class="header-lang-flag">{!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}</span>
                <span>{{ $properties['lang_name'] }}</span>
            </a>
        @endif
    </li>
@endforeach
</ul>
