const table = $('#inventaris_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: `getInventaris`,
        type: 'GET',
    },
    columns: [
        {
            data: 'created_at',
            name: 'created_at',
            render: function (data) {
                if (data) {
                    const date = new Date(data);
                    return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')} `;
                }
                return '-';
            }
        },
        { data: 'satgas_relation.name', name: 'satgas_relation.name' },
        { data: 'asset_relation.category_relation.name', name: 'asset_relation.category_relation.name' },
        { data: 'asset_relation.sub_category_relation.name', name: 'asset_relation.sub_category_relation.name' },
        { data: 'asset_relation.type_relation.name', name: 'asset_relation.type_relation.name' },
        { data: 'asset_relation.merk_relation.name', name: 'asset_relation.merk_relation.name' },
        { data: 'asset_relation.no_mesin', name: 'asset_relation.no_mesin' },
        { data: 'asset_relation.no_rangka', name: 'asset_relation.no_rangka' },
        { 
            data: 'kondisi', 
            name: 'kondisi',
            render: function(data, type, row) {
                switch(data) {
                    case 0:
                        return '-';
                    case 1:
                        return 'BAIK';
                    case 2:
                        return 'RR OPS';
                    case 3:
                        return 'RB';
                    case 4:
                        return 'RR TDK OPS';
                    case 5:
                        return 'M';
                    case 6:
                        return 'D';
                    default:
                        return 'Unknown';
                }
            }
        },
    ]
});

getActiveItems('getUser',null,'edit_select_reporter','Reporter')
getCallbackNoSwal('getSatgas', null, function(response){
    $('#edit_select_satgas').empty()
    var edit_select_satgas = '<option value="">Pilih Satgas</option>'
    for(i = 0; i < response.data.length; i++){
        edit_select_satgas += `
            <option value="${response.data[i].id}" data-type ="${response.data[i].type}">
                ${response.data[i].name} - ${response.data[i].type}
            </option>
        `
    }
    $('#edit_select_satgas').html(edit_select_satgas)
})
getCallbackNoSwal('getMasterAsset', null, function(response){
    var edit_select_asset = '<option value="">Pilh Asset</option>'
    $("#edit_select_asset").empty()
    $("#edit_select_asset").html()
    for(i = 0; i < response.data.length; i++){
        edit_select_asset += `
            <option value ="${response.data[i].asset_code}">
                ${response.data[i].no_un} - ${response.data[i].category_relation.name}
            </option>
        `
    }
    $('#edit_select_asset').html(edit_select_asset)
})
$('#inventaris_table tbody').on('click', 'tr', function () {
    // Mapping Data
    const row = table.row(this).data();
    $('#editAssetModal').modal('show');
    $('#btn_cancel_edit_inventaris').prop('hidden', true);
    $('#btn_update_inventaris').prop('hidden', true);
    $('#btn_edit_inventaris').prop('hidden', false);

    var kondisi = '';
    switch (row.kondisi) {
        case 0:
            kondisi = '-';
            break;
        case 1:
            kondisi = 'BAIK';
            break;
        case 2:
            kondisi = 'RR OPS';
            break;
        case 3:
            kondisi = 'RB';
            break;
        case 4:
            kondisi = 'RR TDK OPS';
            break;
        case 5:
            kondisi = 'M';
            break;
        case 6:
            kondisi = 'D';
            break;
    }

    $('#inventaris_code').val(row.inventaris_code);
    $('#edit_bulan').val(row.bulan);
    $('#edit_select_kondisi').val(row.kondisi);
    $('#edit_catatan').val(row.catatan);
    $('#edit_select_asset').val(row.asset_code);
    $('#edit_select_satgas').val(row.satgas);
    $('#edit_select_reporter').val(row.reporter);

    $('#edit_asset').val(row.asset_code);
    $('#edit_satgas').val(row.satgas);
    $('#edit_reporter').val(row.reporter);

    $('#edit_bulan').prop('readOnly', true);
    $('#edit_select_kondisi').prop('disabled', true);
    $('#edit_catatan').prop('readOnly', true);
    $('#edit_attachment').prop('disabled', true);
    $('#edit_select_asset').prop('disabled', true);
    $('#edit_select_satgas').prop('disabled', true);
    $('#edit_select_reporter').prop('disabled', true);

    $('#edit_label_asset_code').html(': ' + row.asset_relation.asset_code);
    $('#edit_label_no_un').html(': ' + row.asset_relation.no_un);
    $('#edit_label_no_rangka').html(': ' + row.asset_relation.no_rangka);
    $('#edit_label_no_mesin').html(': ' + row.asset_relation.no_mesin);
    $('#edit_label_kategori').html(': ' + row.asset_relation.category_relation.name);
    $('#edit_label_sub_kategori').html(': ' + row.asset_relation.sub_category_relation.name);
    $('#edit_label_merk').html(': ' + row.asset_relation.merk_relation.name);
    $('#edit_label_jenis').html(': ' + row.asset_relation.type_relation.name);
    $('#edit_label_kondisi').html(': ' + kondisi);

    const baseUrl = "{{ asset('storage') }}";
    var attachment = row.attachment !== ""
        ? `<a style="color:#76ABAE !important;font-size:10px !important" title="Click Here For Attachment" href="storage/${row.attachment}" target="_blank">
            <i class="fa-solid fa-file-pdf"></i> Click Here
           </a>`
        : '-';

    $('#edit_label_attachment').html(': ' + attachment);

    $('#edit_select_kondisi').select2().trigger('change');
    $('#edit_select_asset').select2().trigger('change');
    $('#edit_select_satgas').select2().trigger('change');
    $('#edit_select_reporter').select2().trigger('change');

    // Get Log Transaction
    var data = {
        'inventaris_code': row.inventaris_code
    };

    // Destroy the DataTable instance if it exists
    if ($.fn.DataTable.isDataTable('#inventaris_table_log')) {
        $('#inventaris_table_log').DataTable().clear().destroy();
    }

    // Initialize the DataTable
    $('#inventaris_table_log').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `getInventarisLog`,
            type: 'GET',
            data: data
        },
        columns: [
            {
                data: 'created_at',
                name: 'created_at',
                render: function (data) {
                    if (data) {
                        const date = new Date(data);
                        return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')} 
                                ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}:${String(date.getSeconds()).padStart(2, '0')}`;
                    }
                    return '-';
                }
            },
            { data: 'user_relation.name', name: 'user_relation.name', render: data => data || '-' },
            { data: 'satgas_relation.name', name: 'satgas_relation.name', render: data => data || '-' },
            { data: 'bulan', name: 'bulan', render: data => data || '-' },
            { data: 'asset_code', name: 'asset_code', render: data => data || '-' },
            { data: 'catatan', name: 'catatan', render: data => data || '-' },
            {
                data: 'attachment',
                name: 'attachment',
                render: function (data, type, row) {
                    if (data) {
                        return `<a style="color:#76ABAE !important;font-size:10px !important" 
                                    title="Click Here For Attachment" 
                                    href="storage/${data}" 
                                    target="_blank">
                                    <i class="fa-solid fa-file-pdf"></i> Click Here
                                </a>`;
                    }
                    return '-';
                }
            },
            {
                data: 'kondisi',
                name: 'kondisi',
                render: function (data) {
                    switch (data) {
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
            }
        ]
    });
    // Get Log Transaction
});

$('#btn_edit_inventaris').on('click', function(){
    $("#btn_cancel_edit_inventaris").prop('hidden', false)
    $("#btn_edit_inventaris").prop('hidden', true)
    $("#btn_update_inventaris").prop('hidden', false)

    $('#edit_bulan').prop('readOnly', false)
    $('#edit_select_kondisi').prop('disabled', false)
    $('#edit_catatan').prop('readOnly', false)
    $('#edit_select_asset').prop('disabled', true)
    $('#edit_select_satgas').prop('disabled', false)
    $('#edit_select_reporter').prop('disabled', false)
    $('#edit_attachment').prop('disabled', false)
   
})
$('#btn_cancel_edit_inventaris').on('click', function(){
    $("#btn_edit_inventaris").prop('hidden', false)
    $("#btn_cancel_edit_inventaris").prop('hidden', true)
    $("#btn_update_inventaris").prop('hidden', true)

    $('#edit_attachment').prop('disabled', true)
    $('#edit_bulan').prop('readOnly', true)
    $('#edit_select_kondisi').prop('disabled', true)
    $('#edit_catatan').prop('readOnly', true)
    $('#edit_select_asset').prop('disabled', true)
    $('#edit_select_satgas').prop('disabled', true)
    $('#edit_select_reporter').prop('disabled', true)
  
})
$('#btn_add_asset').on('click', function(){
    $('.container_label').prop('hidden', true)
    $("#asset").val('')
    $("#reporter").val('')
    $("#satgas").val('')
    getActiveItems('getUser',null,'select_reporter','Reporter')
    getCallbackNoSwal('getSatgas', null, function(response){
        $('#select_satgas').empty()
        var select_satgas = '<option value="">Pilih Satgas</option>'
        for(i = 0; i < response.data.length; i++){
            select_satgas += `
                <option value="${response.data[i].id}" data-type ="${response.data[i].type}">
                    ${response.data[i].name} - ${response.data[i].type}
                </option>
            `
        }
        $('#select_satgas').html(select_satgas)
    })
    getCallbackNoSwal('getMasterAsset', null, function(response){
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


            // $('#label_satgas').html(': ' + response.detail.satgas_relation.name)
        })
    })
})
    onChange('select_reporter','reporter')
    onChange('select_asset','asset')
    onChange('select_satgas','satgas')
    onChange('select_kondisi','kondisi')
// Add Inventaris 
    $('#btn_save_inventaris').on('click', function(e){
        e.preventDefault()
        var data        = new FormData();    
        data.append('asset',$('#asset').val())
        data.append('reporter',$('#reporter').val())
        data.append('bulan',$('#bulan').val())
        data.append('satgas',$('#satgas').val())
        data.append('kondisi',$('#kondisi').val())
        data.append('catatan',$('#catatan').val())
        data.append('attachment',$('#attachment')[0].files[0]);

        postAttachment('addInventaris', data, false, function(response){
            swal.close()
            $('#addAssetModal').modal('hide')
            toastr['success'](response.meta.message)
            $('#inventaris_table').DataTable().ajax.reload();
        })
    })
// Add Inventaris 
onChange('edit_select_reporter','edit_reporter')
onChange('edit_select_asset','edit_asset')
onChange('edit_select_satgas','edit_satgas')
onChange('edit_select_kondisi','edit_kondisi')
// Update Inventaris
    $('#btn_update_inventaris').on('click', function(e){
        e.preventDefault()
        e.preventDefault()
        var data        = new FormData();    
        data.append('inventaris_code',$('#inventaris_code').val())
        data.append('edit_asset',$('#edit_asset').val())
        data.append('edit_reporter',$('#edit_reporter').val())
        data.append('edit_bulan',$('#edit_bulan').val())
        data.append('edit_satgas',$('#edit_satgas').val())
        data.append('edit_kondisi',$('#edit_kondisi').val())
        data.append('edit_catatan',$('#edit_catatan').val())
        data.append('edit_attachment',$('#edit_attachment')[0].files[0]);

        postAttachment('updateInventaris', data, false, function(response){
            swal.close()
            toastr['success'](response.meta.message)
            $('#inventaris_table_log').DataTable().ajax.reload();
        })

    })
// Update Inventaris