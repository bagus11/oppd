getCallback('getCompany', null, function(response){
    swal.close()
    console.log(response)
    mappingTable(response.data)
})

$('#btn_add_company').on('click', function(){
    getActiveItems('getCompanyType',null,'select_type','Type')
    getActiveItems('getCompanyLevel',null,'select_company_level','Level')
})

// Function
    function mappingTable(response){
        $('#company_table').DataTable().clear();
        $('#company_table').DataTable().destroy();
        var data =''
        for(i =0; i < response.length; i++){
            var status = response[i].status == 1 ?'Active' : 'inactive'
            data += `
                <tr>
                       <td> ${status}</td> 
                       <td> ${response[i].user_relation.employee_code}</td>
                       <td> ${response[i].user_relation.name}</td>
                       <td> ${response[i].user_relation.location}</td>
                </tr>
            `
        }
        $('#company_table > tbody:first').html(data);    
        var table = $('#company_table').DataTable({
            scrollX     : true,
            scrollY     :300,
            // language: {
            //         'paginate': {
            //         'previous': '<span class="prev-icon"><i class="fa-solid fa-arrow-left"></i></span>',
            //         'next': '<span class="next-icon"><i class="fa-solid fa-arrow-right"></i></span>'
            //         }
            //     },
            // scrollY     :300,
            // searching   :false
        }).columns.adjust()
        autoAdjustColumns(table)
    }
// Function