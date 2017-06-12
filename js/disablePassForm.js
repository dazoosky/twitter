$(function() {
   var checkbox = $('#changePassword')
   var passForm = $('.password')
   checkbox.on('click', function(){
       if ($(this).prop('checked')) {
            for (var i = 0; i < passForm.length; i++) {
                passForm[i].removeAttribute('readonly');
            }
       }     
       else {
            for (var i = 0; i < passForm.length; i++) {
                passForm[i].setAttribute('readonly', 'readonly');
            }
       }
   }) 

});