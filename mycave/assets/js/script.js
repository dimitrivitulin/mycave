const effacerVins = document.querySelectorAll(".effacer-vin");
for (const effacerVin of effacerVins) {
  effacerVin.addEventListener("click", function () {
    console.log(effacerVin);
  });
}
