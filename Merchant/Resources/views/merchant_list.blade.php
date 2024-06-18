@extends('merchant::layouts.master')
@section('content')


<style type="text/css">
#alertError,#alertRemove,#alertGologdol,#alertMove{
    display:none;
}
.dt-buttons{
    margin-top:-40px;
}
.btn-secondary {
    color: #fff;
    background-color: #1761fd;
    border-color: #1761fd;
}
</style>
    

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Mерчант менежмент</a></li>
        <li class="breadcrumb-item active">Mерчант жагсаалт</li>
    </ol>

    <div class="alert alert-danger border-0" role="alert" id="alertRemove">
        <strong>Амжилттай</strong> устгалаа.
    </div>

<div class="container-fluid">
    @if(Session::has('message'))
        <div class="alert alert-success">
           {{Session::get('message')}}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger">
           {{Session::get('error')}}
        </div>
    @endif
    <div class="row">
        <div class="card" style="">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">                      
                        <h4 class="header blue bolder smaller" style="font-size:16px">Mерчант жагсаалт</h4>               
                    </div><!--end col-->  
                                                                                              
                </div>
            </div><!--end card-header-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2" >
                        <a type="button" name="addMerch" id="addMerch" class="btn btn-primary" onclick="getAddMerchModal(); return false;"
                            data-bs-toggle="modal" data-bs-target="#addMerchantModal" >Шинээр бүртгэх</a>
                        <button type="button" name="refresh" id="refresh" class="btn btn-info" onclick="$('#datatable').DataTable().ajax.reload();" > Refresh </button>
                    </div>
                    <div class="col-md-2" style="width: 13%;">
                        <div class="input-group">
                            <div class="input-group-text">Төлөв</div>
                            <select id='status' class="form-select" >
                                <option value="">Сонгох</option>
                                <option value="A">Идэвхтэй</option>
                                <option value="N">Идэвхгүй</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <div class="input-group-text">Посын төрөл</div>
                            <select id='device_type' class="form-select" >
                                <option value="">Сонгох</option>
                                <option value="LANDI">LANDI</option>
                                <option value="VX-680">VX-680</option>
                                <option value="MINU360">MINU360</option>
                                <option value="S300">S300</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <div class="input-group-text">Салбар</div>
                            <select class="form-select"  name="branch" id="branch" >
                                <option value="">Сонгох</option>
                                @foreach ($recordBranch as $item)
                                    <option value="{{$item->brch_code}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <div class="input-group-text">Хувь</div>
                            <select class="form-select"  name="discountPer" id="discountPer" >
                                <option value="">Сонгох</option>
                                @foreach ($recordDisPer as $item)
                                    <option value="{{$item->discount_percent}}">{{$item->discount_percent}} %</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                </div>
               
                <br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Mерчант ID</th>
                                <th>Нэр</th>
                                <th>Хөнгөлөлт</th>
                                <th>Түр данс</th>
                              
                                <th>Утасны дугаар</th>
                                <th>Салбар</th>
                                <th>Посын төрөл</th>
                                <th>Пос сериал</th>
                                <th>Сим дугаар</th>
                                <th>Төлөв</th>
                                <th>Үйлдэл</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table><!--end /table-->
                </div><!--end /tableresponsive-->
            </div><!--end card-body-->

            <div class="modal fade bd-example-modal-xl" id="addMerchantModal"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" style="width:101%;">
                        <div class="modal-header bg-dark">
                            <h6 class="modal-title m-0" id="docModalTitle">Мерчант бүртгэх</h6>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div>
                            <div class="d-flex justify-content-center" >
                                <div class="spinner-grow thumb-md text-purple" role="status" id="document_load_spinner" style="display: none"></div> 
                            </div>                    
                        </div>
                        <div id="addMerchant">

                        </div>
                    </div><!--end modal-content-->
                </div><!--end modal-dialog-->
            </div><!--end modal-->

            <div class="modal fade bd-example-modal-xl" id="editMerchantModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false" >
                <div class="modal-dialog modal-xl" role="document" style="width: 2000px;">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h6 class="modal-title m-0" id="editAcntModalTitle">Мерчант засах</h6>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div>
                            <div class="d-flex justify-content-center" >
                                <div class="spinner-grow thumb-md text-purple" role="status" id="document_load_spinner_edit" style="display: none"></div> 
                            </div>                    
                        </div>
                        <div id="editMerchant">

                        </div>
                    </div><!--end modal-content-->
                </div><!--end modal-dialog-->
            </div><!--end modal-->

            <div class="modal fade bd-example-modal-xl" id="detailMerchModal" tabindex="-1"  role="dialog"  data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h6 class="modal-title m-0" id="detailModalTitle">Мерчант дэлгэрэнгүй</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center" >
                                <div class="spinner-grow thumb-md text-purple" role="status" id="document_load_spinner_detail" style="display: none"></div> 
                            </div>                    
                        </div>
                        <div id="detailMerchant">

                        </div>
                    </div><!--end modal-content-->
                </div><!--end modal-dialog-->
            </div><!--end modal-->

        </div><!--end card-->
    </div>

@stop

@section('javascript')

@if(!empty(Session::get('error')))
<script>
$(function() {
    $('#myModal').modal('show');
});
</script>
@endif

<script type="text/javascript">

    $(document).ready(function () {

        load_data();

        function load_data(from_date = '', to_date = ''){
    
        var table = $('#datatable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            dom: 'fBrltip',
            buttons: [
            {
                extend: 'copy',
                text: 'Хуулах',
            }, {
                extend: 'excel',
                title: 'Мерчант жагсаалт',
            }, 
            {
                extend : 'pdfHtml5',
                title : function() {
                        return "Мерчант жагсаалт";
                    },
                    orientation : 'portrait',
                    pageSize : 'a2',
            },
            {
                extend: 'print',

                text: 'Хэвлэх',
                title:'Мерчант жагсаалт'
            }
        ],
    "oLanguage": {

            "sSearch": "Хайх:"

            },

        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('publicmerchantListTable') }}',
            data: function (d) {
                d.status = $('#status').val(),
                d.device_type = $('#device_type').val(),
                d.branch = $('#branch').val(),
                d.discountPer = $('#discountPer').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: "merchant_id" , name: 'merchant_id', width:'40px'},
            { 
                orderable: true, 
                searchable: true,
                render: function(data,type,row){
                        return ' <a  href ="#" onclick="getDetailMerchModal('+ row.merchant_id +')" id="detailMerchBtn"  data-bs-toggle="modal" data-bs-target="#detailMerchModal"  style="color:blue;" title="'+ row.merchant_addr +'">'+ row.merchant_name +'</a> ';
                }
            },
            { 
                orderable: true, 
                searchable: true,
                render: function(data,type,row){
                        return ' '+ row.discount_percent +' % ';
                }
            },
            { 
                orderable: true, 
                searchable: true,
                render: function(data,type,row){
                        return ' <a title="'+ row.temp_prod_name +'">'+ row.temp_acntno +'</a> ';
                }
            },
          
            { data: 'phone',name: 'phone'},
            { data: 'branch',name: 'branch'},
            { data: 'device_type',name: 'device_type'},
            { data: 'pos_serial',name: 'pos_serial'},
            { data: 'sim_number',name: 'sim_number'},
            { 
                orderable: true, 
                searchable: true,
                render: function(data,type,row){
                        return ' '+ row.status +' ';
                }
            },
            { 
                orderable: true, 
                searchable: true,
                render: function(data,type,row){
                        return '<a class="btn btn-primary btn-xs"  onclick="getEditMerchModal('+ row.merchant_id +')" id="editMerchBtn" data-bs-toggle="modal" data-bs-target="#editMerchantModal" data-backdrop="static" data-keyboard="false">Засах</a>                 <button class="btn btn-danger btn-xs"  onclick="deleteMerchant('+ row.merchant_id +')" id="deleteMerchBtn'+ row.merchant_id +'">Устгах</button> ';
                }
            },
        ],
        "bDestroy": true
        
    });
    $('#status').change(function(){
        table.draw();
    });
    $('#device_type').change(function(){
        table.draw();
    });
    $('#branch').change(function(){
        table.draw();
    });
    $('#discountPer').change(function(){
        table.draw();
    });
  }
  
});

function getAddMerchModal(){
    jQuery("#addMerchant").html("");
    jQuery("#docModalTitle").text("Мерчант бүртгэх");
    $("#document_load_spinner").show();
    $.post('/merchant/get/addMerchModal', {
        _token: '{{ csrf_token() }}'
        }, function (data) {
        $("#document_load_spinner").hide();
        jQuery("#addMerchant").html(data.data);
        }, 'json');
}
function getEditMerchModal(merch_id){
    jQuery("#editMerchant").html("");
    jQuery("#docModalTitle").text("Мерчант засах");
    $("#document_load_spinner_edit").show();
    $.post('/merchant/get/editMerchModal', {
        merch_id:merch_id,
        _token: '{{ csrf_token() }}'
        }, function (data) {
        $("#document_load_spinner_edit").hide();
        jQuery("#editMerchant").html(data.data);
        }, 'json');
}
function getDetailMerchModal(merch_id){

    jQuery("#detailMerchant").html("");
    jQuery("#docModalTitle").text("Мерчант дэлгэрэнгүй");
    $("#document_load_spinner_detail").show();
    $.post('/merchant/get/detailMerchModal', {
        merch_id:merch_id,
        _token: '{{ csrf_token() }}'
        }, function (data) {
        $("#document_load_spinner_detail").hide();
        jQuery("#detailMerchant").html(data.data);
        }, 'json');

}

function deleteMerchant(merch_id,merchant_name)
{
    if(confirm("Та "+merch_id+" мерчантын бүртгэлийг устгахдаа итгэлтэй байна уу?")){
        var btn = document.getElementById('deleteMerchBtn'+merch_id+'');
            btn.disabled = true;
            btn.innerText = 'Устгаж байна...'

        $.ajax({
          url: "/merchant/deleteMerch/post",
          method: "POST",
          data: {     
            merch_id: merch_id,
            _token: '{{ csrf_token() }}'
                },
          error: function(error) {
            
                    },
          success: function(data) { 

             $('#alertRemove').show() //or fadeIn
                setTimeout(function() {
                  $("#alertRemove").hide(); //or fadeOut
                }, 3000);

                $('#datatable').DataTable().ajax.reload();
            }
        });
    }
}

$(document).ready(function () {
    $('#addMerchantModal').modal({
           backdrop: 'static',
           keyboard: false
    })
});

$(document).ready(function () {
    $('#editMerchantModal').modal({
           backdrop: 'static',
           keyboard: false
    })
});

</script>

@stop
