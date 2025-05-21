<script>
    // $(document).ready(function() {
    //     $('#table-periode').Datatable({
    //         responsive: true,
    //         scrollX: true,
    //         processing: true,
    //         serverSide: true,
    //         ajax: {
    //             url: '',
    //             type: 'GET',
    //             dataSrc: function (response) {

    //             },
    //         },
    //     })
    // })
    $('#nama-unit').on('change', function () {
        var selectedValue = $(this).val();
        $('#peran').val(selectedValue);
    });
    $('#peran').on('change', function () {
        var selectedValue = $(this).val();
        $('#nama-unit').val(selectedValue);
    });

    const allOptions = $('#periode-range option').toArray();

    $('#periode-tahun').on('change', function () {
        const selectedYear = $(this).find('option:selected').data('tahun'); // ambil tahun dari atribut data-tahun
        $('#periode-range').empty().append('<option value="">-- Pilih Periode --</option>');
        const filtered = allOptions.filter(opt => $(opt).data('tahun') == selectedYear);
        $('#periode-range').append(filtered);
    });
</script>
