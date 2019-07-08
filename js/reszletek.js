function reszletek(cid, cszam, cnev, ar, cinfo, ckep) {
  $('#cikkModal h4').html(cnev);
  $('#cikkModal .modal-body .kep').html('<img src="'+ckep+'" width="100%">');
  $('#cikkModal .modal-body .leiras').html('<p><b>Cikkszám: </b>'+cszam+'</p><p><b>Leírás: </b>'+cinfo+'</p>');
  $('#cikkModal .modal-body .ar h2').html(ar.toLocaleString()+' Ft');
  $('#gombKosarba').attr("onclick", "kosarba("+cid+")");
}
