@extends('layouts.template')
@section('title','Penjualan')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Penjualan</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <!-- <li class="breadcrumb-item">
                        <a href="#">Pelanggan</a>
                    </li> -->
                    <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <form method="post" action="{{ url('/pos/store') }}">
                @csrf
              
              @if($id_penjualan==null)
               @php $x=1; @endphp
              @else
              @php $x=$id_penjualan+1; @endphp
              @endif 
              <div class="coba mb-2">
              
                <label for="date" ><font size="4"><strong>Nota #{{$x}}</strong></font></label>
                <input type="hidden" name="nota_id" value="{{$x}}">
                </div>


            <!-- <div class="form-row mt-3">
            <div class="form-group col-12"> -->
            <!-- <label for="customer_id"><font size="4">Pelanggan</font></label> -->
                <!-- <select name="kategori" id="select2" >
                        <option disabled="true" selected="true" required>Nama Pelanggan </option>
                        @foreach($pelanggan as $p)
                        <option value="{{ $p->ID_PELANGGAN }}" required>{{ $p->NAMA_PELANGGAN }}</option>
                        @endforeach
                </select>
            </div>    -->

            <!-- <div class="form-group col-md-6">
            <label for="customer_id"><font size="4">Kategori</font></label>    
                <select name="kategori" id="kategori" class="select2-example">
                        <option disabled="true" selected="true" required>Kategori Pelanggan *</option>
                        @foreach($kategori_pelanggan as $kp)
                        <option value="{{ $kp->ID_KATEGORI_PELANGGAN }}" required>{{ $kp->NAMA_KATEGORI_PELANGGAN }}</option>
                        @endforeach
                </select>
            </div> -->
            <!-- </div>  -->

            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#tambahModal">
            <i class="fa fa-plus-circle mr-2"></i>Penjualan</button>

            <!-- .modal-lg -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="tambahModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Penjualan</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered mydatatable" id="tabelproduk">
                      <thead>
                        <tr>
                          <th width=1px scope="col">#</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Stok</th>
                          <th scope="col">Deskripsi</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($product as $pr)
                        <tr id="row{{$pr -> ID_PRODUK}}" style="cursor:pointer;">
                          <th scope="row">
                          <!-- <input type="checkbox" id="pr{{$pr->ID_PRODUK }}" > -->
                         
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="pr{{$pr->ID_PRODUK }}">
                                <label class="custom-control-label" for="pr{{$pr->ID_PRODUK }}"></label>
                            </div>
                       
                          </th>
                          @foreach($kategori_produk as $kp)
                          @if($pr->ID_KATEGORI_PRODUK==$kp->ID_KATEGORI_PRODUK)
                          <td>
                          {{$kp->NAMA_KATEGORI_PRODUK}}
                          </td>
                          @endif
                          @endforeach
                        
                          <td>{{ $pr->NAMA_PRODUK}}</td>
                          <td>Rp. {{number_format($pr->HARGA_JUAL_PELANGGAN_PRODUK)}}</td>
                          <td>{{ $pr->STOK_PRODUK}}</td>
                          <td>{{ $pr->DESKRIPSI_PRODUK}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary" id="save">Insert</button>
                </div>
                </div>
            </div>
            </div>
            <div class="table-responsive" id="tabel_cart">
            <!-- <center>
               <h5 style="color:#e3bcba">Anda Belum menambahkan produk</h5>
            </center> -->
            </div>
                          <input type="hidden" id="subtotal">
                          <p style="">Total : Rp. <span id="subtotal-val"></span></p>
                            
            </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

<script>
$(document).ready(function (){
    $('.mydatatable').DataTable();
    $('.select2-example').select2();
    $('#select2').select2();
});
</script>
<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>



<script>
 
var angka=0;
jQuery( function( $ ) {
    $("#save").click(function(){
      if(angka==0){
        var tambah_tabel= '\<table class="table table-bordered table-hover" id="cart"></font>\
                                  <thead>\
                                  <tr>\
                                  <th style="font-weight:bold;">Nama Produk</th>\
                                    <th style="font-weight:bold;">Jumlah</th>\
                                    <th style="font-weight:bold;">Harga</th>\
                                    <th style="font-weight:bold;">Total Harga</th>\
                                    <th style="font-weight:bold;">Aksi</th>\
                                  </tr>\
                                </thead>\
                                    <tbody>\
                                    </tbody>\
                                </table>';
                                $("#gambar").hide(); 
                                $("#tabel_cart").append(tambah_tabel); 
        angka=1;
      }
          var checks = $("#tambahModal").find("input[type=checkbox]:checked");
          var ids = Array();
          for(var i=0;i<checks.length;i++) {
              ids[i] = checks[i].id; 
              $("#"+ids[i]).prop("checked", false);
              ids[i] = ids[i].substring(2,10); //PR001
              console.log(ids[i]);
              if( $("#cart tbody tr#"+ids[i]).length){
                console.log('masuk ifff');
                  $('#jumlah'+ids[i]).val(parseInt($('#jumlah'+ids[i]).val())+1);  
                  recount(ids[i]);
              }
              else{   
                addRow(ids[i]);
              }
              // $("#tabelproduk tbody tr#row"+ids[i]).hide();
          }
        });

        // function agar di klik row mana saja bsa ke ceklis
        $('#tabelproduk tr').click(function() {
            var check = $(this).find("input[type=checkbox]");
            if (check.prop("checked") == true) {
              check.prop("checked", false);
            }
            else{
              check.prop("checked", true);
            }
        });
});

var products = <?php echo json_encode($product); ?>;
// console.log(products);
function getIndex(id){
	for(var i = 0;i<products.length;i++){
	  if(products[i]["ID_PRODUK"] == id){
	      var index = i;
        console.log('function getIndex');
        console.log(index);
	      return index;
	  }
	}
}

function addRow(id){
      var index = getIndex(id);
      var id = products[index]["ID_PRODUK"];
      var name = products[index]["NAMA_PRODUK"];
      var price = products[index]["HARGA_JUAL_PELANGGAN_PRODUK"];
      var stock = products[index]["STOK_PRODUK"];
      var mprice = money(price);
      var markup = "\
      <tr id='"+id+"' style='border: 1px;'>\
	  \
	  <td style='text-align: left; padding-left: 40px;' class='align-middle'>\
	    <div class='row'>\
	      <h6 class='NAMA_PRODUK'>"+name+"</div>\
	    <div class='row'>\
	      <input type='hidden' name='ID_PRODUK["+id+"]' value="+id+" readonly id='ID_PRODUK"+id+"'></div>\
	  </td>\
	  \
	  <td style='width: 15%;' class='align-middle'>\
	    <div class='row justify-content-center'>\
      <button class='dec btn btn-sm btn-dark' type='button' onclick='dec(\""+id+"\")'>-</button>\
	    	<input type='number' style='background-color:#808080; -moz-appearance: textfield; width: 30%; border:1px;text-align: center;' class='quantity' oninput='recount(\""+id+"\")' name='jumlah["+id+"]' min='1' id='jumlah"+id+"'required max='"+stock+"' value='1'>\
        <button class='inc btn btn-sm btn-dark' type='button' onclick='inc(\""+id+"\")'>+</button>\
	    </div>\
	  </td>\
	  \
	  <td style='text-align: right; width:20%;' class='align-middle'>\
	    <div class='row justify-content-center'>\
	      <input type='hidden'  class='selling_price' name='selling_price["+id+"]' id='price"+id+"' value='"+price+"'>\
	       Rp. "+"  "+mprice+"\
	  </div>\
    </td>\
	  \
	  <td class='align-middle' style='width: 25%;'>\
		  <div class='row align-middle justify-content-end'>\
		  	<input type='hidden' class='total' name='total["+id+"]' min='1' id='total"+id+"' required>\
		  	<div class='col-4 pl-4'>\
		  		<h6 style='text-align: left;'>Rp.  </h6>\
		  	</div>\
		  	<div class='col-8' >\
	      		<h6 style='text-align: right; padding-right: 18px;' id='total-val"+id+"'></h6>\
	      	</div>\
		  </div>\
	  </td>\
	  \
	  <td style='width: 5%;' class='align-middle'>\
	  	<i class='btn btn-outline-danger' onclick='delRow(\""+id+"\")' style='cursor: pointer; '>x</i>\
	  </td>\
	</tr>\
	";
	$("#cart tbody").append(markup);
	recount(id);
}

function money(text){
	var text = text.toString();
  // console.log(text);
	var panjang = text.length; //4
	var hasil = new Array();
	if (panjang>0){
		if(panjang>3){
			var div = parseInt(panjang/3); //1
			var char = new Array();
			var result="";
			if (div > 1 && panjang > 6) {
				var x = parseInt(panjang - (div*3));
				div++;
				for (var i=0; i<div; i++) {
					if (i == 0) {
						char[i] = text.slice(i,x);
					}
					else{
						char[i] = text.slice(((i-1)*3)+x,(i*3)+x);
					}
					if (i == (div-1)) {					
						hasil[i]= char[i];
					}
					else{
						hasil[i]= char[i]+".";
					}
				}
				for (var i=0; i<div; i++) {
					result+=hasil[i];
				}
			}
			else{
				result = text.slice(0,panjang-3)+"."+text.slice(panjang-3,panjang);
			//  console.log( text.slice(0,panjang-3));
      //  console.log(text.slice(panjang-3,panjang));
      }
			return result;
		}
    else if(panjang>0){
        return text;
    }
		return 0;
	}
}

function recount(id) {
      console.log("function recount");
      var jumlah = document.getElementById("jumlah"+id).value;
      var price = document.getElementById("price"+id).value;
      var subtotal = (jumlah*price);
    //   document.getElementById("discount"+id).setAttribute("max", subtotal);
      document.getElementById("total"+id).value = subtotal;
      percentDisc(id);
    };

    function delRow(id){
          $('#cart tbody tr#'+id).remove();
          getTotal();
          $("#tabelproduk tbody tr#row"+id).show();
    }

    function percentDisc(id){
      console.log("function percentDisc");
    //   var percent = document.getElementById("percent"+id).value;
    //   if(percent>100 || percent<0){
    //     console.log('masukkk if percent');
    //     var percent = document.getElementById("percent"+id).value=0;
    //   }
      var total = document.getElementById("total"+id).value;
    //   var hasil = (Number(percent)/100) * total;
    //   document.getElementById("discount"+id).value = hasil;
      document.getElementById("total"+id).value = total;
      document.getElementById("total-val"+id).innerHTML = money(total);
      getTotal();
    };

    function getTotal(){
      console.log("function getTotal");
      var totals = document.getElementsByClassName("total");
      var i;
      var total_p = 0;
      for (i = 0; i < totals.length; ++i) {
        total_p = total_p + Number(totals[i].value);
      }
      document.getElementById('subtotal').value = total_p ;
      document.getElementById('subtotal-val').innerHTML = money(total_p);
    //   var discounts = document.getElementsByClassName("discount");
    //   var i;
    //   var total_disc = 0;
    //   for (i = 0; i < discounts.length; ++i){
    //     total_disc = total_disc + Number(discounts[i].value);
    //   }
    //  console.log(total_p);
    //   var l=document.getElementById('total_tax').value=(Number(total_p*0.1));
      // console.log(l);
    //   document.getElementById('total_tax-val').innerHTML=money(l);
      // console.log(money(l));
    //   document.getElementById('total_discount').value = total_disc;
    //   document.getElementById('total_discount-val').innerHTML = money(total_disc);
    //   let k = (Number(total_p))-total_disc;
    //   if(k<=0){
    //     console.log('masuk if k<=0');
    //     document.getElementById('total_payment').value = 0;
    //     document.getElementById('total_payment-val').innerHTML = '0';
    //   }
    //   else{
    //     console.log('masuk if k!=0');
    //     document.getElementById('total_payment').value = (total_p+(Number(total_p*0.1)))-total_disc;
    //     document.getElementById('total_payment-val').innerHTML = money((total_p+(Number(total_p*0.1)))-total_disc);
    //   }
     
    // document.getElementById('total_payment').value = total_p;
    // document.getElementById('total_payment-val').innerHTML =total_p;
    };

    function inc(id){
          var oldValue = $("#jumlah"+id).val();//jumlahPR004
          console.log('Nilai Old Value : ');
          console.log(oldValue);
          var newVal = parseFloat(oldValue)+1;
          console.log('Nilai newVal : ');
          console.log(newVal);
          var maximal = $("#jumlah"+id).attr('max');
          if(!(newVal > maximal)){
            $("#jumlah"+id).val(newVal);
            recount(id);
            console.log("massssuk");
          }
    }
        function dec(id){
          var oldValue = $("#jumlah"+id).val();
          if (parseFloat(oldValue) > 1) {
              var newVal = parseFloat(oldValue)-1;
              $("#jumlah"+id).val(newVal);
          }
          recount(id);
        }
</script>



@endsection