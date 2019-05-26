// post editing
$( document ).ready(function() {
    $('.post_edit').click(function(){
    	// alert();
    	var id = $(this).data('id');
    	var post = $('#post_'+id).html();
    	var name = $('#post_name_'+id).html();
    	$('#edit_name').val(name)
    	$('#edit_post').val(post)
    	$('#edit_post_Changes').attr('data-id',id)

    	$('#Post_Edit_Modal').modal('show')
    	// $('#Post_Edit_Modal').modal('show');
    });

    $('#edit_post_Changes').click(function(){
    	var token = $('meta[name="csrf-token"]').attr('content')
    	var id = $(this).data('id');
    	var name = $('#edit_name').val()
    	var post = $('#edit_post').val()
    	console.log(post)
    	
    	$.ajax({
    		method:'post',
    		url: "/post/edit",
    		data:{id:id,post_body:post,post_name:name,_token:token},
    		success: function(result){
		    window.location.reload();
		}});
    })
});

// comment editing
$( document ).ready(function() {
    $('.comment_edit').click(function(){
        // alert();
        var id = $(this).data('id');
        var comment = $('#comment_'+id).html();
        
        $('#edit_comment').val(comment)
        $('#edit_comment_Changes').attr('data-id',id)

        $('#Comment_Edit_Modal').modal('show')
        // $('#Post_Edit_Modal').modal('show');
    });

    $('#edit_comment_Changes').click(function(){
        var token = $('meta[name="csrf-token"]').attr('content')
        var id = $(this).data('id');
        var comment = $('#edit_comment').val()
        console.log(comment)
        
        $.ajax({
            method:'post',
            url: "/comment/edit",
            data:{id:id,comment_body:comment,_token:token},
            success: function(result){
            window.location.reload();
        }});
    })

});

// comment deleting

$( document ).ready(function() {
    $('.comment_delete').click(function(){
        // alert();
        var id = $(this).data('id');
        var comment = $('#comment_'+id).html();
        
        
        $('#delete_comment').val(comment)
        $('#delete_comment_Changes').attr('data-id',id)

        $('#Comment_Delete_Modal').modal('show')
        // $('#Post_Edit_Modal').modal('show');
    });

    $('#delete_comment_Changes').click(function(){
        var token = $('meta[name="csrf-token"]').attr('content')
        var id = $(this).data('id');
        
        var comment = $('#delete_comment').val()
        console.log(comment)
        
        $.ajax({
            method:'post',
            url: "/comment/delete",
            data:{id:id,_token:token},
            success: function(result){
            window.location.reload();
        }});
    })
});

// post deleting

$( document ).ready(function() {
    $('.post_delete').click(function(){
        // alert();
        var id = $(this).data('id');
        var post = $('#post_'+id).html();
        // console.log(id);
        
        $('#delete_post').val(post)
        $('#delete_post_Changes').attr('data-id',id)

        $('#Post_Delete_Modal').modal('show')
        // $('#Post_Edit_Modal').modal('show');
    });

    $('#delete_post_Changes').click(function(){
        var token = $('meta[name="csrf-token"]').attr('content')
        var id = $(this).data('id');
        
        var post = $('#delete_post').val()
            
        $.ajax({
            method:'post',
            url: "/post/delete",
            data:{id:id,_token:token},
            success: function(result){
            window.location.reload();
        }});
    })
});