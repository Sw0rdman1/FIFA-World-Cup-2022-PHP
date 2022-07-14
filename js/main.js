$("#dodaj").submit(function () {
  var $btn = $(document.activeElement);
  const $form = $(this);

  if ($btn.is('button[id="dodaj"]')) {
    event.preventDefault();
    const $inputs = $form.find("input, select, button, textarea");
    const serijalizacija = $form.serialize();

    request = $.ajax({
      url: "handler/add.php",
      type: "post",
      data: serijalizacija,
    });

    request.done(function (response, textStatus, jqXHR) {
      if (response === "Success") {
        alert("Fudbaler je dodat");
        location.reload(true);
      } else alert("Fudbaler nije dodat " + response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
      console.error("Sledeca greska se desila: " + textStatus, errorThrown);
    });
  }

  if ($btn.is('button[id="azuriraj"]')) {
    event.preventDefault();
    const $inputs = $form.find("input, select, button, textarea");
    const serijalizacija = $form.serialize();
    const red = $("input[name=checked-donut]:checked");
    console.log(serijalizacija);

    request = $.ajax({
      url: "handler/update.php",
      type: "post",
      data: serijalizacija,
    });
    request.done(function (response, textStatus, jqXHR) {
      if (response === "Success") {
        alert("Sportista je azuriran");
        location.reload(true);
      } else console.log("Sportista nije azuriran " + response);
    });
  }
});

$("#obrisi").click(function () {
  const red = $("input[name=checked-donut]:checked");
  request = $.ajax({
    url: "handler/delete.php",
    type: "post",
    data: { id: red.val() },
  });

  request.done(function (response, textStatus, jqXHR) {
    if (response === "Success") {
      red.closest("tr").remove();
      alert("Fudbaler je obrisan");
    } else alert("Fudbaler nije obrisan " + response);
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Sledeca greska se desila: " + textStatus, errorThrown);
  });
});
