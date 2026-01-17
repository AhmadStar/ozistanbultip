@php
        $ID=rand(10,999);
    @endphp
<style>
    .noselect {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .dropdown-container-{{ $ID}},
    .instructions {
        width: 200px;
        margin: 20px auto 0;
        font-size: 14px;
        font-family: sans-serif;
    }

    .instructions {
        width: 100%;
        text-align: center;
    }

    .dropdown-button-{{ $ID}} {
        float: left;
        width: 100%;
        background: whitesmoke;
        padding: 10px 12px;
        cursor: pointer;
        border: 1px solid lightgray;
        box-sizing: border-box;
    }

    .dropdown-button-{{ $ID}} .dropdown-label,
    .dropdown-button-{{ $ID}} .dropdown-quantity {
        float: left;
    }

    .dropdown-button-{{ $ID}} .dropdown-quantity {
        margin-left: 4px;
    }

    .dropdown-button-{{ $ID}} .fa-filter {
        float: right;
    }

    .dropdown-list-{{ $ID}} {
        float: left;
        width: 100%;
        border: 1px solid lightgray;
        border-top: none;
        box-sizing: border-box;
        padding: 10px 12px;
        background: #ffffff;
    }

    .dropdown-list-{{ $ID}} input[type=search] {
        padding: 5px 0;
    }

    .dropdown-list-{{ $ID}} ul {
        margin: 10px 0;
        max-height: 200px;
        overflow-y: auto;
    }

    .dropdown-list-{{ $ID}} ul input[type=checkbox] {
        position: relative;
        top: 2px;
    }

    .dropdown-list-{{ $ID}} ul li {
        padding-left: 10px;

    }

    .custom-dropdown-{{ $ID}} .dropdown-container-{{  $ID }} {
        width: 100%;
    }

</style>

@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif

@if ($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif


<div style="min-height: 120px" class="custom-dropdown-{{  $ID }}">
    {{-- <div class="instructions"> $options['label'] }}</div> --}}
    <div class="dropdown-container-{{  $ID }}">
        <div class="dropdown-button-{{  $ID }} noselect">
            <div class="dropdown-label">{{ __($options['label']) }}</div>
            <div class="dropdown-quantity">(<span class="quantity-{{  $ID }}">Any</span>)</div>
            <i class="fa fa-filter"></i>
        </div>
        <div class="dropdown-list-{{  $ID }}" style="display: none;">
            <input type="search" placeholder="Search.." class="dropdown-search-{{  $ID }}" />
            <ul id="dropdown-list-ul-{{  $ID }}"></ul>
        </div>
    </div>
</div>
@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif

<script>

    var current_value = <?= json_encode( $options['selected']) ?>;
    var name ="{{ $options['input_name'] }}";
    $('.dropdown-container-{{  $ID }}')
        .on('click', '.dropdown-button-{{  $ID }}', function() {
            $('.dropdown-list-{{  $ID }}').toggle();
        })
        .on('input', '.dropdown-search-{{  $ID }}', function() {
            var target = $(this);
            var search = target.val().toLowerCase();

            if (!search) {
                $('li').show();
                return false;
            }

            $('li').each(function() {
                var text = $(this).text().toLowerCase();
                var match = text.indexOf(search) > -1;
                $(this).toggle(match);
            });
        })
        .on('change', '[type="checkbox"]', function() {
            var numChecked = $('[type="checkbox"]:checked').length;
            $('.quantity-{{  $ID }').text(numChecked || 'Any');
        });

    // JSON of States for demo purposes
    var usStates = [


        <?php
        $selected =$options['selected'];
        foreach ($options['choices'] as $key => $val) {
            $checked = '';
            if (in_array($key, $selected)) {
                $checked = 'checked';
            }
            echo '{id: "' . $key . '", name: "' . $val . '",checked:"' . $checked . '"},';
        }
        ?>
    ];


    // Populate list with states
    _.each(usStates, function(s) {
        s.capName = _.startCase(s.name.toLowerCase());
        $('#dropdown-list-ul-{{  $ID }}').append('<li> <input name="'+name+'[' + s.id + ']" type="checkbox"  ' + s
            .checked + '><label for="' + s.name + '">' + s.name + '</label></li>');
    });






    {{-- var list =<?= json_encode($options['choices']) ?>; --}}
    {{-- var selected = []; --}}
    {{-- var current_values = ''; --}}
    {{-- $('#{{$options['attr']['id']}}').on('change', function () { --}}
    {{-- selected[this.value] = this.value; --}}
    {{-- if (current_values != '') --}}
    {{-- current_values = $('#{{$name}}-selected').val() + ',' + this.value; --}}
    {{-- else current_values = this.value; --}}
    {{-- $('#{{$name}}-selected').val(current_values); --}}
    {{-- $('#items-selected ul').append('<li style="padding: 5px;border: 1px solid #f2f2f2;">' + this.value + '<span data-lang="' + this.value + '" id="" style="float:right;color:#555;cursor: pointer;">x</span></li>'); --}}


    {{-- }); --}}
</script>
