<div class="modal-body" id="modalAddDoc-body" >
	<form action="/merchant/register/post" method="post" name="registerMerchFrm" id="registerMerchFrm" enctype="multipart/form-data" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
		<div class="box box-primary">
			<div class="box-body">
				<div class="alert alert-warning alert-dismissible" id="addDocAlertBox" style="display:none"></div>
                
                <div class="row">
                    <div class="col-lg-6" >
                        
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchId">Мерчантын дугаар</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="merchId" name="merchId" min="10000000" max="99999999" required  onchange="checkMerID()">
                            </div>
                        </div>

        				<div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="branch">Салбар</label>
                            <div class="col-sm-7">
                                <select class="select2 form-control mb-3 custom-select" name="branch" id="branch" >
                                    
                                    @foreach ($recordBranch as $item)
                                        <option value="{{$item->brch_code}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="custNo">Харилцагчийн дугаар</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="custNo" name="custNo"  min="1000000000" max="9999999999" maxlength="8" placeholder=""  required onchange="getCustCaAcnt()"> 
                            </div>
                        </div>
                       
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="discountPer">Хөнгөлөлтийн хувь:</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="discountPer" name="discountPer" min="0" max="100" step="any" required>
                            </div>
                        </div>
           
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchName">Мерчант нэр</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="merchName" name="merchName" required>
                            </div>
                        </div>
           
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchName">Дата сим дугаар</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="simNumber" name="simNumber" >
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchName">ПОС сериал дугаар</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="posNumber" name="posNumber" >
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchName">Терминал ID 360</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="terminal" name="terminal" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" >
     
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="posAcnt">Пос-ын түр данс</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="posAcnt" name="posAcnt" maxlength="20" size="20" required>
                            </div>
                        </div>
          
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="caAcnt">Харилцах данс</label>
                            <div class="col-sm-7">
                                <select name="caAcnt" id="caAcnt" class="select2 form-control mb-3 custom-select" required  >
                                </select>
                            </div>
                        </div>
                       
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="address">Байршил</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" rows="4" id="address" name="address" required></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="status">Төлөв:</label>
                            <div class="col-sm-7">
                                <select class="select2 form-control mb-3 custom-select" name="status" id="status" >
                                    <option value="A">Идэвхитэй</option>
                                    <option value="N">Идэвхигүй</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-4 form-label align-self-center mb-lg-0 text-end" for="phone">Харилцагчийн утасны дугаар</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="phone" name="phone" >
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-4 form-label align-self-center mb-lg-0 text-end" for="direction">Үйл ажиллагааны чиглэл</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="direction" name="direction" >
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-4 form-label align-self-center mb-lg-0 text-end" for="device_type">Пос төхөөрөмжийн төрөл:</label>
                            <div class="col-sm-7">
                                <select class="select2 form-control mb-3 custom-select" name="device_type" id="device_type" >
                                    <option value="LANDI">LANDI</option>
                                    <option value="VX-680">VX-680</option>
                                    <option value="MINU360">MINU360</option>
                                    <option value="S300">S300</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive" style="width: 90%; margin-left:50px;">
                        <table class="table table-bordered table-sm" id="personTable">
                            <thead>
                                <tr>
                                    <th>Картын бүтээгдэхүүн</th>
                                    <th style="width: 160px;">Урамшууллын хувь (%)</th>
                                    <th style="width: 80px;">Үйлдэл</th>
                                </tr>
                                
                            </thead>
                            <tbody id="invTableBody">
                                <tr>
                                    <td>
                                        <select name="card_prod_code[]" id="card_prod_code" class="form-control" style=" background-color:#f1f5fa;opacity: 1;" >
                                            <option value="">Сонгох</option>
                                            @foreach ($recordCardProd as $item)
                                                <option value="{{$item->card_prod_code}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="bonus_percent[]" id="bonus_percent" class="form-control " style="background-color:#f1f5fa;opacity: 1;" >
                                            <option value="">Сонгох</option>
                                            <option value="3">3%</option>
                                            <option value="5">5%</option>
                                            <option value="10">10%</option>
                                            <option value="15">15%</option>
                                        </select>
                                    </td>
                                    <td style="padding-top: 0;">
                                        <button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" onclick="deletePersonRow();"  id="removeBtn" >Устгах</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-xs" id="p_add"  onclick="">Нэмэх</button>
                    </div>
                      
                </div>
			</div>
		</div>
		<div class="modal-footer">                                                    
            <button type="submit" class="btn btn-soft-dark btn-sm" id="saveBtn" disabled="true" name="saveBtn">Хадгалах</button>
            <button type="button" class="btn btn-soft-dark btn-sm" data-bs-dismiss="modal" onclick="refresh();">Хаах</button>
        </div>
	</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

function checkMerID(){
 	merchId = document.getElementById('merchId').value;
 	//alert(depId);

 	$.ajax({
      url: "/merchant/check/merchID",
      dataType: 'json',
      type: "POST",
      data: {     
         merchId: merchId,
        _token: '{{ csrf_token() }}'
      },
      error: function(error) {
     
      },
      success: function(data) { 
      	console.log(data.cnt);
      	if(data.cnt>0){
      		document.getElementById( 'addDocAlertBox' ).style.display = 'block';
      		document.getElementById("addDocAlertBox").innerHTML = 'Мерчантын дугаар давхардаж байна.';
      		document.getElementById("saveBtn").disabled=true;
      	}
      	else{
      		//$('input[name="saveBtn"]').prop('disabled',false);
      		document.getElementById("saveBtn").disabled=false;
      		document.getElementById( 'addDocAlertBox' ).style.display = 'none';
      	}
     } 

    }); 
}

function getCustCaAcnt(){
    custNo = document.getElementById('custNo').value;
    //alert(custNo);
    $("#caAcnt").empty().trigger('change');

    $.ajax({
      url: "/merchant/get/custCaAcnt",
      dataType: 'json',
      type: "POST",
      data: {     
         custNo: custNo,
        _token: '{{ csrf_token() }}'
      },
      error: function(error) {
     
      },
      success: function(data) { 
        var selOpts = "<option value='' class=' '>Сонгох</option>";

        $.each(data, function(k, v=1)
        {
            console.log(data[k].prod_name);
            selOpts += '<option value='+data[k].acnt_code+' >'+data[k].acnt_code+' - '+data[k].prod_name+' ('+data[k].status_name+')</option>';
        });
        $('#caAcnt').append(selOpts);
     } 

    }); 
}

$(document).ready(function () {
    $("#registerMerchFrm").submit(function () {
        $("#saveBtn").attr("disabled", true);
        $('#saveBtn').text('Хадгалж байна...');
        return true;
    });
});

// $(document).ready(function() {
//   $("#card_prod_code").select2({
//     dropdownParent: $("#addMerchantModal")
//   });
// });

$(document).ready(function() {
  $("#caAcnt").select2({
    dropdownParent: $("#addMerchantModal")
  });
});

$(document).ready(function(){
    var count = 0;
    
    $(document).on('click', '#p_add', function(){
        count = count + 1;
        output = '<tr id="row_'+count+'">';
     
        //output += '<td ></td>';
        output += '<td><select name="card_prod_code[]" id="card_prod_code" class="form-control" style="background-color:#f1f5fa;opacity: 1;" required><option value="">Сонгох</option>@foreach ($recordCardProd as $item)<option value="{{$item->card_prod_code}}">{{$item->name}}</option>@endforeach</select></td>';
        output += '<td><select name="bonus_percent[]" id="bonus_percent" class="form-control " style="background-color:#f1f5fa;opacity: 1;" required><option value="">Сонгох</option><option value="3">3%</option><option value="5">5%</option><option value="10">10%</option><option value="15">15%</option></select></td>';
        output += '<td><button type="button" onclick="deletePersonRow();"  class="btn btn-danger btn-xs remove_details" id="'+count+'">Устгах</button></td>';
        output += '</tr>';
       
        //$("#card_prod_code").select2("destroy");
    
        // $("#card_prod_code").select2("destroy");
        $('#personTable').append(output);

        // $("#personTable tr:last").find("#card_prod_code").select2();
        // $("#card_prod_code").select2({
        //     dropdownParent: $("#addMerchantModal")
        // });
        // $('.select2').each(function() { 
        //     $(this).select2({ dropdownParent: $(this).parent()});
        // })
    });
    
});
function deletePersonRow(){
  var table = document.getElementById('personTable');
  var rowCount = table.rows.length;
  if(rowCount > '1'){
    var row = table.deleteRow(rowCount-1);
    rowCount--;
  }
  else{
    alert('Эхний мөрийг устгахгүй...');
  }
}

function refresh(){
    $("#addMerchantModal").on("hidden.bs.modal", function () {
            location.reload();
        });
}
</script>
