const table = $('#laporan_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: `getMaintenance`,
        type: 'GET',
    },
    columns: [
        { data: 'request_code', name: 'request_code' },
        { data: 'asset_code', name: 'asset_code' },
        { 
            data: 'type', 
            name: 'type',
            render: function(data, type, row) {
                switch(data) {
                    case 1: return 'Pengajuan Perbaikan';
                    case 2: return 'Pengajuan Penggantian';
                    default: return 'Unknown';
                }
            }
        },
        { data: 'asset_relation.satgas_relation.name', name: 'asset_relation.satgas_relation.name' },
        { data: 'asset_relation.category_relation.name', name: 'asset_relation.category_relation.name' },
        { data: 'asset_relation.sub_category_relation.name', name: 'asset_relation.sub_category_relation.name' },
        { data: 'asset_relation.type_relation.name', name: 'asset_relation.type_relation.name' },
        { data: 'asset_relation.merk_relation.name', name: 'asset_relation.merk_relation.name' },
        { data: 'asset_relation.no_mesin', name: 'asset_relation.no_mesin' },
        { data: 'asset_relation.no_rangka', name: 'asset_relation.no_rangka' },
        { data: 'asset_relation.no_un', name: 'asset_relation.no_un' },
        { 
            data: 'status', 
            name: 'status',
            render: function(data, type, row) {
                switch(data) {
                    case 0: return 'NEW';
                    case 1: return 'On Progress';
                    case 2: return 'DONE';
                    case 3: return 'Reject';
                    default: return 'Unknown';
                }
            }
        },
   
    ]
    
});

$(document).ready(function() {
    $('#btn_add_request').on('click', function() {
        // Reset form and hide container labels
        $('#form_serialize')[0].reset(); // Use [0] to access the DOM element for reset
        $('.container_label').prop('hidden', true);
        getActiveItems('getUser', null, 'select_reporter', 'Reporter');
        getCallbackNoSwal('getMasterAsset', null, function(response) {
            if (response && response.data) {
                var selectAssetOptions = '<option value="">Pilih Asset</option>';
                response.data.forEach(function(item) {
                    selectAssetOptions += `
                        <option value="${item.asset_code}">
                            ${item.no_un} - ${item.category_relation.name}
                        </option>
                    `;
                });
                $('#select_asset').html(selectAssetOptions);
            } else {
                console.error('Invalid response for getMasterAsset:', response);
            }
        });
        $('#asset_table').DataTable().clear().destroy();
        $('#asset_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `getAssetMaintenance`,
                type: 'GET',
            },
            columns: [
                {
                    data: null, // No data binding for checkbox column
                    orderable: false, // Disable ordering for this column
                    searchable: false, // Disable searching for this column
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="row-checkbox" value="${row.asset_code}">`; // Replace `row.id` with the appropriate unique identifier
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
                },
                { data: 'satgas_relation.name', name: 'satgas_relation.name' },
                { data: 'no_un', name: 'no_un' },
                { data: 'category_relation.name', name: 'category_relation.name' },
                { data: 'sub_category_relation.name', name: 'sub_category_relation.name' },
                { data: 'type_relation.name', name: 'type_relation.name' },
                { data: 'merk_relation.name', name: 'merk_relation.name' },
                { data: 'no_mesin', name: 'no_mesin' },
                { data: 'no_rangka', name: 'no_rangka' },
              
            ]
        });
    });
});
$(document).ready(function () {
    const tableArray = $('#asset_array_table').DataTable({
        columns: [
            { data: 'asset_code', title: 'Asset Code' },
            { data: 'satgas_name', title: 'Satgas' },
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
            },
            {
                data: null,
                title: 'Action',
                orderable: false,
                render: function (data, type, row) {
                    return `<button class="btn btn-danger btn-sm remove-row" style="text-align:center" data-id="${row.asset_code}">
                       <i class="fa-solid fa-circle-xmark"></i>
                    </button>`;
                }
            }
        ]
    });

    // Add row to table_array when checkbox is checked
    $('#asset_table').on('change', '.row-checkbox', function () {
        const isChecked = $(this).is(':checked');
        const row = $(this).closest('tr');
        const rowData = $('#asset_table').DataTable().row(row).data();
        console.log(rowData)
        if (isChecked) {
            // Add row data to tableArray
            tableArray.row.add({
                asset_code: rowData.asset_code,
                satgas_name: rowData.satgas_relation.name, // Use a valid key name here
                kondisi: rowData.kondisi,
            }).draw();
        } else {
            // Remove row from tableArray
            tableArray.rows((idx, data) => data.asset_code === rowData.asset_code).remove().draw();
        }
    });

    // Remove row from tableArray when "Remove" button is clicked
    $('#asset_array_table').on('click', '.remove-row', function () {
        const assetCode = $(this).data('id');
        tableArray.rows((idx, data) => data.asset_code === assetCode).remove().draw();

        // Uncheck the corresponding checkbox in the main table
        $(`.row-checkbox[value="${assetCode}"]`).prop('checked', false);
    });
});
