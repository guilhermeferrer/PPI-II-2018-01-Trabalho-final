$(document).ready(function () {
    $('#cep').mask('00000-000');

    /*
     $('#form-search').validate({
     rules:{
     cep: {
     required: true,
     minlength: 9,
     maxlength: 9
     }
     },
     errorPlacement: function(){
     return false;
     }
     });*/

    $("#butao1").click(function () {
        $.ajax({
            type: 'GET',
            url: '/texto.html',
            data: "",
            success: function (dados) {
                $("#div_retorno").html(dados);
            },
            beforeSend: function () {
                $("#processando").css({display: "block"});
            },
            complete: function () {
                $("#processando").css({display: "none"});
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});
$(document).ready(function () {
    $("#form-login").submit(function (e) {
        e.preventDefault(); // evita que o formulário seja submetido
        $.ajax({
            type: 'POST',
            url: '/logar',
            data: $("#form-login").serializeArray(),
            success: function (dados) {
                $(".retorno-login").html(dados);
            },
            beforeSend: function () {
                $("#processando").css({display: "block"});
            },
            complete: function () {
                $("#processando").css({display: "none"});
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});

$(document).ready(function () {
    $("#form-login-loja").submit(function (e) {
        e.preventDefault(); // evita que o formulário seja submetido
        $.ajax({
            type: 'POST',
            url: '/acao-logar-loja',
            data: $("#form-login-loja").serializeArray(),
            success: function (dados) {
                $(".retorno-login").html(dados);
            },
            beforeSend: function () {
                $("#processando").css({display: "block"});
            },
            complete: function () {
                $("#processando").css({display: "none"});
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});

$(document).ready(function () {
    $(".form-alterar-endereco").submit(function (e) {
        e.preventDefault(); 
        $.ajax({
            type: 'POST',
            url: '/acao-alterar-endereco',
            data: $(".form-alterar-endereco").serializeArray(),
            success: function (dados) {
                $(".retorno-alterar-endereco").html(dados);
            }
        });
    });
});

$(document).ready(function () {
    $(".user-account").submit(function (e) {
        e.preventDefault(); 
        $.ajax({
            type: 'POST',
            url: '/user-account-update',
            data: $(".user-account").serializeArray(),
            success: function (dados) {
                $(".retorno-alterar-cadastro").html(dados);
            }
        });
    });
});

$(document).ready(function () {
    $('#cpf').mask('000.000.000-00');
    $('#telefone').mask('(00) 0000-0000');
    $('#celular').mask('(00) 00000-0000');
    $("#form-cadastro-user").submit(function (e) {
        e.preventDefault();
        $('#form-cadastro-user').validate({
            rules: {
                cpf: {
                    required: true
                },
                nome: {
                    required: true
                },
                email: {
                    required: true
                },
                senha: {
                    required: true
                },
                senha2: {
                    required: true
                },
                telefone: {
                    required: true
                },
                celular: {
                    required: true
                }
            },
            submitHandler: function () {
                $.ajax({
                    type: 'POST',
                    url: '/cadastro-usuario',
                    data: $("#form-cadastro-user").serializeArray(),
                    success: function (dados) {
                        $(".retorno-cadastro").html(dados);
                    },
                    beforeSend: function () {
                        $("#processando").css({display: "block"});
                    },
                    complete: function () {
                        $("#processando").css({display: "none"});
                    },
                    error: function () {
                        $("#div_retorno").html("Erro em chamar a função.");
                        setTimeout(function () {
                            $("#div_retorno").css({display: "none"});
                        }, 5000);
                    }
                });
            }
        });
    });
});

/*
 $(document).ready(function () {
 $("#form-login-loja").submit(function (e) {
 alert("Ok");
 e.preventDefault(); // evita que o formulário seja submetido        
 $.ajax({
 type: 'POST',
 url: '/logar-loja',
 data: $("#form-login-loja").serializeArray(),
 success: function (dados) {
 $("#div_retorno").html(dados);
 },
 beforeSend: function () {
 $("#processando").css({display: "block"});
 },
 complete: function () {
 $("#processando").css({display: "none"});
 },
 error: function () {
 $("#div_retorno").html("Erro em chamar a função.");
 setTimeout(function () {
 $("#div_retorno").css({display: "none"});
 }, 5000);
 }
 });
 });
 });*/


$(document).ready(function () {
    $("#selecty").on('change', function (e) {
        
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    $codigo = $(this).parent().find("#codigo").val();
    $.ajax({
            type: 'POST',
            url: '/acao-trocar-quantidade',
            data: {
                codigo: $codigo,
                quantidade: valueSelected
            },
            success: function (dados) {
                window.location.href = '/carrinho';
            }
    });
});

});

$(document).ready(function () {
    $("#limpar-carrinho").click(function () {
        $.ajax({
            url: '/limpar-carrinho',
            success: function (dados) {                
                window.location.href = '/carrinho';
            }
        });
    });
});
$(document).ready(function () {
    $("#finalizar-compra").click(function () {
        $.ajax({
            url: '/carrinho/acao-compra',
            success: function (dados) {
                $("#result").html(dados);
            }
        });
    });
});

$(document).ready(function () {
    //$('#cnpj').mask('00.000.000/0000-00');
    $('#cep').mask('00000-000');
    $('#numero').mask('999999');
    $('#uf').mask('AA');
    $("#form-cadastrar-loja").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/acao-cadastrar-loja',
            data: $("#form-cadastrar-loja").serializeArray(),
            success: function (dados) {
                $(".retorno-cadastro").html(dados);
            }
        });
    });
});

$(document).ready(function () {
    $(".shop-account").submit(function (e) {        
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/shop-account-update',
            data: $(".shop-account").serializeArray(),
            success: function (dados) {
                $(".retorno-alterar-shop").html(dados);
            }
        });
    });
});

$(document).ready(function () {
    $("#recebido").click(function () {
        window.location.href = '/shop-home';
    });
});
$(document).ready(function () {
    $("#em-preparo").click(function () {
        window.location.href = '/shop-home-preparo';
    });
});
$(document).ready(function () {
    $("#mover-preparo").click(function () {
        var status = 1;
        var id = $(this).find("#id_compra").val();
        $.ajax({
            type: 'POST',
            url: '/shop-pedidos-mudar-status',
            data: {
                   status: status,
                   id: id
            },
            success: function (dados) {
                window.location.href = '/shop-home';
            }
        });
    });
});

$(document).ready(function () {
    $("#mover-entrega").click(function () {
        var status = 2;
        var id = $(this).find("#id_compra").val();
        $.ajax({
            type: 'POST',
            url: '/shop-pedidos-mudar-status',
            data: {
                   status: status,
                   id: id
            },
            success: function (dados) {
                window.location.href = '/shop-home-preparo';
            }
        });
    });
});

$(document).ready(function () {
    $("#mover-fim").click(function () {
        var status = 3;
        var id = $(this).find("#id_compra").val();
        $.ajax({
            type: 'POST',
            url: '/shop-pedidos-mudar-status',
            data: {
                   status: status,
                   id: id
            },
            success: function (dados) {
                window.location.href = '/shop-home-entrega';
            }
        });
    });
});

$(document).ready(function () {
    $("#entrega").click(function () {
        window.location.href = '/shop-home-entrega';
    });
})

$(document).ready(function () {
    $("#form-address-update").submit(function (e) {        
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/shop-address-update',
            data: $("#form-address-update").serializeArray(),
            success: function (dados) {
                $(".retorno-alterar-endereco").html(dados);
            }
        });
    });
});

$(document).ready(function () {
    $("#form-add-product").submit(function (e) {   
        var formData = new FormData(this);

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/shop-add-product',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (dados) {
                $(".retorno-add-product").html(dados);
            }
        });
    });
});
$(document).ready(function () {
    $("#form-update-product").submit(function (e) {  
        var formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/shop-update-product',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (dados) {
                $(".retorno-update-product").html(dados);
            }
        });
    });
});
$(document).ready(function () {
    var x = 0;
    var id;
    $(".pedido-item").click(function () {
        //$(this).find(".status").toggleClass("display");

        if(id == $(this).find(".status").attr("id")){
            if(x == 0){
                $(".status").css("height", "0");
                $(".status").css("visibility", "hidden");
                $(this).find(".status").css("height", "auto");
                $(this).find(".status").css("visibility", "visible");
                x = 1;
            }else {
                $(this).find(".status").css("height", "0");
                $(this).find(".status").css("visibility", "hidden");
                x = 0;
            }
        }else{
            id = $(this).find(".status").attr("id");
            $(".status").css("height", "0");
            $(".status").css("visibility", "hidden");
            $(this).find(".status").css("height", "auto");
            $(this).find(".status").css("visibility", "visible");
            x = 1;
        }
    });
});
