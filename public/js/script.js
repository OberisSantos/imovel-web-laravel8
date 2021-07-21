
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
