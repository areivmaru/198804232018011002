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
    console.log('Ini Addons JS Berlaku di Halaman Pengguna CMS Saja');
</script>

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
            columns: [{
                    title: 'No',
                    data: 'no',
                    orderable: false
                },
                {
                    title: 'Photo',
                    data: 'NIP',
                    render: function(k, v, r) {
                        return '<img width="70px" class="img-thumbnail" src="<?= base_url() ?>public/cms/upload/user/' + ((r.updatedon == 'null' || r.updatedon == null) ? r.createdon : r.updatedon).substr(0, 4) + '/' + r.foto + '" onerror="this.onerror=null;this.src=\'<?= base_url() ?>res/f/images/avatar/avatar_' + gender_profile + '.png\'" width="20" alt="" />'
                    }
                },
                {
                    title: 'NIP',
                    data: 'NIP'
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    render: function(k, v, r) {
                        return '<span style="font-weight: 600;">' + r.nama + '</span>' + '<br><span class="text-primary"><i class="uil uil-map-pin-alt mr-1"></i> ' + r.email + '</span>'

                    }
                },
                {
                    title: 'Status',
                    data: 'status',
                    render: function(k, v, r) {
                        if (r.status == 'Aktif') {
                            return '<span class="badge light badge-success"><i class="uil uil-check-circle"></i> ' + r.status + '</span>'
                        } else {
                            return '<span class="badge light badge-danger"><i class="uil uil-times-circle"></i> ' + r.status + '</span>'
                        }
                    },
                    className: 'text-center'
                },
                {
                    title: 'Aksi',
                    data: 'user_id',
                    render: function(k, v, r) {
                        var button_color = 'btn-danger'
                        var status = 'Tidak Aktif'
                        if (r.status == 'Tidak Aktif') {
                            button_color = 'btn-success'
                            status = 'Aktif'
                        }

                        return '<div class="d-flex">' +
                            '<button class="btn btn-warning shadow btn-xs sharp mr-1" onclick="edit(\'' + r.user_id + '\')" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen"></i></button>' +
                            '<button class="btn ' + button_color + ' shadow btn-xs sharp mr-1" onclick="update(\'' + r.user_id + '\',\'' + status + '\',\'tbl_pengguna\',\'user_id\')" data-toggle="tooltip" data-placement="top" title="' + status + 'kan"><i class="uil uil-toggle-on"></i></button>' +
                            '<button class="btn btn-danger shadow btn-xs sharp" onclick="update(\'' + r.user_id + '\',\'Deleted\',\'user\',\'user_id\')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="uil uil-trash"></i></button>' +
                            '</div>'

                    },
                    className: 'text-center'
                }

            ],
            "scrollX": true,
            "displayLength": 5
        });

    }

    function tambah() {
        $('#nama').val('')
        $('#nip').val('')
        $('#password').val('')
        $('#email').val('')
        $('#user_id').val('')
        $('#password').prop('required', true)
        $('#modal_title').html('<i class="uil uil-user-plus"></i> Tambah Pengguna')
        $('#modal_general').modal('show')
    }

    function edit(id) {
        $.ajax({
            url: '<?= base_url() ?>users/users_json',
            type: 'POST',
            data: {
                'user_id': id,
                'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response)
                $('#nip').val(response.data[0].nip)
                $('#nama').val(response.data[0].nama)
                $('#email').val(response.data[0].email)
                $('#user_id').val(response.data[0].user_id)
            }
        })


        $('#modal_title').text('Edit Pengguna')
        $('#modal_general').modal('show')
    }

    function after_update() {
        showTable()
    }

    jQuery(document).ready(function() {

        jQuery('.show-pass').on('click', function() {
            jQuery(this).toggleClass('active');
            if (jQuery('#password').attr('type') == 'password') {
                jQuery('#password').attr('type', 'text');
            } else if (jQuery('#password').attr('type') == 'text') {
                jQuery('#password').attr('type', 'password');
            }
        });



    });
</script>