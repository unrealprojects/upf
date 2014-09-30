upf.Auth = {};

upf.Auth.Enter = function(){
    // Default Variables
    var AuthButton = '#Auth input[type=submit]',
        AuthForm = 'form#Auth',
        LogPath = '/backend/login';

    // Update body
    $(document).on('click',AuthButton,function(){
        // Function Variables
        var This = this;

        // Send Ajax to "/alias/update"
        $.ajax({
            type:'post',
            url:LogPath,
            data: $(AuthForm).serialize(),
            dataType:'json',
            success: function(Data){
                if(Data['type']=='Success'){
                    location.href='/backend/';
                }else{
                    upf.Messages.Show(Data['message'],Data['type']);
                }
            }
        });
        return false;
    });
}

upf.Auth.Enter();