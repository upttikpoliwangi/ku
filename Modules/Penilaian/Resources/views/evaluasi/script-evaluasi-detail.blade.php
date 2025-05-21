<script>
    // $(document).ready(() => {
    //     $('#form-umpan-balik').on('submit', function(event) {
    //         event.preventDefault();

    //         $.ajax({
    //             url: '/penilaian/predikat-kinerja',
    //             type: 'GET',
    //             data: $(this).serialize(),
    //             success: (response) => {
    //                 console.log(response)
    //             },
    //             error: (response) => {
    //                 console.log(response.responseJSON.message)
    //             }
    //         });
    //     });
    // })

    // $('#umpanBalikForm').on('submit', function(e) {
    //     e.preventDefault();

    //     $.ajax({
    //         url: '/penilaian/evaluasi/proses-umpan-balik/{{ $pegawai->username }}',
    //         type: 'POST',
    //         data: $(this).serialize(),
    //         success: function(response) {
    //             try {
    //                 umpanBalikBox.style.display = 'block'
    //                 console.log(response)

    //             } catch (error) {
    //                 console.log(error)
    //             }
    //         },
    //         error: function(xhr) {
    //             $('#result').html('<p style="color: red;">Gagal mengirim umpan balik.</p>');
    //         }
    //     });
    // });

    const rekomendasiRatingHasilKerja = document.querySelector('#rekomendasi-rating-hasil-kerja');
    const rekomendasiRatingPerilaku = document.querySelector('#rekomendasi-rating-perilaku');
    const selectRatingHasilKerja = document.querySelector('#rating-hasil-kerja-select');
    const selectRatingPerilaku = document.querySelector('#rating-perilaku-select');
    const textareaRatingHasilKerja = document.querySelector('#textarea-rating-hasil-kerja');
    const textareaRatingPerilaku = document.querySelector('#textarea-rating-perilaku');

    const valRatHasilKerja = rekomendasiRatingHasilKerja.value;
    const valRatPerilaku = rekomendasiRatingPerilaku.value;

    selectRatingHasilKerja.addEventListener('change', () => {
        const valSelRatHasilKerja = selectRatingHasilKerja.value;

        if(valSelRatHasilKerja == valRatHasilKerja) {
            textareaRatingHasilKerja.classList.add('d-none')
        } else {
            textareaRatingHasilKerja.classList.remove('d-none')
        }
    })

    selectRatingPerilaku.addEventListener('change', () => {
        const valSelRatPerilaku = selectRatingPerilaku.value;

        if(valSelRatPerilaku == valRatPerilaku) {
            textareaRatingPerilaku.classList.add('d-none')
        } else {
            textareaRatingPerilaku.classList.remove('d-none')
        }
    })

</script>
