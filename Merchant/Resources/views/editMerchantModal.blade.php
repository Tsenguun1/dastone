<div class="modal-body" id="modalAddDoc-body" >
	<form action="/merchant/edit/post" method="post" name="editMerchFrm" id="editMerchFrm" enctype="multipart/form-data" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
		<div class="box box-primary">
			<div class="box-body">
				<div class="alert alert-warning alert-dismissible" id="addDocAlertBox" style="display:none"></div>
                
                @if(session()->has('message'))
                    <div class="alert alert-success" id="alertRemove">
                        {{ session()->get('message') }}
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-lg-5" >
                        
                            <div class="mb-3 row" style="margin-right:0px;">
                                <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchId">Мерчантын дугаар</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="merchId" name="merchId" min="1000" value="{{$recordSelectedMerch->merchant_id}}" required>
                                </div>
                            </div>
                       
                        
        				<div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="branch">Салбар</label>
                            <div class="col-sm-7">
                                <select class="select2 form-control mb-3 custom-select" name="branch" id="branch" >
        		                 
        		                    @foreach ($recordBranch as $item)
		                                <option value="{{$item->brch_code}}" <?php if ($item->brch_code==$recordSelectedMerch->branch_code) echo 'selected';?>>{{$item->name}}</option>
		                            @endforeach
        	                    </select>
                            </div>
                        </div>

                        <fieldset id="smsField" >
                            <div class="mb-3 row" style="margin-right:0px;">
                                <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="custNo">Харилцагчийн дугаар</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="custNo" name="custNo"  min="1000000000" max="9999999999" maxlength="8" placeholder="" value="{{$recordSelectedMerch->custno}}"  required onchange="getCustCaAcnt()"> 
                                    <!-- <input type="text" pattern="\d*" maxlength="8" id="is_smsTxt" name="is_smsTxt"  required> -->
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset id="" >
                            <div class="mb-3 row" style="margin-right:0px;">
                                <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="discountPer">Хөнгөлөлтийн хувь:</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="discountPer" name="discountPer"  max="100" value="{{$recordSelectedMerch->discount_percent}}"  step="any" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset id="" >
                            <div class="mb-3 row" style="margin-right:0px;">
                                <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchName">Мерчант нэр</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="merchName" name="merchName" min="1000" value="{{$recordSelectedMerch->merchant_name}}" required>
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="posNumber">ПОС сериал дугаар</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="posNumber" name="posNumber" min="1000" value="{{$recordSelectedMerch->pos_serial}}" >
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="simNumber">Дата сим дугаар</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="simNumber" name="simNumber" min="1000" value="{{$recordSelectedMerch->sim_number}}" >
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="posAcnt">Пос-ын түр данс</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value="{{$recordSelectedMerch->temp_acntno}}" id="posAcnt" name="posAcnt" min="1000" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7" >
                     
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="caAcntEdit">Харилцах данс</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control mb-3 custom-select" name="caAcntEdit" id="caAcntEdit" >
                                    @foreach ($recordsMerchCaAcnt as $item)
                                        <option value="{{$item->acnt_code}}" <?php if ($item->acnt_code==$recordSelectedMerch->ca_acntno) echo 'selected';?>>{{$item->acnt_code}} {{$item->prod_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="address">Байршил</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5" id="address" name="address" required>{{$recordSelectedMerch->merchant_addr}}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="status">Төлөв:</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control mb-3 custom-select" name="status" id="status" >
                                    <option value="A" <?php if ($recordSelectedMerch->status=='A') echo 'selected';?>>Идэвхитэй</option>
                                    <option value="N" <?php if ($recordSelectedMerch->status=='N') echo 'selected';?>>Идэвхигүй</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="phone">Харилцагчийн утасны дугаар</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$recordSelectedMerch->phone}}">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="direction">Үйл ажиллагааны чиглэл</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="direction" name="direction" value="{{$recordSelectedMerch->direction}}">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="device_type">Пос төхөөрөмжийн төрөл:</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control mb-3 custom-select" name="device_type" id="device_type" >
                                    <option value="LANDI" <?php if ($recordSelectedMerch->device_type=='LANDI') echo 'selected';?>>LANDI</option>
                                    <option value="VX-680" <?php if ($recordSelectedMerch->device_type=='VX-680') echo 'selected';?>>VX-680</option>
                                    <option value="MINU360" <?php if ($recordSelectedMerch->device_type=='MINU360') echo 'selected';?>>MINU360</option>
                                    <option value="S300" <?php if ($recordSelectedMerch->device_type=='S300') echo 'selected';?>>S300</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-right:0px;">
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="terminal">Терминал ID 360</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="terminal" name="terminal" value="{{$recordSelectedMerch->merchant_id360}}">
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
                                @if(isset($recordMerchCards)) 
                                    @foreach ($recordMerchCards as $card)
                                        <tr>
                                            <td>
                                                <select name="card_prod_code[]" id="card_prod_code" class="form-control" style=" background-color:#f1f5fa;opacity: 1;" >
                                                    <option value="{{$card->card_prod_code}}" >{{$card->name}}</option>
                                                    @foreach ($recordCardProd as $item)
                                                        <option value="{{$item->card_prod_code}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="bonus_percent[]" id="bonus_percent" class="form-control " style="background-color:#f1f5fa;opacity: 1;" >
                                                    <option value="">Сонгох</option>
                                                    <option value="3" <?php if($card->bonus_percent=='3'){ echo " selected";} ?> >3%</option>
                                                    <option value="5" <?php if($card->bonus_percent=='5'){ echo " selected";} ?> >5%</option>
                                                    <option value="10" <?php if($card->bonus_percent=='10'){ echo " selected";} ?> >10%</option>
                                                    <option value="15" <?php if($card->bonus_percent=='15'){ echo " selected";} ?> >15%</option>
                                                </select>
                                            </td>
                                            <td style="padding-top: 0;">
                                                <button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" onclick="deletePersonRow();"  id="removeBtn" >Устгах</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-xs" id="p_add"  onclick="">Нэмэх</button>
                    </div>
                </div>
			</div>
		</div>
		<div class="modal-footer">                                                    
            <button type="submit" class="btn btn-soft-dark btn-sm" id="saveBtnEdit" >Хадгалах</button>
            <button type="button" class="btn btn-soft-dark btn-sm" data-bs-dismiss="modal" onclick="refresh();">Хаах</button>
        </div>
	</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $("#editMerchFrm").submit(function () {
        $("#saveBtnEdit").attr("disabled", true);
        $('#saveBtnEdit').text('Хадгалж байна...');
        return true;
    });
});

function getCustCaAcnt(){
    custNo = document.getElementById('custNo').value;
    //alert(custNo);

    $("#caAcntEdit").empty().trigger('change');

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
        $('#caAcntEdit').append(selOpts);
     } 

    }); 
}

$(document).ready(function() {
  $("#caAcntEdit").select2({
    dropdownParent: $("#editMerchantModal")
  });
});

// $(document).ready(function() {
//   $("#card_prod_code").select2({
//     dropdownParent: $("#editMerchantModal")
//   });
// });

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
    
        //$("#card_prod_code").select2("destroy");
        $('#personTable').append(output);

        //$("#personTable tr:last").find("#card_prod_code").select2();
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
    parent.window.location.reload(true);
}
</script>
