<script>
    const colorStatus = (status) => {
        if(status == 'Belum Diajukan') {
            return `danger`
        }else if (status == 'Belum Dievaluasi') {
            return `secondary`
        }else if (status == 'Sudah Diajukan' || status == 'Sudah Dievaluasi'){
            return 'success'
        }
    }

    $(document).ready(function() {
        $('#table-pegawai').DataTable({
            responsive: true,
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/penilaian/evaluasi/data-pegawai',
                type: 'GET',
                dataSrc: function (response) {
                    try {
                        return response.data.map((data) => {
                            return {
                                id: data.pegawai.id,
                                nama: data.pegawai.nama,
                                username: data.pegawai.username,
                                rencanakerja: data.pegawai.rencanakerja,
                                jabatan: data.pegawai.jabat,
                            }
                        })
                    } catch (error) {
                        console.log(response)
                    }
                },
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    orderable: true
                },
                {
                    data: 'nama',
                    name: 'nama',
                    orderable: true
                },
                {
                    data: null,
                    name: 'jabatan',
                    orderable: true,
                    render: (data, type, row) => {
                        return '-'
                    }
                },
                {
                    data: null,
                    name: 'status',
                    orderable: true,
                    render: (data, type, row) => {
                        const arrayRencana = row.rencanakerja
                        if(arrayRencana.length != 0) {
                            return `<span class="badge badge-${colorStatus(row.rencanakerja[0].status_realisasi)}" style="width: fit-content">
                                        ${row.rencanakerja[0].status_realisasi}
                                    </span>`
                        }else {
                            return `<span class="badge badge-danger">Belum Diajukan</span>`
                        }
                    }
                },
                {
                    data: null,
                    name: 'predikatKinerja',
                    orderable: true,
                    render: (data, type, row) => {
                        const arrayRencana = row.rencanakerja
                        if(arrayRencana.length != 0) {
                            return `<span>${row.rencanakerja?.[0]?.predikat_akhir ?? '-'}</span>`
                        }else {
                            return `<span>-</span>`
                        }
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button onclick="window.location.href='/penilaian/evaluasi/${row.username}/detail'" type="button" class="btn btn-primary"><i class="nav-icon fas fa-pencil-alt "></i></button>
                        `;
                    }
                },
            ],
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            processing: true,
            serverSide: true,
            stateSave: true,
        });
    });
</script>
