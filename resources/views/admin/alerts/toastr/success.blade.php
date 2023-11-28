@if ($message = session()->get('success'))
    <script>
        NioApp.Toast("<h5>موفقیت آمیز</h5><p>{{  $message  }}</p>", 'success');
    </script>
@endif
