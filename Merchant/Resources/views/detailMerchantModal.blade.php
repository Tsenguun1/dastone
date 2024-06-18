<div class="modal-body" id="modalAddDoc-body" >
	
	<div class="box box-primary">
		<div class="box-body">
			<div class="alert alert-warning alert-dismissible" id="addDocAlertBox" style="display:none"></div>
            <div class="row">
                <div class="col-lg-6" >
                    
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchId" >Мерчантын дугаар</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="merchId" name="merchId" value="{{$recordDetailMerch->merchant_id}}" disabled="disabled">
                        </div>
                    </div>
                   
    				<div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="branch" >Салбар</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="branch" name="branch" min="1000" value="{{$recordDetailMerch->branch}}" disabled="disabled">
                        </div>
                    </div>
                
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="custNo" >Харилцагчийн дугаар</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="custNo" name="custNo"  placeholder="" value="{{$recordDetailMerch->custno}} - {{$recordDetailMerch->cust_name}}"  disabled="disabled"> 
                        </div>
                    </div>
            
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="merchName" >Мерчант нэр</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="merchName" name="merchName" value="{{$recordDetailMerch->merchant_name}}" disabled="disabled">
                        </div>
                    </div>

                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="discountPer" >Хөнгөлөлтийн хувь:</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="discountPer" name="discountPer" value="{{$recordDetailMerch->discount_percent}}"  disabled="disabled" step='0.01'>
                        </div>
                    </div>
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="discountPer" >ПОС сериал дугаар:</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="posNumber" name="posNumber" value="{{$recordDetailMerch->pos_serial}}"  disabled="disabled" step='0.01'>
                        </div>
                    </div>
                    <div class="mb-3 row" >
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="phone" >Харилцагчийн утасны дугаар</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$recordDetailMerch->phone}}" disabled="disabled">
                            </div>
                        </div>
                        <div class="mb-3 row" >
                            <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="direction" >Үйл ажиллагааны чиглэл</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="direction" name="direction" value="{{$recordDetailMerch->direction}}" disabled="disabled">
                            </div>
                        </div>
                        
                </div>

                <div class="col-lg-6" >
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="device_type" >Пос төхөөрөмжийн төрөл:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="device_type" name="device_type" value="{{$recordDetailMerch->device_type}}" disabled="disabled">
                        </div>
                    </div>
                    <div class="mb-3 row" style="margin-right:0px;">
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="terminal">Терминал ID 360</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="terminal" name="terminal" value="{{$recordDetailMerch->merchant_id360}}" disabled="disabled">
                        </div>
                    </div>
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="discountPer" >Дата сим дугаар:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="simNumber" name="simNumber" value="{{$recordDetailMerch->sim_number}}"  disabled="disabled" step='0.01'>
                        </div>
                    </div>
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="posAcnt" >Пос-ын түр данс</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{$recordDetailMerch->temp_acntno}} - {{$recordDetailMerch->temp_prod_name}}" id="posAcnt" name="posAcnt" disabled="disabled">
                        </div>
                    </div>
             
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="caAcnt" >Харилцах данс</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{$recordDetailMerch->ca_acntno}} - {{$recordDetailMerch->ca_prod_name}}" id="caAcnt" name="caAcnt" disabled="disabled">
                        </div>
                    </div>
           
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="address" >Байршил</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{$recordDetailMerch->merchant_addr}}" class="form-control" id="address" name="address"  disabled="disabled">
                        </div>
                    </div>

                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="status" >Төлөв:</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{$recordDetailMerch->status}} - {{$recordDetailMerch->status_empname}} - {{$recordDetailMerch->status_date}}" class="form-control"  id="status" name="status" disabled="disabled">
                        </div>
                    </div>
                    <div class="mb-3 row" >
                        <label class="col-sm-3 form-label align-self-center mb-lg-0 text-end" for="updateDate" >Зассан огноо:</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{$recordDetailMerch->update_date}} - {{$recordDetailMerch->update_empname}}" class="form-control"  disabled="disabled" id="updateDate" name="updateDate" >
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Мерчант картын урамшуулал</h4>
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive-sm" style="width: 90%; margin-left:50px;">
                            <table class="table table-striped mb-0" id="personTable">
                                <thead>
                                    <tr>
                                        <th>Дугаар</th>
                                        <th>Картын бүтээгдэхүүн</th>
                                        <th style="width: 160px;">Урамшууллын хувь (%)</th>
                                        <th style="width: 80px;">Төлөв</th>
                                    </tr>
                                    
                                </thead>
                                <tbody id="invTableBody">
                                    @foreach ($recordMerchCards as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->bonus_percent}} %</td>
                                            <td >{{$item->status}}</td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            
                        </div>
                    </div><!--end card-body-->
                </div>
            </div>
            </div>
		</div>
	</div>
</div>

