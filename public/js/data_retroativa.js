
var input = document.getElementById('ultimoDiaTrab');
input.addEventListener('change', function () {
    var agora = new Date();
    var escolhida = new Date(this.value);
    if (escolhida < agora) this.value = [agora.getFullYear(), agora.getMonth() + 1, agora.getDate()].map(v => v < 10 ? '0' + v : v).join('-');
});

var input = document.getElementById('ultimoDia');
input.addEventListener('change', function () {
    var agora = new Date();
    var escolhida = new Date(this.value);
    if (escolhida < agora) this.value = [agora.getFullYear(), agora.getMonth() + 1, agora.getDate()].map(v => v < 10 ? '0' + v : v).join('-');
});