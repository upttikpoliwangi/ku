<script>
    const allOptionsHasilKerja = $('#hasil-kerja-diintervensi option').clone();

    $('#peran-select').on('change', function () {
        const selectedPeranId = $(this).val();
        const hasilKerjaSelect = $('#hasil-kerja-diintervensi');

        hasilKerjaSelect.empty().append('<option value="">-- Pilih Hasil Kerja yang Diintervensi --</option>');

        allOptionsHasilKerja.each(function () {
            const peranId = $(this).data('peran-id');
            if (selectedPeranId === peranId?.toString()) {
                hasilKerjaSelect.append($(this));
            }
        });
    });
</script>
