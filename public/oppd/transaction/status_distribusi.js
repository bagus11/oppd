const table = $('#status_distribusi_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: `getStatusDistribusi`,
        type: 'GET',
    },
    columns: [
        {
            class: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: ''
        },
        { data: 'distribution_code', name: 'distribution_code' },
        { data: 'asset_code', name: 'asset_code' },
        { data: 'asset_relation.category_relation.name', name: 'asset_relation.category_relation.name' },
        { data: 'destination_relation.name', name: 'destination_relation.name' },
        { data: 'location_relation.name', name: 'location_relation.name' },
        { 
            data: 'status', 
            name: 'status',
            render: function(data, type, row) {
                switch(data) {
                    case 0: return 'Order And Preparation';
                    case 1: return 'Shipping & Tracking';
                    case 2: return 'Delivery Confirmation';
                    default: return 'Unknown';
                }
            }
        },
        { 
            data: 'kondisi', 
            name: 'kondisi',
            render: function(data, type, row) {
                switch(data) {
                    case 0: return '-';
                    case 1: return 'BAIK';
                    case 2: return 'RR OPS';
                    case 3: return 'RB';
                    case 4: return 'RR TDK OPS';
                    case 5: return 'M';
                    case 6: return 'D';
                    default: return 'Unknown';
                }
            }
        },
    ]
    
});
var detailRows =[]
$('#status_distribusi_table').on('click', 'tbody td.dt-control', function (e) {
    let tr = $(this).closest('tr');
    let row = table.row(tr);
    let idx = detailRows.indexOf(tr[0].id);

    if (row.child.isShown()) {
        tr.removeClass('details');
        row.child.hide();
        // Remove from the 'open' array
        detailRows.splice(idx, 1);
    } else {
        tr.addClass('details');
        row.child(format(row.data())).show();
        // Add to the 'open' array
        if (idx === -1) {
            detailRows.push(tr[0].id);
        }
    }

    // Prevent the click event from bubbling up to the parent tr
    e.stopPropagation();
});
let mapInstance = null; // Global variable to store the map instance

$('#status_distribusi_table tbody').on('click', 'tr', function (e) {
    if ($(e.target).closest('td.dt-control').length) {
        return; // Do nothing if the click is on td.dt-control
    }

    const row = table.row(this).data();
    $('#detailDistribusiModal').modal('show');

    // Populate modal fields
    var attachment = row.attachment !== ""
        ? `<a style="color:#76ABAE !important;font-size:10px !important" title="Click Here For Attachment" href="storage/${row.attachment}" target="_blank">
            <i class="fa-solid fa-file-pdf"></i> Click Here
        </a>` : '-';

    var status = '';
    switch (row.status) {
        case 0: status = 'Order And Preparation'; break;
        case 1: status = 'Shipping & Tracking'; break;
        case 2: status = 'Delivery Confirmation'; break;
        default: status = 'Unknown'; break;
    }

    var kondisi = '';
    switch (row.asset_relation.kondisi) {
        case 0: kondisi = '-'; break;
        case 1: kondisi = 'BAIK'; break;
        case 2: kondisi = 'RR OPS'; break;
        case 3: kondisi = 'RB'; break;
        case 4: kondisi = 'RR TDK OPS'; break;
        case 5: kondisi = 'M'; break;
        case 6: kondisi = 'D'; break;
        default: kondisi = 'Unknown'; break;
    }

    $('#edit_label_distribution_code').html(': ' + row.distribution_code);
    $('#edit_label_lokasi_tujuan').html(': ' + row.destination_relation.name);
    $('#edit_label_lokasi_sekarang').html(': ' + row.location_relation.name);
    $('#edit_label_reporter').html(': ' + row.reporter_relation.name);
    $('#edit_label_catatan').html(': ' + row.keterangan);
    $('#edit_label_attachment').html(': ' + attachment);
    $('#edit_label_status').html(': ' + status);
    $('#edit_label_asset_code').html(': ' + row.asset_relation.asset_code);
    $('#edit_label_no_un').html(': ' + row.asset_relation.no_un);
    $('#edit_label_no_rangka').html(': ' + row.asset_relation.no_rangka);
    $('#edit_label_no_mesin').html(': ' + row.asset_relation.no_mesin);
    $('#edit_label_kategori').html(': ' + row.asset_relation.category_relation.name);
    $('#edit_label_sub_kategori').html(': ' + row.asset_relation.sub_category_relation.name);
    $('#edit_label_merk').html(': ' + row.asset_relation.merk_relation.name);
    $('#edit_label_jenis').html(': ' + row.asset_relation.type_relation.name);
    $('#edit_label_kondisi').html(': ' + kondisi);

    $('#distribution_code').val(row.distribution_code);

    row.status == 0 ? $('#status-0').prop('hidden', false) : $('#status-0').prop('hidden', true);
    row.status == 1 ? $('#status-1').prop('hidden', false) : $('#status-1').prop('hidden', true);

    // Initialize the map when the modal is shown
    $('#detailDistribusiModal').on('shown.bs.modal', function () {
        const mapContainerId = "map"; // ID for your map container

        // Destroy the existing map instance if it exists
        if (mapInstance) {
            mapInstance.remove();
        }

        // Initialize the map
        mapInstance = L.map(mapContainerId).setView([0, 0], 10);

        // Add a tile layer (example: OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mapInstance);

        // Add markers for each location in detail_relation
        if (Array.isArray(row.detail_relation)) {
            const bounds = [];
            let markerCount = 0; // Untuk menghitung jumlah marker yang ditambahkan
            const markers = []; // Untuk menyimpan referensi marker
            const lines = []; // Untuk menyimpan referensi garis penghubung
            for (let i = 0; i < row.detail_relation.length; i++) {
                // Skip the second item (index 1) but still count it in the loop
                if (i === 1) {
                    markerCount++;  // Increase the marker count manually
                    continue; // Skip processing for the second item
                }
        
                const detail = row.detail_relation[i];
        
                if (detail.location_relation && detail.location_relation.x && detail.location_relation.y) {
                    const coordinates = [detail.location_relation.x, detail.location_relation.y];
                    var proses = `Proses ${i + 1}`;
                    const marker = L.marker(coordinates).addTo(mapInstance)
                        .bindPopup(`Lokasi :  ${detail.location_relation.name || 'Unknown'}`);
        
                    // Menambahkan label nomor berdasarkan urutan dalam row.detail_relation
                    L.marker(coordinates, {
                        icon: L.divIcon({
                            className: 'label-number',
                            html: `<div class="marker-label">${i + 1}</div>`, // Menampilkan nomor berdasarkan urutan i
                            iconSize: [30, 30] // Ukuran label
                        })
                    }).addTo(mapInstance);
        
                    bounds.push(coordinates);
                    markers.push(marker); // Menyimpan marker untuk menghubungkan garis
                    markerCount++; // Increment marker count
                }
            }
        
            // Menghubungkan marker dengan garis
            if (markers.length > 1) {
                for (let i = 0; i < markers.length - 1; i++) {
                    const line = L.polyline([markers[i].getLatLng(), markers[i + 1].getLatLng()], {
                        color: 'blue', // Warna garis
                        weight: 3,
                        opacity: 0.6
                    }).addTo(mapInstance);
                    lines.push(line);
                }
            }
        
            // Fit map bounds jika lebih dari satu marker ditambahkan
            if (markerCount > 1) {
                mapInstance.fitBounds(bounds, { padding: [50, 50] });
            } else if (markerCount === 1) {
                // Jika hanya satu marker, set map view ke lokasi marker tersebut
                mapInstance.setView(bounds[0], 8); // Level zoom 15 untuk satu lokasi
            }
        }
        
        $('#distribusi_log_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `getDistribusiLog`,
                type: 'GET',
                data :{'distribution_code': row.distribution_code}
            },
            columns: [
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function (data, type, row) {
                        if (data) {
                            const date = new Date(data);
                            const year = date.getFullYear();
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const day = String(date.getDate()).padStart(2, '0');
                            const hours = String(date.getHours()).padStart(2, '0');
                            const minutes = String(date.getMinutes()).padStart(2, '0');
                            const seconds = String(date.getSeconds()).padStart(2, '0');
                            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
                        }
                        return '';
                    }
                },
                { data: 'user_relation.name', name: 'user_relation.name' },
                { 
                    data: 'kondisi', 
                    name: 'kondisi',
                    render: function(data, type, row) {
                        switch(data) {
                            case 0: return '-';
                            case 1: return 'BAIK';
                            case 2: return 'RR OPS';
                            case 3: return 'RB';
                            case 4: return 'RR TDK OPS';
                            case 5: return 'M';
                            case 6: return 'D';
                            default: return 'Unknown';
                        }
                    }
                },
                { 
                    data: 'status', 
                    name: 'status',
                    render: function(data, type, row) {
                        switch(data) {
                            case 0: return 'Order And Preparation';
                            case 1: return 'Shipping & Tracking';
                            case 2: return 'Delivery Confirmation';
                            default: return 'Unknown';
                        }
                    }
                },
                { 
                    data: 'attachment', 
                    name: 'attachment',
                    render: function(data, type, row) {
                        var attachment = row.attachment !== "" 
                            ? `<a style="color:#76ABAE !important;font-size:10px !important" title="Click Here For Attachment" href="storage/${row.attachment}" target="_blank">
                                <i class="fa-solid fa-file-pdf"></i> Click Here
                               </a>`
                            : '-';
                        return attachment;
                    }
                },
                { data: 'keterangan', name: 'keterangan' },
            ]
            
            
        });
        
        
        
        
    });

    // Cleanup the map when the modal is closed
    $('#detailDistribusiModal').on('hidden.bs.modal', function () {
        if (mapInstance) {
            mapInstance.remove(); // Destroy the map instance
            mapInstance = null;  // Reset the map variable
        }
    });
});

// Add Distribusi
    $('#btn_add_distribusi').on('click', function(){
        $('.container_label').prop('hidden', true)
        $("#tujuan").val('')
        $("#reporter").val('')
        $("#asset").val('')
        getActiveItems('getUser',null,'select_reporter','Reporter')
        getCallbackNoSwal('getSatgas', null, function(response){
            $('#select_tujuan').empty()
            var select_tujuan = '<option value="">Pilih Satgas</option>'
            for(i = 0; i < response.data.length; i++){
                select_tujuan += `
                    <option value="${response.data[i].id}" data-type ="${response.data[i].type}">
                        ${response.data[i].name} - ${response.data[i].type}
                    </option>
                `
            }
            $('#select_tujuan').html(select_tujuan)
        })
        getCallbackNoSwal('getMasterAssetDistribusi', null, function(response){
            var select_asset = '<option value="">Pilh Asset</option>'
            $("#select_asset").empty()
            $("#select_asset").html()
            for(i = 0; i < response.data.length; i++){
                select_asset += `
                    <option value ="${response.data[i].asset_code}">
                        ${response.data[i].no_un} - ${response.data[i].category_relation.name}
                    </option>
                `
            }
            $('#select_asset').html(select_asset)
        })
    })
   
    $('#select_asset').on('change', function(response){
        var asset_code = $('#select_asset').val()
        var data = {
            'asset_code' :asset_code
        }
        getCallbackNoSwal('getDetailAsset', data, function(response){
            $('.container_label').prop('hidden', false)
            
            var kondisi = ''
            switch(response.detail.kondisi){
                case 0:
                    kondisi = '-'
                break
                case 1 :
                    kondisi = 'BAIK'
                break 
                case 2 :
                    kondisi = "RR OPS"
                break
                case 3 : 
                    kondisi = "RB"
                break 
                case 4 :
                    kondisi = "RR TDK OPS"
                break
                case 5 :
                    kondisi = 'M'
                break
                case 6 : 
                    kondisi = "D"

            }
            $('#label_asset_code').html(': ' + response.detail.asset_code)
            $('#label_no_un').html(': ' + response.detail.no_un)
            $('#label_no_rangka').html(': ' + response.detail.no_rangka)
            $('#label_no_mesin').html(': ' + response.detail.no_mesin)
            $('#label_kategori').html(': ' + response.detail.category_relation.name)
            $('#label_sub_kategori').html(': ' + response.detail.sub_category_relation.name)
            $('#label_merk').html(': ' + response.detail.merk_relation.name)
            $('#label_jenis').html(': ' + response.detail.type_relation.name)
            $('#label_kondisi').html(': ' + kondisi)
            $('#label_satgas').html(': ' + response.detail.satgas_relation.name)


            // $('#label_satgas').html(': ' + response.detail.satgas_relation.name)
        })
    })
        onChange('select_asset','asset')
        onChange('select_tujuan','tujuan')
        onChange('select_reporter','reporter')
    $('#btn_save_distribusi').on('click', function(e){
        e.preventDefault()
        var data        = new FormData();    
        data.append('asset',$('#asset').val())
        data.append('reporter',$('#reporter').val())
        data.append('tujuan',$('#tujuan').val())
        data.append('catatan',$('#catatan').val())
        data.append('attachment',$('#attachment')[0].files[0]);

        postAttachment('addDistribusi', data, false, function(response){
            swal.close()
            toastr['success'](response.meta.message)
            $('#status_distribusi_table').DataTable().ajax.reload();
        })
    })
// Add Distribusi

    table.on('draw', () => {
        detailRows.forEach((id, i) => {
            let el = document.querySelector('#' + id + ' td.dt-control');
    
            if (el) {
                el.dispatchEvent(new Event('click', { bubbles: true }));
            }
        });
    });
    function format(d) {
        var response = d.detail_relation; // Assuming this is an array or object

        // Check if response is an array or object
        if (Array.isArray(response)) {
            let tableContent = `
            <table class="table  table-bordered table-striped">
                <thead style="backgound-color:">
                    <tr> 
                            <th>Created At</th>
                            <th>Detail Transaksi</th>
                            <th>PIC</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                `;

            // Loop through each item in the response and create table rows
            for(i = 0 ; i < response.length ; i++){
                var status = '';
                switch (response[i].status) {
                    case 0: status = 'Order And Preparation'; break;
                    case 1: status = 'Shipping & Tracking'; break;
                    case 2: status = 'Delivery Confirmation'; break;
                    default: status = 'Unknown'; break;
                }
            
                var kondisi = '';
                switch (response[i].kondisi) {
                    case 0: kondisi = '-'; break;
                    case 1: kondisi = 'BAIK'; break;
                    case 2: kondisi = 'RR OPS'; break;
                    case 3: kondisi = 'RB'; break;
                    case 4: kondisi = 'RR TDK OPS'; break;
                    case 5: kondisi = 'M'; break;
                    case 6: kondisi = 'D'; break;
                    default: kondisi = 'Unknown'; break;
                }
                var createdAt = new Date(response[i].created_at);
                var formattedDate = createdAt.toLocaleString(); 
                tableContent +=`
                    <tr>
                        <td>${formattedDate}</td>
                        <td>${response[i].detail_distribution_code}</td>
                        <td>${response[i].user_relation.name}</td>
                        <td>${response[i].location_relation.name}</td>
                        <td>${status}</td>
                        <td>${kondisi}</td>
                    </tr>
                `
            }

            tableContent += '</tbody></table>';

            return tableContent;
        } else {
            return 'No data available.';
        }
    }


// Start Progress
    $('#start_progress').on('click', function(){
        var data = {
            'distribution_code' : $('#distribution_code').val()
        }
        postCallback('startProgressDistribution', data, function(response){
            swal.close()
            toastr['success'](response.meta.message)
            $('#detailDistribusiModal').modal('hide')
            $('#status_distribusi_table').DataTable().ajax.reload();
        })
    })
// Start Progress

// Update DIstribusi
    onChange('update_select_kondisi','update_kondisi')
    onChange('udpate_select_status','update_status')
    $('#btn_update_distribusi').on('click', function(e){
        e.preventDefault()
        var data        = new FormData();    
        data.append('distribution_code',$('#distribution_code').val())
        data.append('update_status',$('#update_status').val())
        data.append('update_kondisi',$('#update_kondisi').val())
        data.append('update_catatan',$('#update_catatan').val())
        data.append('update_attachment',$('#update_attachment')[0].files[0]);
        console.log(data)
        postAttachment('updateDistribusi', data, false, function(response){
            swal.close()
            toastr['success'](response.meta.message)
            $('#status_distribusi_table').DataTable().ajax.reload();
        })
    })
// Update DIstribusi