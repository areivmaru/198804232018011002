<!-- Data Table JavaScript -->
<script src="<?= base_url() ?>public/cms/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>public/cms/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>


<script>
    $(document).ready(function() {
        showTable();
    })

    function showTable() {

        if ($.fn.DataTable.isDataTable('#tbl_general')) {
            $("#tbl_general").dataTable().fnDestroy();
            $('#tbl_general').empty();
        }

        var table = $('#tbl_general').DataTable({
            dom: 'Bfrtip',
            initComplete: function() {
                var api = this.api();
                $('#tbl_general_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            responsive: true,
            "ajax": {
                "type": 'POST',
                beforeSend: function() {
                    $('#pengguna').LoadingOverlay("show")
                },
                "url": '<?= base_url() ?>cms/users_json',
                "data": {
                    csrf_baseben: '<?= $this->security->get_csrf_hash() ?>'
                },
                complete: function() {
                    $('#pengguna').LoadingOverlay("hide")
                }
            },
            columns: [
                {
                    title: 'Id',
                    data: 'id',
                },
                {
                    title: 'Nama/NIP',
                    data: 'nama',
                    render: function(k, v, r) {
                        return '<span style="font-weight: 600;">' + r.nama + '</span>' + '<br><span class="text-secondary"><i class="uil uil-map-pin-alt mr-1"></i> ' + r.nip + '</span>'

                    }
                },
                {
                    title: 'Satker',
                    data: 'satuan_kerja',
                },
                {
                    title: 'Posisi',
                    data: 'posisi_yang_dipilih',
                },
                {
                    title: 'Bahasa/Framework',
                    data: 'nama',
                    render: function(k, v, r) {
                        return '<span style="font-weight: 600;">' + r.bahasa_pemrograman_yang_dikuasai + '</span>' + '<br><span class="text-secondary"><i class="uil uil-map-pin-alt mr-1"></i> ' + r.framework_bahasa_pemrograman_yang_dikuasai + '</span>'

                    }
                },
                {
                    title: 'Database/Tools',
                    data: 'nama',
                    render: function(k, v, r) {
                        return '<span style="font-weight: 600;">' + r.database_yang_dikuasai + '</span>' + '<br><span class="text-secondary"><i class="uil uil-map-pin-alt mr-1"></i> ' + r.tools_yang_dikuasai + '</span>'

                    }
                },
                {
                    title: 'Mobile Apps',
                    data: 'pernah_membuat_mobile_apps',
                },
                {
                    title: 'Jenis Attr',
                    data: 'jenis_attr',
                },
                {
                    title: 'Value',
                    data: 'value',
                },


            ],
            "scrollX": true,
            "displayLength": 5
        });

    }

  
    function after_update() {
        showTable()
    }

</script>