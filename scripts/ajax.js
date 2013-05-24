$(document).ready(function() {
        
        $("#target").submit(function(event){
                var myForm=document.getElementById("target");   
                var $form = $(this),
                $inputs = $form.find("input, select, button, textarea"),
                serializedData = $form.serialize();
                $inputs.attr("disabled", "disabled");
                
                var request = $.ajax({
                        url: "/app/validate.php",
                        type: "post",
                        data: serializedData,
                        dataType: 'json',
                        success: function(response, textStatus, jqXHR){
                                $inputs.removeAttr("disabled");
                                
                                if(response.nameError!='')$('#nameError').html(response.nameError);else $('#nameError').html('')
                                if(response.emailError!='')$('#emailError').html(response.emailError);else $('#emailError').html('')
                                if(response.recaptchaError!=''){
                                        $('#recaptchaError').html(response.recaptchaError);
                                        Recaptcha.reload();
                                }
                                else $('#recaptchaError').html('')
                                
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                                $('.status').html("<div id='thanksform'><h2>Oops... Something go wrong. Try to send it to our email.</h2></div>");              
                        },                                              
                });
                request.done(function(response) {
                          console.log(response);
                          if(response.error==false)     
                                  $('.status').html(response.done);
                                
                        });
                request.fail(function(jqXHR, textStatus) {
                          
                        });
                request.always(function(jqXHR, textStatus) {
                          
                        });
                event.preventDefault();        
        });

});