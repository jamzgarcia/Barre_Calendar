console.log("Entramos a class tapetes")

  //   let tapete1 = document.getElementById("tapete1");
  //   tapete1.addEventListener("click",function() {
  //   alert("cambiar imagen");
  //   tapete1.src="https://barremx.online/imgBarre/Tapetes-Reservado.jpg"
    
  // });

  // let tapete2 = document.getElementById("tapete2");
  // tapete2.addEventListener("click",function() {
  //   alert("cambiar imagen");
  //   tapete2.src="https://barremx.online/imgBarre/Tapetes-Reservado.jpg"
    
  // });



  const tapetes = document.querySelectorAll('.tapetesMX');

  tapetes.forEach(function (item) {
    item.addEventListener('click', function () {
         alert("cambiar imagen");
         item.src="https://barremx.online/imgBarre/Tapetes-Reservado.jpg"

      
    })
  })

  console.log(tapetes);