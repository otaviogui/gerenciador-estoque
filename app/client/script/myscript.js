  
$(document).ready(function(){
    $.ajax({
        type:"GET",
        url:"http://localhost/gerenciador/cliente/juridica/dados",
        dataType:"json",
        success:function(res){
            for(var i=0; res.length>i; i++){
                $('#valoresTr').append('<tr><th scope="row">'+res[i].id+'</th><td>'
                +res[i].nome+'</td><td>'+res[i].razaoSocial+
                '</td><td>'+res[i].telefone1+'</td><td>'+res[i].email+
                '</td><td>'+res[i].facebook+
                '</td>'+`<td ><a href="" id="modal-view"><i class="fas fa-eye" title="Visualizar"></i></a></td>
                        <td ><a href="" id="modal-edit"><i class="fas fa-edit" title="Editar"></i></a></td>
                        <td ><a href=""  id="modal-tash"><i class="fas fa-trash" title="Excluir"></i></a></td>`);
            }
        }
    });
    
   $.ajax({
        type:"GET",
        url:"http://localhost/gerenciador/cliente/fisica/dados",
        dataType:"json",
        success:function(res){
            for(var i=0; res.length>i; i++){
                $('#valoresTrFisica').append('<tr><th scope="row">'+res[i].id+'</th><td>'
                +res[i].nome+'</td><td>'+res[i].cpf+
                '</td><td>'+res[i].telefone1+'</td><td>'+res[i].whatsApp+
                '</td><td>'+res[i].email+
                '</td>'+`<td ><a href="" id="modal-view"><i class="fas fa-eye" title="Visualizar"></i></a></td>
                        <td ><a href="" id="modal-edit"><i class="fas fa-edit" title="Editar"></i></a></td>
                        <td ><a href=""  id="modal-tash"><i class="fas fa-trash" title="Excluir"></i></a></td>`);
            }
        }
    });

    $('#formulariofisica').submit(function(e){
        e.preventDefault();
        let formulario = $(this);
        var retorno = inserir(formulario);
    });
    function inserir(dados){
        $.ajax({
            type:"POST",
            data:dados.serialize(),
            url:"http://localhost/gerenciador/cliente/fisica"
        }).then(sucesso , falha);

        function sucesso(data){
            console.log('sucesso');
        }
        function falha(){
            console.log('falha');
        }
    }
});
  

let btn_view = document.getElementById('myBtn_view');
btn_view.onclick = function(){
    modal.style.display="block";
}
window.onclick = function(e){
    if(e.target== modal_view){
        modal.style.display= "none";
    }
}
 /*modal*/

    
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
