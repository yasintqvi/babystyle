@if ($message = session()->get('warning'))
    <script>
        NioApp.Toast("<h5>هشدار</h5><p>{{  $message  }}</p>", 'warning');
    </script>
@endif