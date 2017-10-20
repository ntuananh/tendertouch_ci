/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function generateStaffSelect ($select, blankOption) {
    
    var data = getStaffIdAndName();

    var result = '';
    if (blankOption) {
        result += '<option tid="1"></option>';
    }
    for (var i= 0; i < data.length; i++) {
        result += '<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>';
    }
    $select.append(result);
}
function generateServiceSelect ($select, blankOption) {
    
    var data = getServices();

    var result = '';
    if (blankOption) {
        result += '<option tid=""></option>';
    }
    for (var i= 0; i < data.length; i++) {
        result += '<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>';
    }
    $select.append(result);
}
