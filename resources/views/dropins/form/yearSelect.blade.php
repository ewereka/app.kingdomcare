@php
    $tempYearArray = array('' => 'Year');
    $currentYear = date('Y');
    $minYear = $currentYear - 100;
    for ($i = $minYear; $i <= $currentYear; $i++) {
        $tempYearArray[sprintf('%d', $i)] = sprintf('%d', $i);
    }
@endphp
{{ Form::select('dob_year', $tempYearArray , old('dob_year'), array(
    'class' => 'select',
    'size' => 1,
    'onmousedown' => 'if(this.options.length>3){this.size=3;}',
    'onchange' => 'this.size=1;',
    'onblur' => 'this.size=1;',
    'autocomplete' => 'bday-year')
) }}
