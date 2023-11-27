<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // GLobal functions
    function showModal(selector) {
        $('#'+selector).modal('show')
    }

    function hideModal(selector) {
        $('#'+selector).modal('hide')
    }

    $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

    $(document).ready(function(){
        $('#init-table').DataTable({
            "dom": '<lf<t>ip>'
            });

        // var dispo_count = parseInt($('.disposition_count').text())
        // var exit_count = parseInt($('.exit_count').text())
        // var leave_count = parseInt($('.leave_count').text())
        // var outgoing_count = parseInt($('.outgoing_count').text())
        // var inbox_count = parseInt($('.inbox_count').text())
        // var done_count = parseInt($('.done_count').text())
        // var proceed_count = parseInt($('.proceed_count').text())

        // var title_conf = { requireBlur:true, stopOnFocus:true, interval:3000 }

        // const Toast = Swal.mixin({
        //       toast: true,
        //       position: 'top-end',
        //       showConfirmButton: false,
        //       height: 600,
        //       timer: 5000,
        //       timerProgressBar: true,
        //       didOpen: (toast) => {
        //         toast.addEventListener('mouseenter', Swal.stopTimer)
        //         toast.addEventListener('mouseleave', Swal.resumeTimer)
        //       },
        //       onOpen: function () {
        //             var audplay = new Audio("{{asset('tone.mp3')}}");
        //             audplay.play();
        //         }
        //     })

        // var pusher = new Pusher('9b20901b264fe57d21bd', {
        //   cluster: 'ap1',
        //   encrypted:true
        // });



        // window.Echo = new Echo({
        //     broadcaster: 'pusher',
        //     key: '9b20901b264fe57d21bd',
        //     cluster: 'ap1',
        //     forceTLS: true,
        //     wsHost: window.location.hostname,
        //     wsPort: 8000,
        // });

        // window.Echo.private('App.Models.User.' + user)
        // .notification((notification) => {
        //     if(notification.notif_type == 'disposition'){
        //         dispo_count += 1
        //         $('.disposition_count').text(dispo_count);

        //         Toast.fire({
        //               icon: 'info',
        //               title: 'Anda mendapat ' + dispo_count + ' surat disposisi baru'
        //             })

        //         $.titleAlert('(' + dispo_count + ') surat disposisi baru', title_conf);
        //         $('#init-table').DataTable().ajax.reload();

        //     } else if(notification.notif_type == 'exit'){
        //         exit_count += 1
        //         $('.exit_count').text(exit_count);

        //         Toast.fire({
        //               icon: 'info',
        //               title: 'Anda mendapat ' + exit_count + ' surat keluar kantor baru'
        //             })

        //         $.titleAlert('('+ exit_count + ') surat keluar kantor baru', title_conf);
        //         $('#init-table').DataTable().ajax.reload();

        //     }  else if(notification.notif_type == 'leave'){
        //         leave_count += 1
        //         $('.leave_count').text(leave_count);

        //         Toast.fire({
        //               icon: 'info',
        //               title: 'Anda mendapat ' + leave_count + ' surat cuti baru'
        //             })

        //         $.titleAlert('(' + leave_count + ') surat cuti baru', title_conf);
        //         $('#init-table').DataTable().ajax.reload();

        //     }  else if(notification.notif_type == 'outgoing'){
        //         outgoing_count += 1
        //         $('.outgoing_count').text(outgoing_count);

        //         Toast.fire({
        //               icon: 'info',
        //               title: 'Anda mendapat ' + outgoing_count + ' surat keluar baru'
        //             })

        //         $.titleAlert('(' + outgoing_count + ') surat keluar baru', title_conf);
        //         $('#init-table').DataTable().ajax.reload();

        //     } else if(notification.notif_type == 'inbox'){
        //         inbox_count += 1
        //         $('.inbox_count').text(inbox_count);

        //         Toast.fire({
        //               icon: 'info',
        //               title:  inbox_count + ' dokumen masuk'
        //             })

        //         $.titleAlert('(' + inbox_count + ') dokumen masuk', title_conf);
        //         $('#init-table').DataTable().ajax.reload();

        //     } else if(notification.notif_type == 'done'){
        //         done_count += 1
        //         $('.done_count').text(done_count);

        //         Toast.fire({
        //               icon: 'info',
        //               title:  done_count + ' dokumen selesai'
        //             })

        //         $.titleAlert('(' + done_count + ') dokumen selesai', title_conf);
        //         $('#init-table').DataTable().ajax.reload();
        //     }

        //     else if(notification.notif_type == 'proceed'){
        //         proceed_count += 1
        //         $('.proceed_count').text(proceed_count);

        //         Toast.fire({
        //               icon: 'info',
        //               title:  proceed_count + ' dokumen diproses'
        //             })

        //         $.titleAlert('(' + proceed_count + ') dokumen diproses', title_conf);
        //         $('#init-table').DataTable().ajax.reload();
        //     }


        });

    });

</script>
