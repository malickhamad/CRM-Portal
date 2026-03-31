@if ($message)
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: "{{ $title }}",
        text: "{{ $message }}",
        icon: "{{ $type }}",
        confirmButtonText: "OK"
    });
</script>
@endif
