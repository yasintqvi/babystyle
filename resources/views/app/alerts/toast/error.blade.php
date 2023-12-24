@if (session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function(event) {
            Toastify({
                text: "{{ session()->get('error') }}",
                close: true,
                stopOnFocus: true,
                style: {
                    'background': '#eb1c1c',
                    'display': 'flex',
                },
                position: 'center',
                gravity: 'top',
                offset: {
                    'y': 30
                }
            }).showToast();
        });
    </script>

    @php
        session()->remove('error');
    @endphp
@endif
