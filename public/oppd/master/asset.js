const table =$('#asset_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: `getMasterAsset`,
        type: 'GET',
      
    },
    columns: [
        { data: 'asset_code', name: 'asset_code' },
        { data: 'no_un', name: 'no_un' },
        { data: 'category_relation.name', name: 'category_relation.name' },
        { data: 'sub_category_relation.name', name: 'sub_category_relation.name' },
        { data: 'type_relation.name', name: 'type_relation.name' },
        { data: 'merk_relation.name', name: 'merk_relation.name' },
        { data: 'no_mesin', name: 'no_mesin' },
        { data: 'no_rangka', name: 'no_rangka' },
       
    ]
});
getActiveItems('getInventoryCategory', null, 'edit_select_kategori', 'Kategori');
getActiveItems('getInventorySubCategory', null, 'edit_select_subkategori', 'Subkategori');
getActiveItems('getInventoryType', null, 'edit_select_jenis', 'Jenis');
getActiveItems('getInventoryBrand', null, 'edit_select_brand', 'Merk');
// Detail Asset
$('#asset_table tbody').on('click', 'tr', function () {
    const row = table.row(this).data();
    if (!row) {
        console.error('Row data is undefined.');
        return;
    }
    $("#btn_edit_asset").prop('hidden', false)
    $("#btn_cancel_edit_asset").prop('hidden', true)
    $("#btn_update_asset").prop('hidden', true)
    $('#edit_no_un').prop('readOnly' ,true);
    $('#edit_no_rangka').prop('readOnly' ,true);
    $('#edit_no_mesin').prop('readOnly' ,true);
    $('#edit_select_kategori, #edit_select_subkategori, #edit_select_brand, #edit_select_jenis').prop('disabled', true);
    $('#editAssetModal').modal('show');

    // Populate Select2 fields
    $('#asset_code').val(row.asset_code)
    $('#edit_select_kategori').val(row.category_relation?.id || '').trigger('change');
    $('#edit_select_subkategori').val(row.subkategori || '').trigger('change');
    $('#edit_select_brand').val(row.merk || '').trigger('change');
    $('#edit_select_jenis').val(row.jenis || '').trigger('change');

    // Disable Select2 fields
    $('#edit_select_kategori, #edit_select_subkategori, #edit_select_brand, #edit_select_jenis').prop('disabled', true);

    // Populate other fields
    $('#edit_no_un').val(row.no_un || '');
    $('#edit_no_rangka').val(row.no_rangka || '');
    $('#edit_no_mesin').val(row.no_mesin || '');

    // Destroy and reinitialize DataTable for logs
    if (!document.querySelector('#asset_table_log')) {
        console.error('Table #asset_table_log does not exist in the DOM.');
        return;
    }

    if ($.fn.DataTable.isDataTable('#asset_table_log')) {
        $('#asset_table_log').DataTable().clear().destroy();
    }
    const table_log = $('#asset_table_log').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `getLogAsset`,
            type: 'GET',
            data: row,
            error: function (xhr, error, code) {
                console.error('Error loading log data:', error, code, xhr.responseText);
            }
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
            { data: 'pic_relation.name', name: 'pic_relation.name' },
            { data: 'no_un', name: 'no_un' },
            { data: 'category_relation.name', name: 'category_relation.name' },
            { data: 'sub_category_relation.name', name: 'sub_category_relation.name' },
            { data: 'type_relation.name', name: 'type_relation.name' },
            { data: 'merk_relation.name', name: 'merk_relation.name' },
            { data: 'no_mesin', name: 'no_mesin' },
            { data: 'no_rangka', name: 'no_rangka' },
        ],
        order: [[0, 'asc']],
        createdRow: function (row, data, dataIndex) {
            if (dataIndex > 0) { // Skip the first row
                const previousRowData = table_log.row(dataIndex - 1).data(); // Get the previous row's data
    
                // List of column mappings to check: { columnKey: columnIndex }
                const columnsToCheck = {
                    'no_un': 2,
                    'category_relation.name': 3, // Adjust indices to match actual table structure
                    'sub_category_relation.name': 4,
                    'type_relation.name': 5,
                    'merk_relation.name': 6,
                    'no_mesin': 7,
                    'no_rangka': 8
                };
    
                // Iterate over each column to check
                Object.keys(columnsToCheck).forEach(columnKey => {
                    const columnIndex = columnsToCheck[columnKey]; // Get the table column index
                    const currentValue = data[columnKey]; // Current row value
                    const previousValue = previousRowData[columnKey]; // Previous row value
    
                    // If the current value differs from the previous value
                    if (currentValue !== previousValue) {
                        $(row).find('td').eq(columnIndex).css('color', 'red'); // Change font color to red
                    }
                });
            }
        }
    });
    
    
    
    
});

// Detail Asset

// Edit Asset
    $('#btn_edit_asset').on('click', function(){
        $("#btn_cancel_edit_asset").prop('hidden', false)
        $("#btn_edit_asset").prop('hidden', true)
        $("#btn_update_asset").prop('hidden', false)
        $('#edit_no_un').prop('readOnly' ,false);
        $('#edit_no_rangka').prop('readOnly' ,false);
        $('#edit_no_mesin').prop('readOnly' ,false);
        $('#edit_select_kategori, #edit_select_subkategori, #edit_select_brand, #edit_select_jenis').prop('disabled', false);
    })
    $('#btn_cancel_edit_asset').on('click', function(){
        $("#btn_edit_asset").prop('hidden', false)
        $("#btn_cancel_edit_asset").prop('hidden', true)
        $("#btn_update_asset").prop('hidden', true)
        $('#edit_no_un').prop('readOnly' ,true);
        $('#edit_no_rangka').prop('readOnly' ,true);
        $('#edit_no_mesin').prop('readOnly' ,true);
        $('#edit_select_kategori, #edit_select_subkategori, #edit_select_brand, #edit_select_jenis').prop('disabled', true);
    })
// Edit Asset
// Add Asset
    $('#btn_add_asset').on('click', function(){
        $('#no_un').val('')
        $('#no_rangka').val('')
        $('#no_mesin').val('')
        $('#kategori').val('')
        $('#subkategori').val('')
        $('#jenis').val('')
        $('#brand').val('')
        resetSelect2('select_kategori');
        resetSelect2('select_subkategori');
        resetSelect2('select_jenis');
        resetSelect2('select_brand');

        getActiveItems('getInventoryCategory', null, 'select_kategori', 'Kategori');
        getActiveItems('getInventorySubCategory', null, 'select_subkategori', 'Subkategori');
        getActiveItems('getInventoryType', null, 'select_jenis', 'Jenis');
        getActiveItems('getInventoryBrand', null, 'select_brand', 'Merk');
    })
    onChange('select_kategori','kategori')
    onChange('select_subkategori','subkategori')
    onChange('select_jenis','jenis')
    onChange('select_brand','merk')

    $('#btn_save_asset').on('click', function(){
        var data ={
            no_un:$('#no_un').val(),
            no_rangka:$('#no_rangka').val(),
            no_mesin:$('#no_mesin').val(),
            kategori:$('#kategori').val(),
            subkategori:$('#subkategori').val(),
            jenis:$('#jenis').val(),
            merk:$('#merk').val(),
        }
        postCallback('addMasterAsset', data, function(response){
            swal.close()
            $('#addAssetModal').modal('hide')
            toastr['success'](response.meta.message)
            $('#asset_table').DataTable().ajax.reload();
            
        })
    })
// Add Asset
    onChange('edit_select_kategori','edit_kategori')
    onChange('edit_select_subkategori','edit_subkategori')
    onChange('edit_select_jenis','edit_jenis')
    onChange('edit_select_brand','edit_merk')
// Update Asset
    $('#btn_update_asset').on('click', function(){
        var data = {
            'asset_code' : $('#asset_code').val(),
            'edit_no_un':$('#edit_no_un').val(),
            'edit_no_rangka':$('#edit_no_rangka').val(),
            'edit_no_mesin':$('#edit_no_mesin').val(),
            'edit_kategori':$('#edit_kategori').val(),
            'edit_subkategori':$('#edit_subkategori').val(),
            'edit_jenis':$('#edit_jenis').val(),
            'edit_merk':$('#edit_merk').val(),
        }
        postCallback('updateAsset', data, function(response){
            swal.close()
            toastr['success'](response.meta.message)
            $('#asset_table_log').DataTable().ajax.reload();
            
        })
    })
// Update Asset
