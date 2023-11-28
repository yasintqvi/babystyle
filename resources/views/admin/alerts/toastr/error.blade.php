@if ($message = session()->get('error'))
    <script>
        NioApp.Toast("<h5>خطا</h5><p>{{  $message  }}</p>", 'error');
    </script>
@endif