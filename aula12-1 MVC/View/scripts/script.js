'use strict';
const campoCep = document.querySelector('#cep');
const encontrarcep = (cep = 0) => {
    if (document.getElementById("cep").value != "") {
        const url = `http://viacep.com.br/ws/${cep}/json/`;

        fetch(url).then(res => res.json()
            .then(data => {
                if (!("erro" in data)) {
                    preencherFomulario(data);
                } else {
                    alert(" CEP Invalido ");
                    limparFormulario();
                }
            }));
        document.getElementById('endereco').value = 'pesquisando cep...';
    } else {
        alert(" Digite um CEP");
    }
}
cep.addEventListener("blur", evento => encontrarcep(campoCep.value));
const preencherFomulario = (endereco) => {
        document.getElementById('endereco').value = endereco.logradouro;
        document.getElementById('bairro').value = endereco.bairro;
        // document.getElementById('cidade').value = endereco.localidade;
        document.getElementById('cep').value = endereco.cep;
    }
//    //funcao da mascara 
//    const maskCep = ($el) => {
//
//        let aux = $el.value;
//
//        aux = aux.replace(/[^0-9]/g, '');
//
//        aux = aux.replace(/(.{5})(.)/, '$1-$2');
//
//        $el.value = aux;
//    }
//
//
//    // mascara do campo cep
//    document.querySelector('#cep').addEventListener('keyup', (e) => maskCep(e.target));
//
//

