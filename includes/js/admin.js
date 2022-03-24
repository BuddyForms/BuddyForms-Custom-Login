jQuery( document ).ready(function($) {
    var redirect_logged_off_users = $("#buddyforms_custom_login_redirect_logged_off_user").val();
    if(redirect_logged_off_users == "No"){
        $(".bfcl_use_custom_url, .bfcl_set_custom_url").hide();
    }
    hideInputUrl();
    $('#buddyforms_custom_login_redirect_logged_off_user').change(function(){
        if($(this).val()=="No"){
            $(".bfcl_use_custom_url").hide();
        } else{
            $(".bfcl_use_custom_url").show();
        }
        hideInputUrl();
    });

    $("#buddyforms_custom_login_use_custom_redirect_url").click(function() {
        if($(this).is(":checked")){
            $(".bfcl_set_custom_url").show();
        } else{
            $(".bfcl_set_custom_url").hide();
        }
    });

    function hideInputUrl(){
        if(!$("#buddyforms_custom_login_use_custom_redirect_url").is(":checked")){
            $(".bfcl_set_custom_url").hide();
        } 
    }
}); 