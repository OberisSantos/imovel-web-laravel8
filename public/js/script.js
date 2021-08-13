
function time()
{
    let agora = new Date();
    let dia = agora.getDate().toString().padStart(2, '0');
    let mes = (agora.getMonth()+1).toString().padStart(2, '0');
    let ano = agora.getFullYear();
    let h=agora.getHours().toString().padStart(2, '0');
    let m=agora.getMinutes().toString().padStart(2, '0');
    let s=agora.getSeconds().toString().padStart(2, '0');

    let date = `${dia}/${mes}/${ano}`;
    document.getElementById('data').innerHTML=date;
    document.getElementById('hora').innerHTML=h+":"+m+":"+s;
    setTimeout('time()',500);
}

$(document).ready(function(){
    $('#cpf').mask('000.000.000-00');
    $('#tel').mask('(99)9 9999-9999');
    $('#cep').mask('00000-000');

    $("#nao").change(function () {
        $("#vaga").hide();
    });
    $("#sim").change(function () {
        $("#vaga").show();

    });

    $("#cep").focusout(function(){
        //Início do Comando AJAX
        $.ajax({
            //O campo URL diz o caminho de onde virá os dados
            //É importante concatenar o valor digitado no CEP
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
            //Aqui você deve preencher o tipo de dados que será lido,
            //no caso, estamos lendo JSON.
            dataType: 'json',
            //SUCESS é referente a função que será executada caso
            //ele consiga ler a fonte de dados com sucesso.
            //O parâmetro dentro da função se refere ao nome da variável
            //que você vai dar para ler esse objeto.
            success: function(resposta){
                //Agora basta definir os valores que você deseja preencher
                //automaticamente nos campos acima.
                $("#cidade").val(resposta.localidade);
                $("#uf").val(resposta.uf);
                //Vamos incluir para que o Número seja focado automaticamente
                //melhorando a experiência do usuário
            }
        });
    });

    $("#cpf").focusout(function(){
        if($('#cpf').val() === ''){
            $('#cpf').focus();
        }
    });

    $('#msg').ready(function() {
        setTimeout(function () {
            $('#msg').fadeOut(6000); // "foo" é o id do elemento que seja manipular.
        }); // O valor é representado em milisegundos.
    });

    $('#imovel').ready(function(){
        //var i = $('#imovel').val();
        if($('#imovel').val() === null){
            $('#salvar').attr("disabled", true);
        }
    })

    $('#mudarStatus').click(function(){
        let id = $(this).attr('data-id');
        var valor = $(this).closest('tr').find('td[data-valor]').attr('data-valor');

        $('.modal-body #idConta').val(id);

        //let d = new Date();
        //dataHora = (d.toLocaleString());
        // alert(d.toLocaleString());

        // Mostrando data no campo
        //$('#dataPagamento').val(d);
        $('#valorRecebido').val(valor);

    })



});


