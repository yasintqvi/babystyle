@if(session()->has('warning'))
<script>
    Toastify({
        text:  "{{session()->get('warning')}}",
        close: true,
        stopOnFocus: true,
        style: {
            'background' : '#e6c212',
            'display' : 'flex',
        },
        position: 'center',
        gravity: 'top',
        offset: {
            'y' : 30
        }
    }).showToast();
</script>

@php
    session()->remove('warning');
@endphp

@endif