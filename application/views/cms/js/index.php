<script>
    console.log('Ini Addons JS Berlaku Global');


    let timerInterval
    $(document).ready(function() {
        if ('<?= $this->session->flashdata('alert') ?>' == 'success') {
            Swal.fire({
                title: 'Success!',
                icon: 'success',
                html: '<?= $this->session->flashdata('message') ?> <br><br> I will close in <b></b> milliseconds.',
                timer: ('<?= $this->session->flashdata('timer') ?>' != '') ? <?= $this->session->flashdata('timer') ?>0 : 1000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__jackInTheBox'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutDown'
                },
                buttonsStyling: false,
                customClass: {
                    popup: 'border-radius-0'
                },
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getHtmlContainer()
                        if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                                b.textContent = Swal.getTimerLeft()
                            }
                        }
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    //    console.log('I was closed by the timer')
                }
            })
        } else if ('<?= $this->session->flashdata('alert') ?>' == 'error') {
            Swal.fire({
                title: 'Error!',
                icon: 'error',
                html: '<?= $this->session->flashdata('message') ?><br><br>' + 'I will close in <b></b> milliseconds.',
                timer: 5000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__jackInTheBox'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutDown'
                },
                buttonsStyling: false,
                customClass: {
                    popup: 'border-radius-0'
                },
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getHtmlContainer()
                        if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                                b.textContent = Swal.getTimerLeft()
                            }
                        }
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    //    console.log('I was closed by the timer')
                }
            })
        }

    })

    
    //BOOTSTRAP CLIENT SIDE VALIDATION
    $(function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })

    $(".reset").click(function() {
        $(this).closest('form').find("input[type=text],input[type=password],input[type=hidden], textarea").val("");
        $('input[name=csrf_baseben]').val('<?= $this->security->get_csrf_hash() ?>')
    });


    //REQUIRED * HTML
    $.each($('input:not(:checkbox):not(:radio)[required],textarea[required],select[required]').parent().find('label'), function(k, v) {
        $(v).html($(v).html() + ' <b style="color:red">*</b>')
    })

    $.each($('input:radio[required],input:checkbox[required]').parent().parent().children('label'), function(k, v) {
        $(v).html($(v).html() + ' <b style="color:red">*</b>')
    })

    function update(id, status, table, primary) {
        if (status == 'Deleted') {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang telah terhapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>meeting/update_status',
                        type: 'POST',
                        data: {
                            'key': id,
                            'key_name': primary,
                            'table_name': table,
                            'status': status,
                            'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
                        },
                        success: function(response) {
                            response = JSON.parse(response)
                            if (response.kode == 200) {
                                Swal.fire({
                                    title: 'Sukses!',
                                    icon: 'success',
                                    showClass: {
                                        popup: 'animate__animated animate__jackInTheBox'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutDown'
                                    },
                                    buttonsStyling: false,
                                    customClass: {
                                        popup: 'border-radius-0'
                                    },
                                    html: 'I will close in <b></b> milliseconds.',
                                    timer: 1000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(() => {
                                            const content = Swal.getHtmlContainer()
                                            if (content) {
                                                const b = content.querySelector('b')
                                                if (b) {
                                                    b.textContent = Swal.getTimerLeft()
                                                }
                                            }
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        //    console.log('I was closed by the timer')
                                    }
                                })
                                after_update()
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    icon: 'warning',
                                    html: 'I will close in <b></b> milliseconds.',
                                    timer: 1000,
                                    timerProgressBar: true,
                                    showClass: {
                                        popup: 'animate__animated animate__jackInTheBox'
                                    },
                                    hideClass: {
                                        popup: 'animate__animated animate__fadeOutDown'
                                    },
                                    buttonsStyling: false,
                                    customClass: {
                                        popup: 'border-radius-0'
                                    },
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(() => {
                                            const content = Swal.getHtmlContainer()
                                            if (content) {
                                                const b = content.querySelector('b')
                                                if (b) {
                                                    b.textContent = Swal.getTimerLeft()
                                                }
                                            }
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        //    console.log('I was closed by the timer')
                                    }
                                })
                            }
                        }
                    })
                }
            })
        } else {
            $.ajax({
                url: '<?= base_url() ?>meeting/update_status',
                type: 'POST',
                data: {
                    'key': id,
                    'key_name': primary,
                    'table_name': table,
                    'status': status,
                    'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
                },
                success: function(response) {
                    response = JSON.parse(response)
                    if (response.kode == 200) {
                        Swal.fire({
                            title: 'Sukses!',
                            icon: 'success',
                            showClass: {
                                popup: 'animate__animated animate__jackInTheBox'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutDown'
                            },
                            buttonsStyling: false,
                            customClass: {
                                popup: 'border-radius-0'
                            },
                            html: 'I will close in <b></b> milliseconds.',
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                timerInterval = setInterval(() => {
                                    const content = Swal.getHtmlContainer()
                                    if (content) {
                                        const b = content.querySelector('b')
                                        if (b) {
                                            b.textContent = Swal.getTimerLeft()
                                        }
                                    }
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                //    console.log('I was closed by the timer')
                            }
                        })
                        after_update()
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            icon: 'warning',
                            html: 'I will close in <b></b> milliseconds.',
                            timer: 1000,
                            timerProgressBar: true,
                            showClass: {
                                popup: 'animate__animated animate__jackInTheBox'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutDown'
                            },
                            buttonsStyling: false,
                            customClass: {
                                popup: 'border-radius-0'
                            },
                            didOpen: () => {
                                Swal.showLoading()
                                timerInterval = setInterval(() => {
                                    const content = Swal.getHtmlContainer()
                                    if (content) {
                                        const b = content.querySelector('b')
                                        if (b) {
                                            b.textContent = Swal.getTimerLeft()
                                        }
                                    }
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                //    console.log('I was closed by the timer')
                            }
                        })
                    }
                }
            })
        }

    }
</script>