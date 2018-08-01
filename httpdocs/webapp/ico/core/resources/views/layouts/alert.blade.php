@if (session('success'))
<script type="text/javascript">
        $(document).ready(function(){
        	swal("Success!", "{{ session('success') }}", "success");
        });
</script>
@endif

@if (session('alert'))
<script type="text/javascript">
        $(document).ready(function(){
            swal("Sorry!", "{{ session('alert') }}", "error");
        });
</script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Sorry!", "{{ $error }}", "error");
        });
    </script>
    @endforeach
@endif