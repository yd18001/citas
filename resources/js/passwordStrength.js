<script>
    $(function() {
        $('#password').keyup(function() {
            var password = $(this).val();
            var error = '';
            if (password.length < 8) {
                error = 'La contraseña debe tener al menos 8 caracteres';
            }
            $('#password-error').text(error);
        })
    });
</script>
