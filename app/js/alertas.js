function swalBuy(accepted) {
  if(accepted){
    swal({
      title: "Has comprado el producto",
      icon: "success",
      timer: 5000,
    })
  }else{
    swal({
      title: "Fallo al comprar el producto",
      icon: "error",
      timer: 5000,
    })
  }
}
function swalReserva(accepted) {
  if(accepted){
    swal({
      title: "Has reservado el producto",
      icon: "success",
      timer: 5000,
    })
  }else{
    swal({
      title: "Fallo al reservar el producto",
      icon: "error",
      timer: 5000,
    })
  }
}

function swalUpload() {
    swal({
      title: "Producto subido con éxito",
      icon: "success",
      timer: 3000,
    })
}

function confirmAction(msg) {
  if(!confirm(msg)){
    return false;
  }else{
    return true;
  }
}