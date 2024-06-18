<?php

namespace Modules\Merchant\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\CheckPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use App\File;
use Mail;
use Illuminate\Http\UploadedFile;
use DataTables;

class MerchantController extends CheckPermission
{
    public function showMerchantList()
    {
        $queryBranch = "
            select G.BRCH_CODE, G.NAME  from ".$this->dbSchema.".GEN_BRANCH g where G.STATUS='1' order by G.BRCH_CODE
            ";
        $recordBranch = DB::select($queryBranch);

        $queryDiscountPer = "
                        select rtrim(to_char(m.DISCOUNT_PERCENT,'fm90.99'),'.') DISCOUNT_PERCENT
                        from eoffice.MERCH_MERCHANT m 
                        where m.status!='D'
                        group by m.DISCOUNT_PERCENT
                        order by m.DISCOUNT_PERCENT asc
            ";
        $recordDisPer = DB::select($queryDiscountPer);

       return view('merchant::merchant_list')
                ->with("recordBranch", $recordBranch)
                ->with("recordDisPer", $recordDisPer);
    }

    public function merchantListTable(Request $req)
    {
        $status = $req->status;
        $device_type = $req->device_type;
        $branch = $req->branch;
        $discountPer = $req->discountPer;

        if(!$req->ajax()){
            $merchantListQuery = "
                    select M.MERCHANT_ID, 
                        M.CUSTNO, 
                        C.NAME CUST_NAME,
                        M.TEMP_ACNTNO, 
                        P.NAME TEMP_PROD_NAME,
                        M.CA_ACNTNO, 
                        P1.NAME CA_PROD_NAME,
                        M.MERCHANT_NAME, 
                        M.MERCHANT_ADDR, 
                        M.BRANCH_CODE||' - '||B.NAME BRANCH, 
                        decode(M.STATUS,
                        'A', 'Идэвхтэй',
                        'N', 'Идэвхгүй'
                        )  as status,m.status as status_code,
                        to_char(M.STATUS_DATE,'YYYY/MM/DD HH24:MI:SS') STATUS_DATE, 
                        M.STATUS_EMPID, 
                        E.FIRSTNAME||'.'||SUBSTR(E.LASTNAME,0,1) STATUS_EMPNAME,
                        to_char(NVL(M.UPDATE_DATE,M.INSERT_DATE ),'YYYY/MM/DD HH24:MI:SS') UPDATE_DATE, 
                        NVL(M.UPDATE_EMPID,M.INSERT_EMPID) UPDATE_EMPID,
                        E1.FIRSTNAME||'.'||SUBSTR(E1.LASTNAME,0,1) UPDATE_EMPNAME,
                        rtrim(to_char(m.DISCOUNT_PERCENT,'fm90.99'),'.') DISCOUNT_PERCENT,POS_SERIAL,SIM_NUMBER,m.phone,m.direction,m.device_type
                    from eoffice.MERCH_MERCHANT m 
                    LEFT JOIN ".$this->dbSchema.".GEN_BRANCH B ON B.BRCH_CODE=M.BRANCH_CODE
                    LEFT JOIN ".$this->dbSchema.".CIF_CUST C ON C.CUST_CODE=M.CUSTNO
                    LEFT JOIN ".$this->dbSchema.".BCOM_ACNT A ON A.ACNT_CODE=M.TEMP_ACNTNO
                    LEFT JOIN ".$this->dbSchema.".BCOM_PROD P ON P.PROD_CODE=A.PROD_CODE
                    LEFT JOIN ".$this->dbSchema.".BCOM_ACNT A1 ON A1.ACNT_CODE=M.CA_ACNTNO
                    LEFT JOIN ".$this->dbSchema.".BCOM_PROD P1 ON P1.PROD_CODE=A1.PROD_CODE
                    LEFT JOIN eoffice.ORG_EMPLOYEE E ON E.EMP_ID=M.STATUS_EMPID
                    LEFT JOIN eoffice.ORG_EMPLOYEE E1 ON E1.EMP_ID=NVL(M.UPDATE_EMPID,M.INSERT_EMPID)
                    where m.status!='D' 
                    order by M.MERCHANT_ID desc
                            ";
            //dd($merchantListQuery);
            $recordsMerchant = DB::select($merchantListQuery);
            //dd($recordsMerchant);
            return Datatables::of($recordsMerchant)
            ->addIndexColumn()
            ->make(true);
        }
        else{

            //dd($req->status , $req->device_type,$branch ,$discountPer);
            $andWhere = "";

            if($status && is_null($device_type) && is_null($branch) && is_null($discountPer)){
                $andWhere = "and m.status = '$status' ";
            }
            elseif(is_null($status) && $device_type && is_null($branch) && is_null($discountPer)){
                $andWhere = "and m.device_type = '$device_type' ";
            }
            elseif(is_null($status) && is_null($device_type) && $branch && is_null($discountPer)){
                $andWhere = "and m.branch_code = '$branch' ";
            }
            elseif(is_null($status) && is_null($device_type) && is_null($branch)  && $discountPer){
                $andWhere = "and m.DISCOUNT_PERCENT = '$discountPer' ";
            }
            elseif($status && $device_type && is_null($branch) && is_null($discountPer)){
                $andWhere = "and m.status = '$status' and m.device_type = '$device_type'";
            }
            elseif($status && is_null($device_type) && $branch && is_null($discountPer)){
                $andWhere = "and m.status = '$status' and m.branch_code = '$branch'";
            }
            elseif($status && is_null($device_type) && is_null($branch)  && $discountPer){
                $andWhere = "and m.status = '$status' and m.DISCOUNT_PERCENT = '$discountPer'";
            }
            elseif(is_null($status) && $device_type && $branch  && is_null($discountPer)){
                $andWhere = "and m.device_type = '$device_type' and m.branch_code = '$branch'";
            }
            elseif(is_null($status) && is_null($device_type)  && $branch  && $discountPer){
                $andWhere = "and m.branch_code = '$branch' and m.DISCOUNT_PERCENT = '$discountPer'";
            }
            elseif(is_null($status) && $device_type  && is_null($branch)  && $discountPer){
                $andWhere = "and m.device_type = '$device_type' and m.DISCOUNT_PERCENT = '$discountPer'";
            }
            elseif($status && $device_type  && $branch  && is_null($discountPer)){
                $andWhere = "and m.status = '$status' and m.device_type = '$device_type' and m.branch_code = '$branch' ";
            }
            elseif(is_null($status) && $device_type  && $branch  && $discountPer){
                $andWhere = " and m.device_type = '$device_type' and m.branch_code = '$branch' and m.DISCOUNT_PERCENT = '$discountPer'";
            }
            elseif($status && is_null($device_type)  && $branch  && $discountPer){
                $andWhere = " and m.status = '$status' and m.branch_code = '$branch' and m.DISCOUNT_PERCENT = '$discountPer'";
            }
            elseif($status && $device_type  && is_null($branch)  && $discountPer){
                $andWhere = " and m.status = '$status' and m.device_type = '$device_type' and m.DISCOUNT_PERCENT = '$discountPer'";
            }
            elseif($status && $device_type  && $branch  && $discountPer){
                $andWhere = " and m.status = '$status' and m.device_type = '$device_type' and m.branch_code = '$branch' and m.DISCOUNT_PERCENT = '$discountPer'";
            }
            $merchantListQuery = "
                    select M.MERCHANT_ID, 
                        M.CUSTNO, 
                        C.NAME CUST_NAME,
                        M.TEMP_ACNTNO, 
                        P.NAME TEMP_PROD_NAME,
                        M.CA_ACNTNO, 
                        P1.NAME CA_PROD_NAME,
                        M.MERCHANT_NAME, 
                        M.MERCHANT_ADDR, 
                        M.BRANCH_CODE||' - '||B.NAME BRANCH, 
                        decode(M.STATUS,
                        'A', 'Идэвхтэй',
                        'N', 'Идэвхгүй'
                        )  as status,m.status as status_code,
                        to_char(M.STATUS_DATE,'YYYY/MM/DD HH24:MI:SS') STATUS_DATE, 
                        M.STATUS_EMPID, 
                        E.FIRSTNAME||'.'||SUBSTR(E.LASTNAME,0,1) STATUS_EMPNAME,
                        to_char(NVL(M.UPDATE_DATE,M.INSERT_DATE ),'YYYY/MM/DD HH24:MI:SS') UPDATE_DATE, 
                        NVL(M.UPDATE_EMPID,M.INSERT_EMPID) UPDATE_EMPID,
                        E1.FIRSTNAME||'.'||SUBSTR(E1.LASTNAME,0,1) UPDATE_EMPNAME,
                        rtrim(to_char(m.DISCOUNT_PERCENT,'fm90.99'),'.') DISCOUNT_PERCENT,POS_SERIAL,SIM_NUMBER,m.phone,m.direction,m.device_type
                    from eoffice.MERCH_MERCHANT m 
                    LEFT JOIN ".$this->dbSchema.".GEN_BRANCH B ON B.BRCH_CODE=M.BRANCH_CODE
                    LEFT JOIN ".$this->dbSchema.".CIF_CUST C ON C.CUST_CODE=M.CUSTNO
                    LEFT JOIN ".$this->dbSchema.".BCOM_ACNT A ON A.ACNT_CODE=M.TEMP_ACNTNO
                    LEFT JOIN ".$this->dbSchema.".BCOM_PROD P ON P.PROD_CODE=A.PROD_CODE
                    LEFT JOIN ".$this->dbSchema.".BCOM_ACNT A1 ON A1.ACNT_CODE=M.CA_ACNTNO
                    LEFT JOIN ".$this->dbSchema.".BCOM_PROD P1 ON P1.PROD_CODE=A1.PROD_CODE
                    LEFT JOIN eoffice.ORG_EMPLOYEE E ON E.EMP_ID=M.STATUS_EMPID
                    LEFT JOIN eoffice.ORG_EMPLOYEE E1 ON E1.EMP_ID=NVL(M.UPDATE_EMPID,M.INSERT_EMPID)
                    where m.status!='D' ".$andWhere."
                    order by M.MERCHANT_ID desc
                            ";
            //dd($merchantListQuery);
            $recordsMerchant = DB::select($merchantListQuery);
            //dd($recordsMerchant);
            return Datatables::of($recordsMerchant)
            ->addIndexColumn()
            ->make(true);
        }
     
    }
    
    public function getAddMerchModal(Request $request) {

        $merchId = $request->merchId;

        $queryBranch = "
            select G.BRCH_CODE, G.NAME  from ".$this->dbSchema.".GEN_BRANCH g where G.STATUS='1' order by G.BRCH_CODE
            ";
        $recordBranch = DB::select($queryBranch);

        $queryCardProd = "
            select up.*, UP.CARDPREFIX	as card_prod_code, up.prefixname as name from ".$this->dbSchema.".UVW_PRODUCTS up
                order by prefixname asc
            ";
        $recordCardProd = DB::select($queryCardProd);
      
        $content = View::make('merchant::addMerchantModal')
                ->with("recordBranch", $recordBranch)
                ->with("recordCardProd", $recordCardProd)
                ->render();

        $response_array['data'] = $content;

        $data = json_encode($recordBranch);
        //dd($content);
        header('Content-type: application/json');
        echo json_encode($response_array);
    }
    public function getEditMerchModal(Request $request) {

        $merchId = $request->merch_id;

        $queryBranch = "
            select G.BRCH_CODE, G.NAME  from ".$this->dbSchema.".GEN_BRANCH g where G.STATUS='1' order by G.BRCH_CODE
            ";
        $recordBranch = DB::select($queryBranch);

         $queryMerchant = "
            SELECT M.MERCHANT_ID,M.CUSTNO,C.NAME CUST_NAME,M.TEMP_ACNTNO,P.NAME TEMP_PROD_NAME,M.CA_ACNTNO,P1.NAME CA_PROD_NAME,M.MERCHANT_NAME,M.MERCHANT_ADDR,M.BRANCH_CODE || '-' || B.NAME BRANCH_NAME,M.BRANCH_CODE,M.STATUS,
                     TO_CHAR (M.STATUS_DATE, 'YYYY/MM/DD HH24:MI:SS') STATUS_DATE,M.STATUS_EMPID,E.FIRSTNAME || '.' || SUBSTR (E.LASTNAME, 0, 1) STATUS_EMPNAME,
                     TO_CHAR (NVL (M.UPDATE_DATE, M.INSERT_DATE), 'YYYY/MM/DD HH24:MI:SS') UPDATE_DATE,NVL (M.UPDATE_EMPID, M.INSERT_EMPID) UPDATE_EMPID,E1.FIRSTNAME || '.' || SUBSTR (E1.LASTNAME, 0, 1) UPDATE_EMPNAME,
                     rtrim(to_char(m.DISCOUNT_PERCENT,'fm90.99'),'.') DISCOUNT_PERCENT,POS_SERIAL, SIM_NUMBER,m.phone,m.direction,m.device_type,m.merchant_id360
                FROM eoffice.MERCH_MERCHANT m
                     LEFT JOIN ".$this->dbSchema.".GEN_BRANCH B ON B.BRCH_CODE = M.BRANCH_CODE
                     LEFT JOIN ".$this->dbSchema.".CIF_CUST C ON C.CUST_CODE = M.CUSTNO
                     LEFT JOIN ".$this->dbSchema.".BCOM_ACNT A ON A.ACNT_CODE = M.TEMP_ACNTNO
                     LEFT JOIN ".$this->dbSchema.".BCOM_PROD P ON P.PROD_CODE = A.PROD_CODE
                     LEFT JOIN ".$this->dbSchema.".BCOM_ACNT A1 ON A1.ACNT_CODE = M.CA_ACNTNO
                     LEFT JOIN ".$this->dbSchema.".BCOM_PROD P1 ON P1.PROD_CODE = A1.PROD_CODE
                     LEFT JOIN eoffice.ORG_EMPLOYEE E ON E.EMP_ID = M.STATUS_EMPID
                     LEFT JOIN eoffice.ORG_EMPLOYEE E1
                        ON E1.EMP_ID = NVL (M.UPDATE_EMPID, M.INSERT_EMPID)
               WHERE m.status != 'D' and m.merchant_id = '$merchId'
            ORDER BY M.MERCHANT_ID
            ";
        $recordSelectedMerch = DB::select($queryMerchant);

        $custCode = $recordSelectedMerch[0]->custno;

        $queryMerchantCaAnct = "
            SELECT A.ACNT_CODE,A.CUST_CODE,A.NAME ACNT_NAME,P.NAME PROD_NAME,A.STATUS,C.NAME STATUS_NAME
                FROM ".$this->dbSchema.".BCOM_ACNT a
                     LEFT JOIN ".$this->dbSchema.".BCOM_PROD p ON P.PROD_CODE = A.PROD_CODE
                     LEFT JOIN ".$this->dbSchema.".BCOM_CONST c
                        ON     C.TABLE_NAME = 'BCOM_ACNT'
                           AND C.COL_NAME = 'STATUS'
                           AND C.COL_VALUE = A.STATUS
               WHERE A.CUST_CODE = '$custCode' AND A.SYS_NO = '1305' AND A.STATUS NOT IN ('C', 'D')
            ORDER BY A.ACNT_CODE
            ";
        $recordsMerchCaAcnt = DB::select($queryMerchantCaAnct);

        $queryMerchCards = "
            select mmc.*,tcp.prefixname as name from eoffice.merch_merchant_card mmc
                    left join ".$this->dbSchema.".UVW_PRODUCTS tcp on tcp.cardprefix = mmc.card_prod_code
                        where mmc.merchant_id  = '$merchId' and mmc.status= 'active'
            ";
        $recordMerchCards = DB::select($queryMerchCards);

        $queryCardProd = "
            select up.*, UP.CARDPREFIX	as card_prod_code, up.prefixname as name from ".$this->dbSchema.".UVW_PRODUCTS up
                order by prefixname asc
            ";
        $recordCardProd = DB::select($queryCardProd);
        //dd($recordSelectedMerch);
        $content = View::make('merchant::editMerchantModal')
                ->with("recordBranch", $recordBranch)
                ->with("recordSelectedMerch", $recordSelectedMerch[0])
                ->with("recordsMerchCaAcnt", $recordsMerchCaAcnt)
                ->with("recordMerchCards", $recordMerchCards)
                ->with("recordCardProd", $recordCardProd)
                ->render();

        $response_array['data'] = $content;

        header('Content-type: application/json');
        echo json_encode($response_array);
    }

    public function checkMerchID(Request $request) {

        $merchID = $request->merchId;
        
        $queryMerchId = "
            select count(*) CNT from MERCH_MERCHANT m where m.merchant_id='$merchID' 
            ";
        $recordMerchCnt = DB::select($queryMerchId);
        //dd($recordMerchCnt);
        $data = json_encode($recordMerchCnt[0]);
        die($data);
    }

    public function registerMerch(Request $req) {

        $empId = Auth::user()->emp_id;
        $empEmail = Auth::user()->email;
        $merchID = $req->merchId;
        $branch = $req->branch;
        $custNo = $req->custNo;
        $discountPer = $req->discountPer;
        $merchName = $req->merchName;
        $posAcnt = $req->posAcnt;
        $caAcnt = $req->caAcnt;
        $address = $req->address;
        $status = $req->status;
        $simNumber = $req->simNumber;
        $posNumber = $req->posNumber;
        $terminal = $req->terminal;
        $phone = $req->phone;
        $direction = $req->direction;
        $deviceType = $req->device_type;
        $createdDate = date("Y/m/d H:i:m"); 
        $logDate = date("Y/m/d H:i:m");
        $remoteAddr = $_SERVER['REMOTE_ADDR'];
        $cardStatus = "active";
         
        try {
            DB::beginTransaction();

            //dd($insertMerchLog);
            $insertMerch = array(
                "merchant_id" => $merchID,
                "custno" => $custNo,
                "temp_acntno" =>$posAcnt,
                "ca_acntno" => $caAcnt,
                "merchant_name"=> $merchName,
                "merchant_addr" => $address,
                "branch_code" => $branch,
                "status" => $status,
                "status_date" => $createdDate,
                "status_empid" => $empId,
                "insert_date" => $createdDate,
                "insert_empid" => $empId,
                "discount_percent" => $discountPer,
                "sim_number" => $simNumber,
                "pos_serial" => $posNumber,
                "merchant_id360" => $terminal,
                "phone" => $phone,
                "direction" => $direction,
                "device_type" => $deviceType,
            );
            //dd($insertMerch);
            $recordMerch = DB::table("MERCH_MERCHANT")->insert($insertMerch);

            $insertMerchLog = array(
                "merchant_id" => $merchID,
                "custno" => $custNo,
                "temp_acntno" =>$posAcnt,
                "ca_acntno" => $caAcnt,
                "merchant_name"=> $merchName,
                "merchant_addr" => $address,
                "branch_code" => $branch,
                "status" => $status,
                "status_date" => $createdDate,
                "status_empid" => $empId,
                "insert_date" => $createdDate,
                "insert_empid" => $empId,
                "discount_percent" => $discountPer,
                "merchant_id360" => $terminal,
                "sim_number" => $simNumber,
                "pos_serial" => $posNumber,
                "phone" => $phone,
                "direction" => $direction,
                "device_type" => $deviceType,
                "log_date" => $logDate,
                "log_empid" => $empId,
                "remote_addr" => $remoteAddr,

            );

            $recordMerchLog = DB::table("MERCH_MERCHANT_LOG")->insert($insertMerchLog);

            //dd(!is_null($req->card_prod_code));

            if(!is_null($req->card_prod_code)){
                for ($i = 0; $i < count($req->card_prod_code); $i++) {
                    $cardData[] = array(
                         "merchant_id" => $merchID,
                         'card_prod_code'    =>  $req->card_prod_code[$i],
                         'bonus_percent'     =>  $req->bonus_percent[$i],
                         'status'     =>  $cardStatus,
                         "created_emp_id" => $empId,
                         "created_date" => $createdDate,
                     );
                 }
                 //dd($cardData);
                 DB::table('EOFFICE.MERCH_MERCHANT_CARD')->insert($cardData);
            }else{ }
            
            DB::commit();

            return redirect()->back()->with('message', 'Амжилттай бүртгэгдлээ');
        }
        catch(\Illuminate\Database\QueryException $e)
            {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
            exit;
        }
    }

    public function editMerch(Request $req)
    {
        $empId = Auth::user()->emp_id;
        $empEmail = Auth::user()->email;
        $merchID = $req->merchId;
        $branch = $req->branch;
        $custNo = $req->custNo;
        $discountPer = $req->discountPer;
        $merchName = $req->merchName;
        $posAcnt = $req->posAcnt;
        $caAcnt = $req->caAcntEdit;
        $address = $req->address;
        $status = $req->status;
        $createdDate = date("Y/m/d H:i:m"); 
        $logDate = date("Y/m/d H:i:m");
        $remoteAddr = $_SERVER['REMOTE_ADDR'];
        $simNumber = $req->simNumber;
        $posNumber = $req->posNumber;
        $terminal = $req->terminal;
        $phone = $req->phone;
        $direction = $req->direction;
        $deviceType = $req->device_type;
        $cardStatus = "active";

        //dd($merchID, $custNo, $caAcnt ,$status );
        try {
            DB::beginTransaction();

            $updateAcntSms = DB::update("update EOFFICE.MERCH_MERCHANT set 
                custno = '$custNo',
                temp_acntno = '$posAcnt',
                ca_acntno = '$caAcnt',
                merchant_name = '$merchName',
                merchant_addr = '$address',
                branch_code = '$branch',
                status = '$status',
                status_date = '$createdDate',
                status_empid = '$empId',
                update_date = '$logDate',
                update_empid = '$empId',
                discount_percent = '$discountPer',
                merchant_id360 = '$terminal',
                pos_serial = '$posNumber',
                sim_number = '$simNumber',
                phone = '$phone',
                direction = '$direction',
                device_type = '$deviceType'
                where merchant_id = '$merchID' ");
            //$updateAcntSms = DB::commit();
            
            $insertMerchLog = array(
                "merchant_id" => $merchID,
                "custno" => $custNo,
                "temp_acntno" =>$posAcnt,
                "ca_acntno" => $caAcnt,
                "merchant_name"=> $merchName,
                "merchant_addr" => $address,
                "branch_code" => $branch,
                "status" => $status,
                "status_date" => $createdDate,
                "status_empid" => $empId,
                "update_date" => $logDate,
                "update_empid" => $empId,
                "discount_percent" => $discountPer,
                "merchant_id360" => $terminal,
                "sim_number" => $simNumber,
                "pos_serial" => $posNumber,
                "log_date" => $logDate,
                "log_empid" => $empId,
                "remote_addr" => $remoteAddr,
                "phone" => $phone,
                "direction" => $direction,
                "device_type" => $deviceType,

            );

            $recordMerchLog = DB::table("EOFFICE.MERCH_MERCHANT_LOG")->insert($insertMerchLog);

            if(!is_null($req->card_prod_code)){
                $deleteMerchCards = DB::update("
                    update MERCH_MERCHANT_CARD o set O.STATUS='inactive', O.UPDATED_DATE=sysdate, O.UPDATED_EMP_ID='$empId' where O.MERCHANT_ID='$merchID' and o.status!='inactive'
                    ");
                //$deleteMerchCards = DB::delete("delete from MERCH_MERCHANT_CARD where merchant_id = '$merchID'");
                //$deleteMerchCards = DB::commit();

                for ($i = 0; $i < count($req->card_prod_code); $i++) {
                    $cardData[] = array(
                         "merchant_id" => $merchID,
                         'card_prod_code'    =>  $req->card_prod_code[$i],
                         'bonus_percent'     =>  $req->bonus_percent[$i],
                         'status'     =>  $cardStatus,
                         "created_emp_id" => $empId,
                         "created_date" => $createdDate,
                     );
                 }
                 //dd($uboData);
                 DB::table('EOFFICE.MERCH_MERCHANT_CARD')->insert($cardData);
            }else{ }

            DB::commit();
           
            return redirect()->back()->with('message', 'Амжилттай хадгаллаа');
        }
        catch(\Illuminate\Database\QueryException $e)
            {
            DB::rollBack();
            //Redirect::to('/')->with('message', $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
            exit;
        }
    }
    public function getDetailMerchModal(Request $request) {

        $merchId = $request->merch_id;

         $queryMerchant = "
            select M.MERCHANT_ID, 
                M.CUSTNO, 
                C.NAME CUST_NAME,
                M.TEMP_ACNTNO, 
                P.NAME TEMP_PROD_NAME,
                M.CA_ACNTNO, 
                P1.NAME CA_PROD_NAME,
                M.MERCHANT_NAME, 
                M.MERCHANT_ADDR, 
                M.BRANCH_CODE,
                M.BRANCH_CODE||'-'||B.NAME BRANCH, 
                M.STATUS, 
                to_char(M.STATUS_DATE,'YYYY/MM/DD HH24:MI:SS') STATUS_DATE, 
                M.STATUS_EMPID, 
                E.FIRSTNAME||'.'||SUBSTR(E.LASTNAME,0,1) STATUS_EMPNAME,
                to_char(NVL(M.UPDATE_DATE,M.INSERT_DATE ),'YYYY/MM/DD HH24:MI:SS') UPDATE_DATE,
                NVL(M.UPDATE_EMPID,M.INSERT_EMPID) UPDATE_EMPID,
                E1.FIRSTNAME||'.'||SUBSTR(E1.LASTNAME,0,1) UPDATE_EMPNAME,
                rtrim(to_char(m.DISCOUNT_PERCENT,'fm90.99'),'.') DISCOUNT_PERCENT,POS_SERIAL, SIM_NUMBER,m.phone,m.direction,m.device_type,m.merchant_id360
            from MERCH_MERCHANT m 
            LEFT JOIN ".$this->dbSchema.".GEN_BRANCH B ON B.BRCH_CODE=M.BRANCH_CODE
            LEFT JOIN ".$this->dbSchema.".CIF_CUST C ON C.CUST_CODE=M.CUSTNO
            LEFT JOIN ".$this->dbSchema.".BCOM_ACNT A ON A.ACNT_CODE=M.TEMP_ACNTNO
            LEFT JOIN ".$this->dbSchema.".BCOM_PROD P ON P.PROD_CODE=A.PROD_CODE
            LEFT JOIN ".$this->dbSchema.".BCOM_ACNT A1 ON A1.ACNT_CODE=M.CA_ACNTNO
            LEFT JOIN ".$this->dbSchema.".BCOM_PROD P1 ON P1.PROD_CODE=A1.PROD_CODE
            LEFT JOIN ORG_EMPLOYEE E ON E.EMP_ID=M.STATUS_EMPID
            LEFT JOIN ORG_EMPLOYEE E1 ON E1.EMP_ID=NVL(M.UPDATE_EMPID,M.INSERT_EMPID)
            where m.MERCHANT_ID='$merchId' and m.status!='D'
            ";
        $recordDetailMerch = DB::select($queryMerchant);

        $queryMerchCards = "
        select mmc.*,tcp.prefixname as name from eoffice.merch_merchant_card mmc
        left join ".$this->dbSchema.".UVW_PRODUCTS tcp on tcp.cardprefix = mmc.card_prod_code
            where mmc.merchant_id  = '$merchId' and mmc.status= 'active'
            ";
        $recordMerchCards = DB::select($queryMerchCards);

        //dd($recordDetailMerch);

        $content = View::make('merchant::detailMerchantModal')
                ->with("recordDetailMerch", $recordDetailMerch[0])
                ->with("recordMerchCards", $recordMerchCards)
                ->render();

        $response_array['data'] = $content;

        header('Content-type: application/json');
        echo json_encode($response_array);
    }
    public function deleteMerch(Request $req) {
      
        $merchId = $req->merch_id;
        $empId = Auth::user()->emp_id;
        $remoteAddr = $_SERVER['REMOTE_ADDR'];
        //dd($merchId);
        
        try {
            DB::beginTransaction();

            $result = DB::update("
            update MERCH_MERCHANT o set O.STATUS='D', O.STATUS_DATE=sysdate, O.STATUS_EMPID='$empId' where O.MERCHANT_ID='$merchId' and o.status!='D'
            ");

            $deleteMerchCards = DB::update("
            update MERCH_MERCHANT_CARD o set O.STATUS='inactive', O.UPDATED_DATE=sysdate, O.UPDATED_EMP_ID='$empId' where O.MERCHANT_ID='$merchId' and o.status!='inactive'
            ");


            $queryMerchLog = DB::insert("
                insert into eoffice.MERCH_MERCHANT_LOG (MERCHANT_ID, CUSTNO, TEMP_ACNTNO, CA_ACNTNO, MERCHANT_NAME, 
                        MERCHANT_ADDR, BRANCH_CODE, STATUS, STATUS_DATE, STATUS_EMPID, 
                        INSERT_DATE, INSERT_EMPID, UPDATE_DATE, UPDATE_EMPID, DISCOUNT_PERCENT, 
                        MERCHANT_ID360,LOG_DATE,LOG_EMPID,REMOTE_ADDR)
                    SELECT
                       MERCHANT_ID, CUSTNO, TEMP_ACNTNO, CA_ACNTNO, MERCHANT_NAME, 
                        MERCHANT_ADDR, BRANCH_CODE, STATUS, STATUS_DATE, STATUS_EMPID, 
                        INSERT_DATE, INSERT_EMPID, UPDATE_DATE, UPDATE_EMPID, DISCOUNT_PERCENT, 
                        MERCHANT_ID360,sysdate,'$empId','$remoteAddr'
                    from eoffice.MERCH_MERCHANT
                    where merchant_id = '$merchId'
                ");

            DB::commit();
           
            return redirect()->back()->with('message', 'Амжилттай устгагдлаа');
        }
        catch(\Illuminate\Database\QueryException $e)
            {
            DB::rollBack();
            return redirect()->back()->with('message', $e->getMessage());
            exit;
        }
        
    }
    public function getCustCaAcnt(Request $request) {

        $custNo = $request->custNo;

        $queryCustCaAcntList = "
            select A.ACNT_CODE, A.CUST_CODE, A.NAME ACNT_NAME, P.NAME PROD_NAME , A.STATUS, C.NAME STATUS_NAME
                from ".$this->dbSchema.".BCOM_ACNT a 
            left join ".$this->dbSchema.".BCOM_PROD p on P.PROD_CODE=A.PROD_CODE
            left join ".$this->dbSchema.".BCOM_CONST c on C.TABLE_NAME='BCOM_ACNT' and C.COL_NAME='STATUS' and C.COL_VALUE=A.STATUS
                where A.CUST_CODE='$custNo' and A.SYS_NO='1305' and A.STATUS not in ('C','D')
            order by A.ACNT_CODE
        ";

        $recordCustCaAcntList = DB::select($queryCustCaAcntList);

        $data = json_encode($recordCustCaAcntList);
        die($data);
    }

}
