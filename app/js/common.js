$(function() {
    
    $(".sendformbut").click(function() {
        var myform = $(this).closest("form"); //parent form
        // var phone = myform.$(".name").val();
        // if (phone != ""){
        $.ajax({
               type: "POST",
               url: "formsendmail.php",
               data: myform.serialize(), // serializes the form elements.
               success: function(data)
               {
                myform.html(data);
               }
             });
            
        return false; // avoid to execute the actual submit of the form.
        // }
     });
});
