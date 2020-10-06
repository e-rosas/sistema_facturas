@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header')
Hospital México de B.C. S.A. de C.V.
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
{{ date('Y') }} Hospital México de B.C. S.A. de C.V.
@endcomponent
@endslot
@endcomponent
