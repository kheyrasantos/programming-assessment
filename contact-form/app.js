$('#submit').on( 'click', function( e ) {
    e.preventDefault();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $("#email").val();
    var website = $('#website').val();
    var message = $('#message').val();

    $.ajax({
        url:"db.php",
        type:"GET",
        data: { first_name: first_name, last_name: last_name, email: email, website: website, message: message },
        success:function(data){
            console.log(data);
        }
    });
});