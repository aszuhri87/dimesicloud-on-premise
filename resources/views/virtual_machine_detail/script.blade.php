<script type="text/javascript">
    $(document).ready(function(){
        $('#select-filter').select2({
            placeholder: "Select a state"
        });
        $('[data-toggle="tooltip"]').tooltip()

        let series_config = $("#select-filter").val().split(',')
        getSeries(series_config[0], series_config[1])
        getNetwork()



        setInterval(function(){
            getCurrentStatus()
            getOS()
        },1000)

        setInterval(function(){
            let series_config = $("#select-filter").val().split(',')
            getSeries(series_config[0], series_config[1])
            getNetwork()
        },10000)
        initAction()
    })

    const initAction = ()=>{

        $("#select-filter").change(function(){
            let series_config = $("#select-filter").val().split(',')
            getSeries(series_config[0], series_config[1])
        })

        $(document).on('click', '.btn-console', function(event){
            event.preventDefault();
            let url = $(this).attr('href')
            window.open(url, '_blank', 'location=yes');
        });

        $(document).on('click', '.btn-start', function(event){
            event.preventDefault();
            let url = $(this).attr('href')
            Swal.fire({
                title: "Are you sure?",
                text: "You will start virtual machine!",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Start!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                    })
                    .done(function(res, xhr, meta) {
                        toastr.success(res.message);
                    })
                    .fail(function(res, error) {
                        toastr.error(res.responseJSON.message, 'Error')
                    })
                    .always(function() {

                    });

                }
            });
        });

        $(document).on('click', '.btn-restart', function(event){
            event.preventDefault();
            let url = $(this).attr('href')
            Swal.fire({
                title: "Are you sure?",
                text: "You will restart virtual machine!",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Restart!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                    })
                    .done(function(res, xhr, meta) {
                        toastr.success(res.message);
                    })
                    .fail(function(res, error) {
                        toastr.error(res.responseJSON.message, 'Error')
                    })
                    .always(function() {

                    });

                }
            });
        });




        $(document).on('click', '.btn-shutdown', function(event){
            event.preventDefault();
            let url = $(this).attr('href')
            Swal.fire({
                title: "Are you sure?",
                text: "You will shutdown virtual machine!",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Shutdown!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                    })
                    .done(function(res, xhr, meta) {
                        toastr.success(res.message);
                    })
                    .fail(function(res, error) {
                        toastr.error(res.responseJSON.message, 'Error')
                    })
                    .always(function() {

                    });

                }
            });
        });
    },
    getMonitor = ()=>{
        let node = '{{ Request::segment(2) }}';
        let vmid = '{{ Request::segment(3) }}'
        $.ajax({
            url: `{{ url('virtual_machine/resources') }}/${node}/${vmid}`,
            type: 'get',
        })
        .done(function(res, xhr, meta) {
            $("#cpu-info").text(`of ${res.data.cpus} CPU(s)`)
            $("#cpu-presentace").text(`${(res.data.cpu * 100).toFixed(2)} %`)

            $("#mem-info").text(`${bytesToSize(res.data.mem)} of ${bytesToSize(res.data.maxmem)}`)
            $("#mem-presentace").text(`${(res.data.mem/res.data.maxmem * 100).toFixed(2)} %`)

            $("#disk-info").text(`${bytesToSize(res.data.maxdisk)}`)

        })
        .fail(function(res, error) {
            toastr.error(res.responseJSON.message, 'Error')
        })
        .always(function() {

        });
    },
    getSeries = (unit, type)=>{
        let node = '{{ Request::segment(2) }}';
        let vmid = '{{ Request::segment(3) }}'


        $.ajax({
            url: `{{ url('virtual_machine/series') }}/${node}/${vmid}/${unit}/${type}`,
            type: 'get',
        })
        .done(function(res, xhr, meta) {
            cpuLineChart(res.data.cpu, res.data.category)
            memoryLineChart(res.data.mem, res.data.category)
            networkLineChart(res.data.netin, res.data.netout, res.data.category)
            diskLineChart(res.data.diskwrite, res.data.diskread, res.data.category)
        })
        .fail(function(res, error) {
            toastr.error(res.responseJSON.message, 'Error')
        })
        .always(function() {

        });
    },
    getCurrentStatus = ()=>{
        let node = '{{ Request::segment(2) }}';
        let vmid = '{{ Request::segment(3) }}'
        $.ajax({
            url: `{{ url('virtual_machine/current') }}/${node}/${vmid}`,
            type: 'get',
        })
        .done(function(res, xhr, meta) {
            $("#vm-name").text(res.data.name.toUpperCase())
            $("#cpu-info").text(`${(res.data.cpu * 100).toFixed(2) }% of ${res.data.cpus} CPU(s)`)
            $("#mem-info").text(`${bytesToSize(res.data.mem)} of ${bytesToSize(res.data.maxmem)}`)
            $("#disk-info").text(`${bytesToSize(res.data.maxdisk)}`)
            $("#uptime").text(secondsToDhms(res.data.uptime))

            let element = res.data.status == 'running' ?
                                `<span class="badge badge-primary">
                                    ${res.data.status.toUpperCase()}
                                </span>`
                                :
                                `<span class="badge badge-danger">
                                    ${res.data.status.toUpperCase()}
                                </span>`;

            $("#status-info").html(element)

        })
        .fail(function(res, error) {
            toastr.error(res.responseJSON.message, 'Error')
        })
        .always(function() {

        });
    },
    getNetwork = ()=>{
        let node = '{{ Request::segment(2) }}';
        let vmid = '{{ Request::segment(3) }}'
        $.ajax({
            url: `{{ url('virtual_machine/network') }}/${node}/${vmid}`,
            type: 'get',
        })
        .done(function(res, xhr, meta) {
            $("#ip-info").text(res.data.ip)

        })
        .fail(function(res, error) {
            toastr.error(res.responseJSON.message, 'Error')
        })
        .always(function() {

        });
    },
    getOS = ()=>{
        let node = '{{ Request::segment(2) }}';
        let vmid = '{{ Request::segment(3) }}'
        $.ajax({
            url: `{{ url('virtual_machine/os') }}/${node}/${vmid}`,
            type: 'get',
        })
        .done(function(res, xhr, meta) {
            $("#image-info").text(`${res.data['pretty-name']} ${res.data.machine}`)
            $("#kernel-info").text(res.data['kernel-release'])

        })
        .fail(function(res, error) {
            toastr.error(res.responseJSON.message, 'Error')
        })
        .always(function() {

        });
    }
</script>
