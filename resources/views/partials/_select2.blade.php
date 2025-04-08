@props(['selector', 'placeholder'])
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('{{ $selector }}').select2({
            placeholder: "{{ $placeholder }}",
            allowClear: true,
            width: '100%' // Ensures it spans the full width
        }).next('.select2-container').find('.select2-selection--single').addClass('form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200');
    });
</script>