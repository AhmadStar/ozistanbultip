<div class="section pt-0 small_pb"
    style="display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(https://www.ozistanbultipmerkezi.com/tr/prosses/blarge/orginal/p1cql3mj6uba1dnfqr0s4p1hp66.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    ">
    <div class="container">
        <div class="heading_tab_header">
            <div class="heading_s2">
                <h4>{!! clean($title) !!}</h4>
            </div>
        </div>
        <appointment-form-component url="{{ route('public.ajax.clinic-list') }}" lang="{{ app()->getLocale() }}">></appointment-form-component>
    </div>
</div>
