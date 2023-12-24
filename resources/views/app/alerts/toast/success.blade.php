@if (session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function(event) {
            Toastify({
                text: "{{ session()->get('success') }}",
                close: true,
                stopOnFocus: true,
                style: {
                    'background': '#33d460',
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
        session()->remove('success');
    @endphp
@endif
