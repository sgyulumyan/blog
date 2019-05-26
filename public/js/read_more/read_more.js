$( document ).ready(function() {
 
    $('#AddComment').click(function(){
        var token = $('meta[name="csrf-token"]').attr('content');
        var user_id = $("#user_id").val();
        var post_id = $("#post_id").val();
        
        var comment = $("#comment_body").val();
        var login = $("#user_id").data('name');
        
        $.ajax({
            method:'post',
            url: "/readmore/addcomment",
            data:{user_id:user_id, post_id:post_id, comment_body:comment,_token:token},
            success: function(result){
                if(result.success){

                                
                    var comm = result.comment

                    var data = '<div><h5>'+login+','+comm.created_at+'</h5><p>'+comment+'</div></p>'
                    var empty= '<div><textarea>'+empty+'</textarea></div>';
                    // var empty = '<textarea>'+comment_body+'</textarea>'
                    $('#commentbox').append(data)
                                       
                }
                $('#comment_body').val("");
             // window.location.reload();
        }});
    })
});

