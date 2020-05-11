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

function swalUpload() {
    swal({
      title: "Producto subido con exito",
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