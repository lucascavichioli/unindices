(function ($) {
    "use strict";

    
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    
    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
           if($(input[i]).attr('type') == 'password'){
                if($(input[i]).attr('name') == 'senha'){
                var senha1 = input[i].value;
                }
                if($(input[i]).attr('name') == 'senhaConfirmada'){
                var senha2 = input[i].value;
                }
            }
        }

        /*let senha1 = input[5].value;
        let senha2 = input[6].value;*/

        if(senha1 !== senha2){
            $('#senha2').attr('data-validate', 'As senhas não coincidem');
            $('#senha2').addClass('alert-validate');
            check = false;
        }

            if(check){
                Swal.fire({
                    type: 'success',
                    title: 'Dados enviados com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
            return check;

        

    });

    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {

        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);

function MascaraTelefone(telefone){
    if(mascaraInteiro(telefone)==false){
        event.returnValue = false;
    }       
    return formataCampo(telefone, '(00)0000-00000', event);
}

function MascaraCNPJ(cnpj){
    if(mascaraInteiro(cnpj)==false){
            event.returnValue = false;
    }       
    return formataCampo(cnpj, '00.000.000/0000-00', event);
}

function mascaraInteiro(){
    if (event.keyCode < 48 || event.keyCode > 57){
            event.returnValue = false;
            return false;
    }
    return true;
}

function formataCampo(campo, Mascara, evento) { 
    var boleanoMascara; 

    var Digitato = evento.keyCode;
    exp = /\-|\.|\/|\(|\)| /g
    campoSoNumeros = campo.value.toString().replace( exp, "" ); 

    var posicaoCampo = 0;    
    var NovoValorCampo="";
    var TamanhoMascara = campoSoNumeros.length;; 

    if (Digitato != 8) { // backspace 
            for(i=0; i<= TamanhoMascara; i++) { 
                    boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
                                                            || (Mascara.charAt(i) == "/")) 
                    boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
                                                            || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
                    if (boleanoMascara) { 
                            NovoValorCampo += Mascara.charAt(i); 
                              TamanhoMascara++;
                    }else { 
                            NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
                            posicaoCampo++; 
                      }              
              }      
            campo.value = NovoValorCampo;
              return true; 
    }else { 
            return true; 
    }
}

function MascaraCPF(cpf){
    if(mascaraInteiro(cpf)==false){
            event.returnValue = false;
    }       
    return formataCampo(cpf, '000.000.000-00', event);
}

function validaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
  if (strCPF == "00000000000") return false;
     
  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
   
  Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

function validaCNPJ(cnpj){

    var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
    var dig1= new Number;
    var dig2= new Number;

    exp = /\.|\-|\//g
    cnpj = cnpj.toString().replace( exp, "" ); 
    var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));

    for(i = 0; i<valida.length; i++){
            dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);  
            dig2 += cnpj.charAt(i)*valida[i];       
    }
    dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
    dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));

    if(((dig1*10)+dig2) != digito){
        return false;
    }
        return true;
    
}

function localidade(){  

    var cep = $('#cep').val().trim();  

    $.get("https://viacep.com.br/ws/" + cep + "/json/", function(data, status){
        document.getElementById("logradouro").value = data.logradouro;
        document.getElementById("cidade").value = data.localidade;
        document.getElementById("uf").value = data.uf;
        var elt = document.getElementById("uf");
        var opt = elt.getElementsByTagName("option");
        for(var i = 0; i < opt.length; i++) {
          if(opt[i].value == data.uf) {
            elt.value = data.uf;
            $("#uf").addClass("selectReadonly");
          }
        }

    }, 'json')
    .fail(function(){
        $("#uf").removeClass("selectReadonly");
        document.getElementById("logradouro").value = "";
        document.getElementById("cidade").value = "";
        document.getElementById("uf").value = "";
    });

} 

function validaCEP(cep){
    var validacep = /^[0-9]{8}$/;

    if(validacep.test(cep)){
        return true;
    }else{
        return false;
    }

}

function MascaraCEP(cep){
    if(mascaraInteiro(cep)==false){
            event.returnValue = false;
    }       
    return formataCampo(cep, '00000000', event);
}

/*function maskIt(w,e,m,r,a){
    // Cancela se o evento for Backspace
    if (!e) var e = window.event
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    // Variáveis da função
    var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
    var mask = (!r) ? m : m.reverse();
    var pre  = (a ) ? a.pre : "";
    var pos  = (a ) ? a.pos : "";
    var ret  = "";
    if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
    // Loop na máscara para aplicar os caracteres
    for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
    if(mask.charAt(x)!='#'){
    ret += mask.charAt(x); x++; } 
    else {
    ret += txt.charAt(y); y++; x++; } }
    // Retorno da função
    ret = (!r) ? ret : ret.reverse()	
    w.value = pre+ret+pos; }
    // Novo método para o objeto 'String'
    String.prototype.reverse = function(){
    return this.split('').reverse().join(''); 
    }; 
    */


   function mascaraMoeda(obj){
    validaNum(obj)
    if (obj.value.match("-")){
      mod = "-";
    }else{
      mod = "";
    }
    valor = obj.value.replace("-","");
    valor = valor.replace(",","");
    if (valor.length >= 3){
      valor = poePontoNum(valor.substring(0,valor.length-2))+","+valor.substring(valor.length-2, valor.length);
    }
    obj.value = mod+valor;
  }
  function poePontoNum(valor){
    valor = valor.replace(/\./g,"");
    if (valor.length > 3){
      valores = "";
      while (valor.length > 3){
        valores = "."+valor.substring(valor.length-3,valor.length)+""+valores;
        valor = valor.substring(0,valor.length-3);
      }
      return valor+""+valores;
    }else{
      return valor;
    }
  }
  function validaNum(obj){
    numeros = new RegExp("[0-9]");
    while (!obj.value.charAt(obj.value.length-1).match(numeros)){
      if(obj.value.length == 1 && obj.value == "-"){
        return true;
      }
      if(obj.value.length >= 1){
        obj.value = obj.value.substring(0,obj.value.length-1)
      }else{
        return false;
      }
    }
  }

$(".excluirEmpresa").click(function(){
  
  Swal.fire({
    title: 'Tem certeza que deseja excluir esta empresa?',
    text: "Todos os dados financeiros serão excluídos!",
    type: 'warning',
    showCancelButton: true,
    cancelButtonText: 'Não',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, quero excluir!'
  }).then((result) => {
      if (result.value) {
          $.ajax({
            type: "POST",
            url: "/TCC/empresacliente/ajaxexcluirempresa",
            dataType: "json",
            data: {"empresa": $(this).attr("empresa")},
            success: function(response){
              Swal(
                'Excluido!',
                'Todos os dados desta empresa foram excluídos com sucesso.',
                'success'
              );
            }
          })
      }
  });
});

function teste(){
  $('#modalCnae').modal();
}