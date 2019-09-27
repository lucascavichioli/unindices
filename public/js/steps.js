$(function(){
  var atual_fs, prox_fs, ant_fs;

  $('.nextTwo').click(function(){
    var check = true;
    var nomeEmpresa = document.getElementById('nomeEmpresa').value;
    var atvEmpresa = document.getElementById('atvPrincipal').value;
    var responsavel = document.getElementById('responsavel').value;
    var telefone = document.getElementById('telefone').value;
    var regex = new RegExp('^\\([0-9]{2}\\)((3[0-9]{3}-[0-9]{4})|(9[0-9]{3}-[0-9]{5}))$');
    if(nomeEmpresa.trim() == ''){
      $('#divNomeEmpresa').addClass('alert-validate');
      check = false;
    }
    if(atvEmpresa.trim() == ''){
      $('#divAtvEmpresa').addClass('alert-validate');
      check = false;
    }
    if(responsavel.trim() == ''){
      $('#divResponsavel').addClass('alert-validate');
      check = false;
    } 
    if(!regex.test(telefone)){
      $('#divTelefone').addClass('alert-validate');
      check = false;
    }
    if(check){
    
      atual_fs = $(this).parent();
      prox_fs = $(this).parent().next();

      $('#progress li').eq($('fieldset').index(prox_fs)).addClass('ativo');
      atual_fs.hide(800);
      prox_fs.show(800);
    }
  });


$(document).ready(function() {  
    $('#cep').focusout(function(){
      localidade();
    });
});

$('.nextCont').click(function(){
  var check = true;
  var nomeContador = document.getElementById('nomeContador').value;
  var cep = document.getElementById('cep').value;
  var telefone = document.getElementById('telefone').value;
  var regex = new RegExp('^\\([0-9]{2}\\)((3[0-9]{3}-[0-9]{4})|(9[0-9]{3}-[0-9]{5}))$');

  if(nomeContador.trim() == ''){
    $('#divNomeCompleto').addClass('alert-validate');
    check = false;
  }
  if(cep.trim() == '' || !validaCEP(cep)){
    $('#divCep').addClass('alert-validate');
    check = false;
  }
  if(!regex.test(telefone)){
    $('#divTelefone').addClass('alert-validate');
    check = false;
  }

  if(check){ 
    atual_fs = $(this).parent();
    prox_fs = $(this).parent().next();

    $('#progress li').eq($('fieldset').index(prox_fs)).addClass('ativo');
    atual_fs.hide(800);
    prox_fs.show(800);
  }
});


  $('.nextCpf').click(function(){
    var crc = document.getElementById('crc').value;
    var strCPF = document.getElementById('cpf').value.replace(".", "").replace(".", "").replace("-", "");
            if(!validaCPF(strCPF)){
              $('#divCpf').addClass('alert-validate');
            }else{
              if(crc.trim() != ""){
                  atual_fs = $(this).parent();
                  prox_fs  = $(this).parent().next();
              
                  $('#progress li').eq($('fieldset').index(prox_fs)).addClass('ativo');
                  atual_fs.hide(800);
                  prox_fs.show(800);
              }else{
                $('#divCrc').addClass('alert-validate');
              }
                  
                  /*const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  })
                  
                  Toast.fire({
                    type: 'success',
                    title: 'Signed in successfully'
                  })*/
               
            }
  });

  
  $('.prev').click(function(){
    atual_fs = $(this).parent();
    ant_fs = $(this).parent().prev();

    $('#progress li').eq($('fieldset').index(atual_fs)).removeClass('ativo');
    atual_fs.hide(800);
    ant_fs.show(800);
  });


  $('.nextCnpj').click(function(){
    var cnpj = document.getElementById('cnpj').value.replace(".", "").replace(".", "").replace("/", "").replace("-", "");
            if(!validaCNPJ(cnpj)){
              $('#divCnpj').addClass('alert-validate');
            
            }else{
              $.get("https://www.receitaws.com.br/v1/cnpj/"+ cnpj, function(data, status){ 
                if(status == 'success'){
                      if(data.status !== "ERROR"){
                            if(data.situacao === "ATIVA"){
                                document.getElementById('nomeEmpresa').value = data.nome;
                                document.getElementById('atvPrincipal').value = data.atividade_principal[0]["code"];
                                document.getElementById('atvPrincipal').setAttribute("readonly","readonly");
                                document.getElementById('nomeEmpresa').setAttribute("readonly","readonly");
                            }
                      }
                  
                  }                  
                }, 'jsonp')

                .done(function(){
                  console.log('Consulta realizada com sucesso.');
                })
                
                .fail(function(){
                  Swal.fire({
                    title: 'Aviso!',
                    text: 'Erro ao buscar dados. Por favor preencha os dados corretamente',
                    type: 'warning',
                    confirmButtonText: 'Ok'
                  })
                });

                  atual_fs = $(this).parent();
                  prox_fs = $(this).parent().next();
              
                  $('#progress li').eq($('fieldset').index(prox_fs)).addClass('ativo');
                  atual_fs.hide(800);
                  prox_fs.show(800);
            }
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