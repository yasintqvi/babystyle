@if ($message = session()->get('info'))
    <script>
        NioApp.Toast("<h5>پیام</h5><p>{{  $message  }}</p>", 'info');
    </script>
@endif