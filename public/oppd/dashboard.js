getCallbackNoSwal('getCountingAsset', null, function(response) {
    // Populate asset counts
    $('#counting_unifil').html(response.unifil[0]?.total || '0');
    $('#counting_kizi_minusca').html(response.minusca[0]?.total || '0');
    $('#counting_kizi_monusco').html(response.monusca[0]?.total || '0');
    $('#counting_bgc_monusco').html(response.bgc_monusca[0]?.total || '0');

    // Populate asset type dropdown
    $('#select_asset_type').empty();
    $('#select_asset_type').append('<option value="">OPPD</option>');
    response.group.forEach(group => {
        $('#select_asset_type').append(`<option value="${group.type}">${group.type}</option>`);
    });
console.log('test')
// Calculate total and percentages
const total = response.data.reduce((a, b) => a + b, 0); // Sum of original data
const percentageData = response.data.map(value => ((value / total) * 100).toFixed(2)); // Convert to percentage and round to 2 decimals
const options = {
    series: percentageData, // Use percentage data for radial bars
    chart: {
        type: 'radialBar',
        height: 300, // Set height explicitly
        width: '100%', // Set width to 100%
    },
    plotOptions: {
        radialBar: {
            hollow: {
                size: '20%', // Adjust hollow size
            },
            track: {
                background: '#e7e7e7', // Track background color
                strokeWidth: '100%', // Track thickness
            },
            dataLabels: {
                name: {
                    show: true,
                    fontSize: '12px',
                    color: '#333',
                    offsetY: -10,
                },
                value: {
                    show: true,
                    fontSize: '14px',
                    color: '#111',
                    offsetY: 5,
                    formatter: function (val) {
                        return `${val}%`; // Display percentage for radial bars
                    },
                },
                total: {
                    show: true,
                    label: 'Total',
                    color: '#000',
                    fontSize: '12px',
                    formatter: function (w) {
                        return total; // Display total sum in the center
                    },
                },
            },
            stroke: {
                lineCap: 'round', // Add rounded borders
            },
        },
    },
    labels: response.labels, // Labels for each radialBar segment
    colors: ['#FF4560', '#008FFB', '#00E396', '#0A97B0', '#B1F0F7'], // Custom colors
    tooltip: {
        enabled: true, // Enable tooltips
        theme: "dark", // Use dark theme (white font by default)
        style: {
            fontSize: '12px', // Adjust font size
            color: '#fff', // Force white font color
        },
        y: {
            formatter: function (val, opts) {
                // Get original count value from the `response.data` array
                const count = response.data[opts.seriesIndex];
                return `Total: ${count}`; // Show count value
            },
        },
    },
};

const chart = new ApexCharts(document.querySelector("#radialChart"), options);
chart.render();



    
    
    // Initialize the map
    const map = L.map('asset_map_track').setView([1.5074, 10.1278], 3);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add markers to the map
    const bounds = [];
    response.country.forEach(country => {
        const bounds = [];
        response.country.forEach(country => {
          const { x: lat, y: lng, name, total } = country;
          if (lat && lng) {
            const marker = L.marker([lat, lng]).addTo(map)
              .bindPopup(`
                     <b style="text-transform:uppercase; color :#344CB7">${country.country}</b>
                    <br>CIMIC UNIFIL
                    <br> <i class="fa-solid fa-box"></i> Total Asset: 62
                    <br> <i class="fa-solid fa-user"></i> Total Personil: 70
                
                `);
            marker.openPopup(); // Open the popup immediately
            bounds.push([lat, lng]);
          }
        });
    });
   
    // Fit map to bounds if markers exist
    // if (bounds.length > 0) {
    //     map.fitBounds(bounds);
    // }
    // $('#country_list').empty()
    // var countryList = ''
    // for(i = 0; i < response.country.length ; i++){
    //     countryList +=`
    //         <div class="col-7">
    //            <label> ${response.country[i].country} </label>
    //         </div>
    //         <div class="col-5">
    //                <label> : ${response.country[i].total} <label>
    //         </div>
    //     `
    // }
    // // console.log(response.country[i])
    // $('#country_list').html(countryList)

});

// document.addEventListener("DOMContentLoaded", function () {
 $('.asset_modal').on('click', function(){
    $('#detailAssetModal').modal('show')
    var val = $(this).data('val')
    var data = {
        'type' : val
    }
    $('#asset_table').DataTable().clear().destroy();
    $('#asset_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `getAssetFilter`,
            type: 'GET',
            data :data
        },
        columns: [
            { data: 'satgas_relation.name', name: 'satgas_relation.name' },
            { data: 'no_un', name: 'no_un' },
            { data: 'category_relation.name', name: 'category_relation.name' },
            { data: 'sub_category_relation.name', name: 'sub_category_relation.name' },
            { data: 'type_relation.name', name: 'type_relation.name' },
            { data: 'merk_relation.name', name: 'merk_relation.name' },
            { data: 'no_mesin', name: 'no_mesin' },
            { data: 'no_rangka', name: 'no_rangka' },
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
 })
// });
$('#select_asset_type').on('change', function(){
    var type =  $('#select_asset_type').val()
    var data = {
        'type'  :type
    }
    getCallbackNoSwal('assetChartFilter',data, function(response){
        $(document).ready(function () {
            $('#asset_chart').empty(); // Clear the container if needed
            const labels = response.data.map(item => item.kondisi_label); // Extract labels
            const seriesData = response.data.map(item => item.total); // Extract numerical data
            const predefinedColors = ['#1E90FF', '#FFD700', '#FF6347', '#32CD32']; // Define colors for each bar
            const options = {
                chart: {
                    type: 'bar', // Bar chart type
                    height: 350
                },
                series: [
                    {
                        name: type == '' ? 'OPPD': type,
                        data: seriesData // Array of numbers
                    }
                ],
                xaxis: {
                    categories: labels // Labels for the x-axis
                },
                plotOptions: {
                    bar: {
                        distributed: true, // Enables different colors for each bar
                    }
                },
                colors: predefinedColors, // Array of colors
                title: {
                    text: type == '' ? 'OPPD': type,
                    align: 'center'
                },
                legend: {
                    position: 'bottom'
                }
            };
    
            const chart = new ApexCharts(document.querySelector("#asset_chart"), options);
            chart.render();
            $('#asset_group_condition').empty()
          
           
        });
    })
})
getCallbackNoSwal('assetChart', null, function(response){
    $(document).ready(function () {
        $('#asset_chart').empty(); // Clear the container if needed
        const labels = response.data.map(item => item.kondisi_label); // Extract labels
        const seriesData = response.data.map(item => item.total); // Extract numerical data
        const predefinedColors = ['#1E90FF', '#FFD700', '#FF6347', '#32CD32']; // Define colors for each bar
        const options = {
            chart: {
                type: 'bar', // Bar chart type
                height: 350
            },
            series: [
                {
                    name: 'OPPD',
                    data: seriesData // Array of numbers
                }
            ],
            xaxis: {
                categories: labels // Labels for the x-axis
            },
            plotOptions: {
                bar: {
                    distributed: true, // Enables different colors for each bar
                }
            },
            colors: predefinedColors, // Array of colors
            title: {
                text: 'OPPD',
                align: 'center'
            },
            legend: {
                position: 'bottom'
            }
        };

        const chart = new ApexCharts(document.querySelector("#asset_chart"), options);
        chart.render();
        $('#asset_group_condition').empty() 
    });
})
$('#pengajuan_asset_table').DataTable().clear().destroy();
$('#pengajuan_asset_table').DataTable({
    scrollY:200,
    processing: true,
    serverSide: true,
    ajax: {
        url: `getPengajuanAsset`,
        type: 'GET',
    },
    columns: [
        { data: 'satgas', name: 'satgas' },
        { data: 'no_un', name: 'no_un' },
        { data: 'category', name: 'category' },
        { data: 'sub_category', name: 'sub_category' },
        // { data: 'type', name: 'type' },
        // { data: 'brand', name: 'brand' },
        { data: 'no_mesin', name: 'no_mesin' },
        { data: 'no_rangka', name: 'no_rangka' },
        {
            data: 'status_pengajuan',
            name: 'status_pengajuan',
            render: function(data, type, row) {
                switch (data) {
                    case 1:
                        return 'Draft';
                    case 2:
                        return 'Partially Approve';
                    case 3:
                        return 'On Progress';
                    case 4:
                        return 'Done';
                    default:
                        return 'Unknown'; // Handle unexpected values
                }
            }
        },
    ]
});

$('.pengajuan_filter').on('click', function(){
    var pengajuan = $(this).data('pengajuan')
    var data = {
        'pengajuan' : pengajuan
    }
  
    $('#pengajuan_asset_table').DataTable().clear().destroy();
    $('#pengajuan_asset_table').DataTable({
        scrollY:200,
        processing: true,
        serverSide: true,
        ajax: {
            url: `getPengajuanAssetFilter`,
            type: 'GET',
            data : data
        },
        columns: [
            { data: 'satgas', name: 'satgas' },
            { data: 'no_un', name: 'no_un' },
            { data: 'category', name: 'category' },
            { data: 'sub_category', name: 'sub_category' },
            // { data: 'type', name: 'type' },
            // { data: 'brand', name: 'brand' },
            { data: 'no_mesin', name: 'no_mesin' },
            { data: 'no_rangka', name: 'no_rangka' },
            {
                data: 'status_pengajuan',
                name: 'status_pengajuan',
                render: function(data, type, row) {
                    switch (data) {
                        case 1:
                            return 'Draft';
                        case 2:
                            return 'Partially Approve';
                        case 3:
                            return 'On Progress';
                        case 4:
                            return 'Done';
                        default:
                            return 'Unknown'; // Handle unexpected values
                    }
                }
            },
        ]
    });
})
