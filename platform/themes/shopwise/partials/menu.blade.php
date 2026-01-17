@foreach ($menu_nodes as $key => $row)
    <li @if ($row->has_child || $row->css_class || $row->active) @endif class="nav-item">
        <a class="@if ($row->has_child) dropdown-toggle nav-link @else nav-link @endif" href="{{ $row->has_child ? '#' : url($row->url) }}" @if ($row->target !== '_self') target="{{ $row->target }}" @endif @if ($row->has_child) data-toggle="dropdown" @endif>
            @if ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif {{ $row->title }}
        </a>
        @if ($row->has_child)
            <ul class="dropdown-menu">
                {!! Menu::generateMenu([
                    'menu'       => $menu,
                    'menu_nodes' => $row->child,
                    'view'       => 'sub-menu',
                ]) !!}
            </ul>
        @endif
    </li>
@endforeach
