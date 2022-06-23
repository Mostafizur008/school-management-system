

<script>

    $(document).ready(function (){

        fetchgroup();
    
    function fetchgroup() {
        $.ajax({
        type: "GET",                          
        url: "/fetch-group",                     
        dataType: "json",
    });
    }
    
    
    
    $(document).on('click', '.add_group', function (e) {       
        e.preventDefault();
        var data = {
            'name': $('.name').val(),
        }
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    
        $.ajax({
            type: "POST",          
            url: "/group",      
            data: data,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 400) {
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_value) {
                        $('#save_msgList').append('<li>' + err_value + '</li>');
                    });
                   
                } else {
                    $('#save_msgList').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#addmodal').find('input').val('');   
                    $('#addmodal').modal('hide');              
                    fetchgroup();                            
                   
                }
            }
        });
       });
    
    
    
    //---------------------------------------edit-------------------------------------------
    
    
    
    $(document).on('click', '.editbtn', function (e) {      
        e.preventDefault();
        var group_id = $(this).val();                       
        // alert(stud_id);
        $('#editmodal').modal('show');                     
        $.ajax({
            type: "GET",                                
            url: "/edit-group/" + group_id,                 
            success: function (response) {
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editmodal').modal('hide');         
                } else {
                    // console.log(response.student.name);
                    $('#edit_name').val(response.group.name);
                    $('#edit_group_id').val(group_id);                   
                }
            }
        });
    });
    
    $(document).on('click', '.edit_group', function (e) { 
        e.preventDefault();
        var id = $('#edit_group_id').val();             
        
        var data = {
            'name': $('#edit_name').val(),
        }
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: "PUT",                             
            url: "/update-group/" + id,                 
            data: data,                                 
            dataType: "json",                        
            success: function (response) {
                // console.log(response);
                if (response.status == 400) {
                    $('#update_msgList').html("");
                    $('#update_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_value) {
                        $('#update_msgList').append('<li>' + err_value +
                            '</li>');
                    });
                  
                } else {
                    $('#update_msgList').html("");              
                    $('#success_message').addClass('alert alert-success'); 
                    $('#success_message').text(response.message);
                    $('#editmodal').modal('hide');   
                    fetchgroup();
                }
            }
        });
    
    
    });
    
    //-------------------------------------------delete----------------------------
    
    $(document).on('click', '.deletebtn', function () {
    var group_id = $(this).val();
    $('#deletemodal').modal('show');
    $('#deleteing_id').val(group_id);
    });
    
    $(document).on('click', '.deleteb', function (e) {
    e.preventDefault();
    var id = $('#deleteing_id').val();
    
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    $.ajax({
            type: "DELETE",
            url: "/delete-group/" + id,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                } else {
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#deletemodal').modal('hide');
                    fetchgroup();
                }
            }
        });
    });
    
    
    
    });
    
    </script>
 