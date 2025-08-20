(function() {
  document.addEventListener('DOMContentLoaded', function () {
  const palabras = ["INDUSTRIA", "AUTOMATIZACIÓN", "DIGITALIZACIÓN Y DATOS", "in.NEXT"];
  const textoExtra = "LA PRÓXIMA REVOLUCIÓN INDUSTRIAL";
  const escribiendo = document.querySelector('.escribiendo');
  const textoAdicional = document.querySelector('.texto-adicional');

  let i = 0;
  let j = 0;
  let borrando = false;
  let pausaFinal = false;

  function animarTexto() {
    escribiendo.textContent = palabras[i].substring(0, j);

    // Mostrar texto adicional solo al final de la última palabra
    if (i === palabras.length - 1 && !borrando && j === palabras[i].length) {
      textoAdicional.textContent = textoExtra;
      textoAdicional.style.opacity = 1;

      if (!pausaFinal) {
        pausaFinal = true;
        setTimeout(animarTexto, 3000); // Pausa de 3 segundos
        return;
      }
    } else {
      textoAdicional.style.opacity = 0;
    }

    if (!borrando && j < palabras[i].length) {
      j++;
      setTimeout(animarTexto, 100);
    } else if (borrando && j > 0) {
      j--;
      setTimeout(animarTexto, 80);
    } else {
      borrando = !borrando;

      if (!borrando) {
        i = (i + 1) % palabras.length;
      }

      pausaFinal = false; // Reiniciar bandera
      setTimeout(animarTexto, 1000);
    }
  }

  animarTexto();
});
})();
