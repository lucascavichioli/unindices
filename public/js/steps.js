$(function(){
  var atual_fs, prox_fs, ant_fs;

  $('.next').click(function(){
    atual_fs = $(this).parent();
    prox_fs = $(this).parent().next();

    $('#progress li').eq($('fieldset').index(prox_fs)).addClass('ativo');
    atual_fs.hide(800);
    prox_fs.show(800);
  });

  
  $('.prev').click(function(){
    atual_fs = $(this).parent();
    ant_fs = $(this).parent().prev();

    $('#progress li').eq($('fieldset').index(atual_fs)).removeClass('ativo');
    atual_fs.hide(800);
    ant_fs.show(800);
  });


  $('#formulario input[type=submit]').click(function(){
      return false;
  });

});