/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var server_add = 'http://tendertouch.local/index.php/';

function getStaffIdAndName() {
    $result = '';
    $.ajax({
        url: server_add + 'api/getStaffIdAndName',
        method: 'post',
        dataType: 'json',
        data : {
            type: [1, 2]
        },
        success: function (data) {
            $result = data;
        },
        async: false
    });
    return $result;
}
function getServices() {
    $result = '';
    $.ajax({
        url: server_add + 'api/getServices',
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $result = data;
        },
        async: false
    });
    return $result;
}
function getAppointments(date) {
    $result = '';
    $.ajax({
        url: server_add + 'api/getAppointments',
        method: 'post',
        dataType: 'json',
        data : {
            date: date
        },
        success: function (data) {
            $result = data;
        },
        async: false
    });
    return $result;
}
function getDetailAppointment(id) {
    $result = '';
    $.ajax({
        url: server_add + 'api/getDetailAppointment/'+id,
        method: 'get',
        dataType: 'json',
        success: function (data) {
            $result = data;
        },
        async: false
    });
    return $result;
}