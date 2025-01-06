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

        // Populate the Reporter dropdown
        getActiveItems('getUser', null, 'select_reporter', 'Reporter');

        // Populate the Asset dropdown
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

        // Handle Asset selection change
        $('#select_asset').off('change').on('change', function() {
            var assetCode = $(this).val();
            if (!assetCode) {
                console.warn('No asset selected.');
                return;
            }

            var data = { asset_code: assetCode };
            getCallbackNoSwal('getDetailAsset', data, function(response) {
                if (response && response.detail) {
                    $('.container_label').prop('hidden', false);

                    var kondisi;
                    switch (response.detail.kondisi) {
                        case 0: kondisi = '-'; break;
                        case 1: kondisi = 'BAIK'; break;
                        case 2: kondisi = 'RR OPS'; break;
                        case 3: kondisi = 'RB'; break;
                        case 4: kondisi = 'RR TDK OPS'; break;
                        case 5: kondisi = 'M'; break;
                        case 6: kondisi = 'D'; break;
                        default: kondisi = 'Unknown';
                    }

                    $('#label_asset_code').text(`: ${response.detail.asset_code}`);
                    $('#label_no_un').text(`: ${response.detail.no_un}`);
                    $('#label_no_rangka').text(`: ${response.detail.no_rangka}`);
                    $('#label_no_mesin').text(`: ${response.detail.no_mesin}`);
                    $('#label_kategori').text(`: ${response.detail.category_relation.name}`);
                    $('#label_sub_kategori').text(`: ${response.detail.sub_category_relation.name}`);
                    $('#label_merk').text(`: ${response.detail.merk_relation.name}`);
                    $('#label_jenis').text(`: ${response.detail.type_relation.name}`);
                    $('#label_kondisi').text(`: ${kondisi}`);
                } else {
                    console.error('Invalid response for getDetailAsset:', response);
                }
            });

            // Attach onChange handlers
            onChange('select_reporter', 'reporter');
            onChange('select_asset', 'asset');
            onChange('select_type', 'type');
        });
    });
});
