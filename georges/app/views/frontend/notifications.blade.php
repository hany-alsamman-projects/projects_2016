@if ($errors->any())
    notify('تنبيه', 'حدث خطأ', {
    vPos: 'bottom',
    hPos: 'right',
    icon: '{{asset('assets/images/standard/icon.png')}}',
    closeDelay: '4000',
    closeButton: false,
    showCloseOnHover: false,
    groupSimilar: false
});
@endif

@if ($message = Session::get('success'))
notify('تنبيه', '{{ Session::get('success') }}', {
    vPos: 'bottom',
    hPos: 'right',
    icon: '{{asset('assets/images/standard/icon_success.png')}}',
    closeDelay: '4000',
    closeButton: false,
    showCloseOnHover: false,
    groupSimilar: false
});
@endif

@if ($message = Session::get('error'))
notify('تنبيه', '{{ Session::get('error') }}', {
    vPos: 'bottom',
    hPos: 'right',
    icon: '{{asset('assets/images/standard/icon_error.png')}}',
    closeDelay: '4000',
    closeButton: false,
    showCloseOnHover: false,
    groupSimilar: false
});
@endif