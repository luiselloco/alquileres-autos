function Precio() {
    let totalpago = 0.00;

    let cantCarros = document.getElementById('cantcarros').value;
    let precio = document.getElementById('price').value;

    totalpago = parseFloat(cantCarros * precio).toFixed(2);

    document.getElementById('Tpago').innerHTML = "$" + totalpago;
}
