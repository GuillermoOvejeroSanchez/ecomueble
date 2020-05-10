function swalBuy(accepted) {
  if(accepted){
    swal({
      title: "Has comprado tu producto",
      icon: "success",
      timer: 5000,
    })
  }else{
    swal({
      title: "Fallo al comprar tu producto",
      icon: "error",
      timer: 5000,
    })
  }
}


function confirmAction(msg) {
  if(!confirm(msg)){
    return false;
  }else{
    return true;
  }
}