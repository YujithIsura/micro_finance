<?php
/**
 * Developer Dilani Chathurika.
 * User: Php
 * Date: 17/05/17
 * Time: 9:36 AM
 */
/**
 * Modified By Dinesh Lakmal.
 * User: Php
 * Date: 17/07/25
 * Time: 9:36 AM
 */
//
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
class JobTicket1_con extends MY_Controller
{


    function __construct()
    {

        parent::__construct();
//        $this->load->model('report_model_three');
        $this->load->model('Job_order_model');
        $this->load->model('Invoice_model');
        $this->load->model('Material_req_model');
        $this->load->model('Form_serial_model_withaccnme');

        $this->from = '1900-01-01';
        $this->to = date('Y-m-d');

        // to prevent memory limit exeed error  (2015.11.26)
        ini_set('memory_limit', '2000M');
        ini_set('max_execution_time', 300);
    }

    public function index()
    {
        $data['jobTicket'] = $this->Job_order_model->get_allJobTickets();
        $data['jobTicket2'] = $this->Job_order_model->get_allJobTickets2();
        $data['materialReq'] = $this->Material_req_model->get_allReqs();
        $data['quotations'] = $this->Job_order_model->getAll_quotationData();
        $data['jobOrder01'] = $this->Job_order_model->getAllJoborderData();
        if ($this->viewper[0]->joborder == 1) {
            $data['loadJoborder2'] = $this->Invoice_model->loadAll_JobOrder2();
        }
        if ($this->viewper[0]->dispatchinvoice == 1) {
            $data['loadDispatchNote'] = $this->Invoice_model->loadAll_DispatchNote();
        }

//        echo "<pre>"; print_r($data['jobOrder01']); exit();
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('customized_forms/customizedForms_view.php');
        $this->load->view('template/footer');
    }


    public function load_jobTicket1_form()
    {

        $data['itemCmbData'] = $this->Job_order_model->loadItemCodeCmbInven();
        $data['customerList'] = $this->Invoice_model->loadCustomer();
//        $data['serialNo'] = $this->Job_order_model->GenarateSerialNoforJobTicket();
        $data['serialNo'] = $this->Form_serial_model_withaccnme->getRealSerialNumber("jobTicket1",'Account Receivable');
        /*print_r($data['serialNo']);
        exit();*/
        $data['unitList'] = $this->Job_order_model->loadUnitList2();
        // echo '<pre>'; print_r($data['itemCmbData']); exit();
        $data['userName'] = $_SESSION['session_user_data']['userName'];

        if ($this->viewper[0]->cmzdjt01_ == 1) {

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('customized_forms/job_ticket01/JobTicket_view');
        $this->load->view('template/footer');

        } else {
            $this->permissionError();
            return false;
        }


    }

    public function submitForm()
    {
        //echo "chk";

        $print_preview = $this->input->post('btn_type');
        $print = $this->input->post('print');
//        exit();
        // $t = $_POST; echo "<pre>"; print_r($t); exit();
        $btn_type = $this->input->post('btn_type');
        if ($btn_type == 'sv_c') {
            if ($this->saveper[0]->cmzdjt01_ == 1) {

            $this->save_and_close();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($btn_type == 'sv_nw') {
            if ($this->saveper[0]->cmzdjt01_ == 1) {

            $this->save_and_new();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($btn_type == 'reset') {
            $this->reset_page();
        }
        if ($btn_type == 'update') {
            if ($this->editper[0]->cmzdjt01_ == 1) {

            $this->update_data();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($print == 'update') {
            if ($this->editper[0]->cmzdjt01_ == 1 && $this->printper[0]->cmzdjt01_ == 1) {

            $id = $this->input->post('id');
            //  exit($id);
            $result = $this->Job_order_model->updateData1($id);
            if ($result) {
                $this->jobticket1print();
            } else {
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");

                redirect(base_url('JobTicket1_con'));
            }

            } else {
                $this->permissionError();
                return false;
            }

        }
        if ($print == 'update_only_print') {
            $id = $this->input->post('id');
            if ($this->printper[0]->cmzdjt01_ == 1) {

            $this->jobticket1print();

            } else {
                $this->permissionError();
                return false;
            }

        }
        if ($print_preview == 'print_preview') {
            //exit('sads');

            if ($this->printper[0]->cmzdjt01_ == 1 && $this->saveper[0]->cmzdjt01_ == 1) {

            $result = $this->Job_order_model->insertJobTicketData();
            if ($result) {
                $this->jobticket1print();
//                redirect(base_url('Invoice_control/LoadAddNewAccountView'));
            } else {
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
                redirect(base_url('JobTicket1_con/load_jobTicket1_form'));
            }

            } else {
                $this->permissionError();
                return false;
            }

        }
    }

    public function jobticket1print()
    {

        $data['res1'] = array(
                'serialno'=>$this->input->post('serialNo'),
            'customerName' => $this->input->post('customername'),
            'address' => $this->input->post('address'),
            'orderNo' => $this->input->post('totalamountpaid'),
            'date' => $this->input->post('jobTicketdate'),
            'createdUser' => $this->input->post('createdUser'),
            'deliveryDate' => $this->input->post('delivery_dt'),
            'proofDate' => $this->input->post('proofDate'),
            'estimate' => $this->input->post('extimatedtxt'),
            'proof' => $this->input->post('proofingtxt'),
            'ref' => $this->input->post('totalamountpaid2'),
            'titleOfJobs' => $this->input->post('titleOfJobs'),
            'qty' =>str_replace(',','',$this->input->post('qty_header')),
            'other_specification' => $this->input->post('other_specification'),
            'job_type' => $this->input->post('radio2'),


        );
        $data['cartoon'] = array(
            'car_itemName' => $this->input->post('item_cartoon'),
            'car_colourNo' => $this->input->post('colour_select_cartoon'),
            'car_uv' => $this->input->post('uv'),
            'car_laminating' => $this->input->post('laminating'),
            'car_foiling' => $this->input->post('foiling'),
            'car_dieCutting' => $this->input->post('die_cutting'),
            'car_posting' => $this->input->post('posting'),
            'car_embossing' => $this->input->post('embossing'),
            'car_spotUv' => $this->input->post('spot_uv'),
            'car_pasting' => $this->input->post('pasting'),
            'car_embossingNew' => $this->input->post('embossingNew'),
            'car_op_vanish' => $this->input->post('op_vanish'),
            'car_matt_varnish' => $this->input->post('matt_varnish'),
            'car_gloss_varnish' => $this->input->post('gloss_varnish'),
            'car_b_side_print' => $this->input->post('both_side_printing'),
            'car_waterbase_varnish' => $this->input->post('waterbase_varnish'),
            'colour_select_cartoon' => $this->input->post('colour_select_cartoon'),

        );
        $data['books'] = array(
            'b_itemName' => $this->input->post('books_customer'),
            'b_pages' => $this->input->post('no_of_pages'),
            'b_colourNo' => $this->input->post('books_colours'),
            'b_uv' => $this->input->post('books_uv'),
            'b_laminating' => $this->input->post('books_laminating'),
            'b_foiling' => $this->input->post('books_foiling'),
            'b_dieCutting' => $this->input->post('books_die_cutting'),
            'b_posting' => $this->input->post('books_posting'),
            'b_embossing' => $this->input->post('books_embossing'),
            'b_spotUv' => $this->input->post('books_spot_uv'),
            'b_pasting' => $this->input->post('books_pasting'),
            'b_doubleSidePrinting' => $this->input->post('books_doubleSidePrint'),
            'b_embossingNew' => $this->input->post('books_embossingNew'),
            'b_op_vanish' => $this->input->post('books_op_vanish'),
            'b_matt_varnish' => $this->input->post('books_matt_varnish'),
            'b_gloss_varnish' => $this->input->post('books_gloss_varnish'),
            'b_perfect_binding' => $this->input->post('books_perfect_binding'),
            'b_center_wire' => $this->input->post('books_center_wire'),
            'b_waterbase_varnish' => $this->input->post('books_waterbase_varnish'),
            'i_itemName' => $this->input->post('inner_customer'),
            'i_pages' => $this->input->post('no_of_pages_inner'),
            'i_colourNo' => $this->input->post('inner_no_colours'),
            'i_uv' => $this->input->post('booksinner_uv'),
            'i_laminaing' => $this->input->post('booksinner_laminating'),
            'i_foiling' => $this->input->post('booksinner_foiling'),
            'i_dieCutting' => $this->input->post('booksinner_die_cutting'),
            'i_posting' => $this->input->post('booksinner_posting'),
            'i_embossing' => $this->input->post('booksinner_embossing'),
            'i_spotUv' => $this->input->post('booksinner_spot_uv'),
            'i_pasting' => $this->input->post('booksinner_pasting'),
            'i_doubleSidePrinting' => $this->input->post('booksinner_doubleSidePrint'),
            'i_embossingNew' => $this->input->post('booksinner_embossingNew'),
            'i_op_vanish' => $this->input->post('booksinner_op_vanish'),
            'i_matt_varnish' => $this->input->post('booksinner_matt_varnish'),
            'i_gloss_varnish' => $this->input->post('booksinner_gloss_varnish'),
            'i_perfect_binding' => $this->input->post('booksinner_perfect_binding'),
            'i_center_wire' => $this->input->post('booksinner_center_wire'),
            'i_waterbase_varnish' => $this->input->post('booksinner_waterbase_varnish'),

        );

        $rowCount = $this->input->post('rowCount2');
//       exit($rowCount);
        for ($i = 0; $i < $rowCount; $i++) {
            $des = $this->input->post('desc_td' . $i);
      
            if (!empty($des)) {
                $data[table][$i] = array(
                    'description' => $des,
                    'qty' => number_format($this->input->post('qty_txt' . $i),0,'.',',') ,
                    'unitPrice' => (float)str_replace(',', '', $this->input->post('rate_txt' . $i)),
                    'total' => (float)str_replace(',', '', $this->input->post('amount_txt' . $i)),
                    'unit' => $this->input->post('unit_se' . $i)
                );
            }

        }

        $this->session->set_userdata('pass_data', $data);
        $this->load->view("customized_forms/job_ticket01/jobTicket1Print", $data);

    }

    public function update_data()
    {
        //  $t = $_POST; echo "<pre>"; print_r($t); exit();
        $id = $this->input->post('id');
        //  exit($id);
        $result = $this->Job_order_model->updateData1($id);
        if ($result) {

            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con'));
//                redirect(base_url('Invoice_control/LoadAddNewAccountView'));
        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
            redirect(base_url('JobTicket1_con'));
        }

    }

    public function save_and_close()
    {
        // exit('go');
        $result = $this->Job_order_model->insertJobTicketData();
        if ($result) {

            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con'));
//                redirect(base_url('Invoice_control/LoadAddNewAccountView'));
        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
            redirect(base_url('JobTicket1_con/load_jobTicket1_form'));
        }

    }

    public function save_and_new()
    {
        // exit('go');
        $result = $this->Job_order_model->insertJobTicketData();
        if ($result) {

            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con/load_jobTicket1_form'));
//                redirect(base_url('Invoice_control/LoadAddNewAccountView'));
        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
            redirect(base_url('JobTicket1_con/load_jobTicket1_form'));
        }

    }

    public function reset_page()
    {
        $this->load_jobTicket1_form();
    }

    function getCusDetails()
    {
        $cusname = str_replace(',', '', $this->input->post('cusname'));
        //exit($cusname);
        $this->Job_order_model->getCusDetails($cusname);

    }

    public function select_update($id)
    {
        //  exit($id);
        $data['itemCmbData'] = $this->Job_order_model->loadItemCodeCmbInven();
        $data['customerList'] = $this->Invoice_model->loadCustomer();
        $data['quotationsTblMid'] = $this->Job_order_model->getselected_JB1TblMid($id);
        $data['jobTicket_Data'] = $this->Job_order_model->get_selectedallJobTickets($id);
        $data['jobTicket_table'] = $this->Job_order_model->getAllJobTicketTable_data($id);
//        echo '<pre>'; print_r($data['jobTicket_table']); exit();

        if ($this->viewper[0]->cmzdjt01_ == 1) {

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('customized_forms/job_ticket01/job_ticket_update_view.php');
        $this->load->view('template/footer');

        } else {
            $this->permissionError();
            return false;
        }

    }


    // ==================================== Quotation =======================================================

    public function load_quotation_form()
    {

        $data['itemCmbData'] = $this->Job_order_model->loadItemCodeCmbInven();
        $data['itemCmbDataService'] = $this->Invoice_model->loadItemCodeCmb22();
        $data['customerList'] = $this->Invoice_model->loadCustomer();
        $data['serialNo'] = $this->Job_order_model->GenarateSerialNoforQuotation();
        $data['accountCmbData'] = $this->Invoice_model->loadAccountCmb();
        $data['numberstoBox'] = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
//        echo '<pre>'; print_r($data['customerList']); exit();
        $data['userName'] = $_SESSION['session_user_data']['userName'];
        if ($this->viewper[0]->cmzdquota == 1) {


        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('customized_forms/quotation/Quotation_add_new');
        $this->load->view('template/footer');
        } else {
        $this->permissionError();
        return false;
        }
    }

    public function submitFunction_quotation()
    {
//        $t = $_POST; echo '<pre>'; print_r($t); exit();
        $print_preview = $this->input->post('print_preview');
        $update_print = $this->input->post('update_print');
        $btn_type = $this->input->post('btn_type');
        if ($btn_type == 'sv_c') {
            if ($this->saveper[0]->cmzdquota == 1) {

            $this->save_and_new_quotation();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($btn_type == 'sv_nw') {
            if ($this->saveper[0]->cmzdquota == 1) {

            $this->save_and_close_quotation();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($btn_type == 'update_data') {
//            echo 'gggg';
            if ($this->editper[0]->cmzdquota == 1) {


            $this->update_quotation();
            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($print_preview == 'print_preview') {

            if ($this->printper[0]->cmzdquota == 1) {

            $this->postUpdateDataToPrintView();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($update_print == 'update_print') {
            if ($this->printper[0]->cmzdquota == 1) {

            $this->postUpdateDataToPrintView1();

            } else {
                $this->permissionError();
                return false;
            }
        }
    }

    public function save_and_new_quotation()
    {
        if ($this->saveper[0]->cmzdquota == 1) {



        $result = $this->Job_order_model->insertDataQuotation();

        if ($result) {
//                    $this->session->set_flashdata("success_msg", "Submitted successfully!.");
            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con'));

        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");

            redirect(base_url('JobTicket1_con/load_quotation_form'));
        }


        } else {
            $this->permissionError();
            return false;
            }
    }

    public function save_and_close_quotation()
    {
        $result = $this->Job_order_model->insertDataQuotation();

        if ($result) {
//                    $this->session->set_flashdata("success_msg", "Submitted successfully!.");
            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con/load_quotation_form'));

        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");

            redirect(base_url('JobTicket1_con/load_quotation_form'));
        }
    }

    public function selectUpdate_quotation($id)
    {
        $data['itemCmbData'] = $this->Job_order_model->loadItemCodeCmbInven();
        $data['itemCmbDataService'] = $this->Invoice_model->loadItemCodeCmb22();
//         $data['customerList'] = $this->Invoice_model->loadCustomer();
        $data['serialNo'] = $this->Job_order_model->GenarateSerialNoforQuotation();
        $data['quotationsData'] = $this->Job_order_model->getselected_quotationData($id);
        $data['quotationsTblMid'] = $this->Job_order_model->getselected_quotationTblMid($id);
        $data['quotationsdetails'] = $this->Job_order_model->getselected_quotationDtails($id);
        $data['accountCmbData'] = $this->Invoice_model->loadAccountCmb();
        $data['customerList'] = $this->Invoice_model->loadCustomer();
        $data['numberstoBox'] = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
//         $data['customerList'] = $this->Invoice_model->getCustomersinCurrancyForUpdate($data['quotationsData'][0]->currency);
//         $data['accountCmbData'] = $this->Invoice_model->loadAccountCmb();
//        echo '<pre>'; print_r($data['accountCmbData']); exit();
        $data['userName'] = $_SESSION['session_user_data']['userName'];

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('customized_forms/quotation/Quatation_update');
        $this->load->view('template/footer');
    }

    public function update_quotation()
    {
//        exit('hh');
        $id = $this->input->post('id');
        //  exit($id);
        $result = $this->Job_order_model->updateFormQuotation($id);

        if ($result) {
//                    $this->session->set_flashdata("success_msg", "Submitted successfully!.");
            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con'));

        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");

            redirect(base_url('JobTicket1_con/load_quotation_form'));
        }
    }

    /*Starting of Job Ticket2 Form*/
    /*2017-07-03*/

    public function load_jobTicket2_form()
    {

        $data['itemCmbData'] = $this->Invoice_model->loadItemCodeCmb22();
        $data['customerList'] = $this->Invoice_model->loadCustomer();
//        $data['serialNo'] = $this->Job_order_model->GenarateSerialNoforJobTicket2();
        $data['serialNo'] = $this->Form_serial_model_withaccnme->getRealSerialNumber("jobTicket2",'Account Receivable');
        // echo '<pre>'; print_r($data['itemCmbData']); exit();
        $data['userName'] = $_SESSION['session_user_data']['userName'];

        if ($this->viewper[0]->cmzdjt02_ == 1) {

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('customized_forms/job_ticket02/JobTicket_add2');
        $this->load->view('template/footer');

        } else {
            $this->permissionError();
            return false;
        }


    }

    public function submitFormJB2()
    {
        // $t = $_POST; echo "<pre>"; print_r($t); exit();
        $btn_type = $this->input->post('btn_type');
        if ($btn_type == 'sv_c') {
            if ($this->saveper[0]->cmzdjo02_ == 1) {

            $this->save_and_closeJB2();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($btn_type == 'sv_nw') {
            if ($this->saveper[0]->cmzdjo02_ == 1) {

            $this->save_and_newJB2();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($btn_type == 'reset') {
            $this->reset_pageJB2();
        }
        if ($btn_type == 'update') {
            if ($this->editper[0]->cmzdjo02_ == 1) {

            $this->update_dataJB2();

            } else {
                $this->permissionError();
                return false;
            }
        }
        if ($btn_type == 'update_print') {

            if ($this->editper[0]->cmzdjo02_ == 1 && $this->printper[0]->cmzdjo02_ == 1) {

            $id = $this->input->post('id');
            //  exit($id);
            $result = $this->Job_order_model->updateData2($id);
            if ($result) {
                $this->printJobTicktTwo();
            } else {
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
                redirect(base_url('JobTicket1_con'));
            }

            } else {
                $this->permissionError();
                return false;
            }

        }
        if ($btn_type == 'update_only_print') {

        $id = $this->input->post('id');
            if ($this->printper[0]->cmzdjo02_ == 1) {

            $this->printJobTicktTwo();

            } else {
                $this->permissionError();
                return false;
            }

    }
        if ($btn_type == 'print_preview') {
            if ($this->saveper[0]->cmzdjo02_ == 1 && $this->printper[0]->cmzdjo02_ == 1) {

            $result = $this->Job_order_model->insertJobTicketData2();
            if ($result) {

                $this->printJobTicktTwo();
            } else {
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
                redirect(base_url('JobTicket1_con'));
            }

            } else {
                $this->permissionError();
                return false;
            }

        }
    }

    public function printJobTicktTwo()
    {


        $data['res1'] = array(
            'serialno' => $this->input->post('serialNo'),
            'cusName' => $this->input->post('venName'),
            'jb_no' => $this->input->post('jb_no'),
            'po_no' => $this->input->post('po_no_txt'),
            'deli_date' => $this->input->post('dueDT'),
            'date' => $this->input->post('date'),
            'ref_no' => $this->input->post('quo_for_Txt'),
            'user' => $_SESSION['session_user_data']['userName'],
            'datetime' => date('Y-m-d H:i:s'),
        );

        $numRow = $this->input->post('rowCount');

        for ($i = 0; $i < $numRow; $i++) {

            $style = $this->input->post('style_no_txt' . $i);
            $size = $this->input->post('size_txt' . $i);
            $item = $this->input->post('itemCode_se' . $i);
//            if(isset($this->input->post('itemCode_se' . $i)))

            $data['table'][$i] = array(
                'item' => $item,
                'sup_no' => $this->input->post('sup_no_txt' . $i),
                'style_no' => $style,
                'barcode' => $this->input->post('barcode_txt' . $i),
                'size' => $size,
                'price' => $this->input->post('price_txt' . $i),
                'qty' => $this->input->post('qty_txt' . $i),
                'cut_sheets' => $this->input->post('cut_sheet_txt' . $i),
                'colour' => $this->input->post('colour_txt' . $i),
                'pak_1' => $this->input->post('pack1_txt' . $i),
                'pak_2' => $this->input->post('pack2_txt' . $i),

            );

        }
        $this->session->set_userdata('pass_data', $data);
        $this->load->view("customized_forms/job_ticket02/jobTicket2Print", $data);
    }

    public function update_dataJB2()
    {
        //  $t = $_POST; echo "<pre>"; print_r($t); exit();
        $id = $this->input->post('id');
        //  exit($id);
        $result = $this->Job_order_model->updateData2($id);
        if ($result) {

            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con'));
//                redirect(base_url('Invoice_control/LoadAddNewAccountView'));
        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
            redirect(base_url('JobTicket1_con'));
        }

    }

    public function save_and_closeJB2()
    {
        // exit('go');
        $result = $this->Job_order_model->insertJobTicketData2();
        if ($result) {

            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con'));
//                redirect(base_url('Invoice_control/LoadAddNewAccountView'));
        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
            redirect(base_url('JobTicket1_con'));
        }

    }

    public function save_and_newJB2()
    {
        // exit('go');
        $result = $this->Job_order_model->insertJobTicketData2();
        if ($result) {

            $this->session->set_flashdata("success_msg", "Submitted successfully!.");

            redirect(base_url('JobTicket1_con/load_jobTicket2_form'));
//                redirect(base_url('Invoice_control/LoadAddNewAccountView'));
        } else {
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
//                redirect(base_url('Customer_List_Control/LoadCustomerView'));
//                $this->index();
            redirect(base_url('JobTicket1_con/load_jobTicket2_form'));
        }

    }

    public function reset_pageJB2()
    {
        $this->load_jobTicket2_form();
    }

    public function select_updateJB2($id)
    {
        //  exit($id);
        $data['itemCmbData'] = $this->Job_order_model->loadItemCodeCmbInven();
        $data['customerList'] = $this->Invoice_model->loadCustomer();
        $data['jobTicket2_Header'] = $this->Job_order_model->get_headerJB2($id);
        $data['jobTicket2_Details'] = $this->Job_order_model->get_detailsJB2($id);
//        $data['JBO2_serial'] = $this->Job_order_model->get_JBO2_serial($id);
        //  echo '<pre>'; print_r($data['itemCmbData']); exit();

        if ($this->editper[0]->cmzdjo02_ == 1) {

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('customized_forms/job_ticket02/JobTicket_update2');
        $this->load->view('template/footer');

        } else {
            $this->permissionError();
            return false;
        }

    }


    public function postUpdateDataToPrintView()
    {


        $state = $this->input->post('status');
        $close = $this->input->post('Close');
        if ($state = '' || 'Add New') {
            $status = '';
        } else {
            $status = $this->input->post('status');
        }
        if (isset($close) == 'chk') {
            $closed = 1;
        } else {
            $closed = 0;
        }


//        if ($this->validate_form('insert')) {
        $result = true;
        $result = $this->Job_order_model->insertDataQuotation();
        if ($result) {
            $data['res1'] = array(
                'serialno' => $this->input->post('serialNo'),
                'rowCount' => $this->input->post('rowCount'),
                'id' => $this->input->post('id'),
                'status' => $this->input->post('status'),
                'serialNo' => $this->input->post('serialno'),
                'venName' => $this->input->post('venName'),
                'attent_txt' => $this->input->post('attent_txt'),
                'address' => $this->input->post('address'),
                'quo_for_Txt' => $this->input->post('quo_for_Txt'),
                'date' => $this->input->post('date'),
                'job_type' => $this->input->post('radio2'),

            );

            $data['cartoon'] = array(
                'car_itemName' => $this->input->post('item_cartoon'),
                'car_colourNo' => $this->input->post('colour_select_cartoon'),
                'car_uv' => $this->input->post('uv'),
                'car_laminating' => $this->input->post('laminating'),
                'car_foiling' => $this->input->post('foiling'),
                'car_dieCutting' => $this->input->post('die_cutting'),
                'car_posting' => $this->input->post('posting'),
                'car_embossing' => $this->input->post('embossing'),
                'car_spotUv' => $this->input->post('spot_uv'),
                'car_pasting' => $this->input->post('pasting'),
                'car_embossingNew' => $this->input->post('embossingNew'),
                'car_op_vanish' => $this->input->post('op_vanish'),
                'car_matt_varnish' => $this->input->post('matt_varnish'),
                'car_gloss_varnish' => $this->input->post('gloss_varnish'),
                'car_b_side_print' => $this->input->post('both_side_printing'),
                'car_waterbase_varnish' => $this->input->post('waterbase_varnish'),
                'colour_select_cartoon' => $this->input->post('colour_select_cartoon'),

            );
            $data['books'] = array(
                'b_itemName' => $this->input->post('books_customer'),
                'b_pages' => $this->input->post('no_of_pages'),
                'b_colourNo' => $this->input->post('books_colours'),
                'b_uv' => $this->input->post('books_uv'),
                'b_laminating' => $this->input->post('books_laminating'),
                'b_foiling' => $this->input->post('books_foiling'),
                'b_dieCutting' => $this->input->post('books_die_cutting'),
                'b_posting' => $this->input->post('books_posting'),
                'b_embossing' => $this->input->post('books_embossing'),
                'b_spotUv' => $this->input->post('books_spot_uv'),
                'b_pasting' => $this->input->post('books_pasting'),
                'b_doubleSidePrinting' => $this->input->post('books_doubleSidePrint'),
                'b_embossingNew' => $this->input->post('books_embossingNew'),
                'b_op_vanish' => $this->input->post('books_op_vanish'),
                'b_matt_varnish' => $this->input->post('books_matt_varnish'),
                'b_gloss_varnish' => $this->input->post('books_gloss_varnish'),
                'b_perfect_binding' => $this->input->post('books_perfect_binding'),
                'b_center_wire' => $this->input->post('books_center_wire'),
                'b_waterbase_varnish' => $this->input->post('books_waterbase_varnish'),
                'i_itemName' => $this->input->post('inner_customer'),
                'i_pages' => $this->input->post('no_of_pages_inner'),
                'i_colourNo' => $this->input->post('inner_no_colours'),
                'i_uv' => $this->input->post('booksinner_uv'),
                'i_laminaing' => $this->input->post('booksinner_laminating'),
                'i_foiling' => $this->input->post('booksinner_foiling'),
                'i_dieCutting' => $this->input->post('booksinner_die_cutting'),
                'i_posting' => $this->input->post('booksinner_posting'),
                'i_embossing' => $this->input->post('booksinner_embossing'),
                'i_spotUv' => $this->input->post('booksinner_spot_uv'),
                'i_pasting' => $this->input->post('booksinner_pasting'),
                'i_doubleSidePrinting' => $this->input->post('booksinner_doubleSidePrint'),
                'i_embossingNew' => $this->input->post('booksinner_embossingNew'),
                'i_op_vanish' => $this->input->post('booksinner_op_vanish'),
                'i_matt_varnish' => $this->input->post('booksinner_matt_varnish'),
                'i_gloss_varnish' => $this->input->post('booksinner_gloss_varnish'),
                'i_perfect_binding' => $this->input->post('booksinner_perfect_binding'),
                'i_center_wire' => $this->input->post('booksinner_center_wire'),
                'i_waterbase_varnish' => $this->input->post('booksinner_waterbase_varnish'),

            );


            $numRow = $this->input->post('rowCount');
            //exit($numRow );
            for ($i = 0; $i < ($numRow); $i++) {
                $count = $this->input->post('itemCode_se' . $i);
                if (!empty($count)) {
//                    if ($this->input->post('itemCode_se' . $i) != '') {
                    $data['res2'][$i] = array(
                        'itemCode_se' => $count,
                        'desc_td' => $this->input->post('desc_td' . $i),
                        'qty_txt' => $this->input->post('qty_txt' . $i),
                        'rate_txt' => (float)str_replace(',', '', $this->input->post('rate_txt' . $i)),

                    );
                }
            }
                $data['res3'] = array(
                'rowCount' => $this->input->post('rowCount'),
                'id' => $this->input->post('id'),
                'status' => $this->input->post('status'),
                'books_customer' => $this->input->post('books_customer'),
                'inner_no_colours' => $this->input->post('inner_no_colours'),
                'inner_customer' => $this->input->post('inner_customer'),
                'no_of_pages_inner' => $this->input->post('no_of_pages_inner'),
                'memo' => $this->input->post('memo'),

            );
            
            $cmp = $this->input->post('printStatus');
            if ($cmp == 'NonTax') {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("Job_Ticket_print1", $data);
            } elseif ($cmp == 'VatNbt') {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("Job_Ticket_print2", $data);

            } elseif ($cmp == 'Svat') {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("Job_Ticket_print3", $data);

            }elseif ($cmp == 'usdPrint') {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("usd_quota_print", $data);

            } else {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("Job_Ticket_print4", $data);

            }
        }
//        }
    }
//by yeshika
    public function postUpdateDataToPrintView1()
    {


        $state = $this->input->post('status');
        $close = $this->input->post('Close');
        if ($state = '' || 'Add New') {
            $status = '';
        } else {
            $status = $this->input->post('status');
        }
        if (isset($close) == 'chk') {
            $closed = 1;
        } else {
            $closed = 0;
        }
        $id = $this->input->post('id');

        $loading_statusJB1 = $this->input->post('loading_statusJB1');

        if($loading_statusJB1 == '1'){
            $result = true;
        }else{

        $result = $this->Job_order_model->updateFormQuotation($id);
        }

        if ($result) {
            $data['res1'] = array(
                'serialno' => $this->input->post('serialNo'),
                'rowCount' => $this->input->post('rowCount'),
                'id' => $this->input->post('id'),
                'status' => $this->input->post('status'),
                'serialNo' => $this->input->post('serialno'),
                'venName' => $this->input->post('cusName1'),
                'attent_txt' => $this->input->post('attent_txt'),
                'address' => $this->input->post('address'),
                'quo_for_Txt' => $this->input->post('quo_for_Txt'),
                'date' => $this->input->post('date'),
                'job_type' => $this->input->post('radio2'),

            );

            $data['cartoon'] = array(
                'car_itemName' => $this->input->post('item_cartoon'),
                'car_colourNo' => $this->input->post('colour_select_cartoon'),
                'car_uv' => $this->input->post('uv'),
                'car_laminating' => $this->input->post('laminating'),
                'car_foiling' => $this->input->post('foiling'),
                'car_dieCutting' => $this->input->post('die_cutting'),
                'car_posting' => $this->input->post('posting'),
                'car_embossing' => $this->input->post('embossing'),
                'car_spotUv' => $this->input->post('spot_uv'),
                'car_pasting' => $this->input->post('pasting'),
                'car_embossingNew' => $this->input->post('embossingNew'),
                'car_op_vanish' => $this->input->post('op_vanish'),
                'car_matt_varnish' => $this->input->post('matt_varnish'),
                'car_gloss_varnish' => $this->input->post('gloss_varnish'),
                'car_b_side_print' => $this->input->post('both_side_printing'),
                'car_waterbase_varnish' => $this->input->post('waterbase_varnish'),
                'colour_select_cartoon' => $this->input->post('colour_select_cartoon'),

            );
            $data['books'] = array(
                'b_itemName' => $this->input->post('books_customer'),
                'b_pages' => $this->input->post('no_of_pages'),
                'b_colourNo' => $this->input->post('books_colours'),
                'b_uv' => $this->input->post('books_uv'),
                'b_laminating' => $this->input->post('books_laminating'),
                'b_foiling' => $this->input->post('books_foiling'),
                'b_dieCutting' => $this->input->post('books_die_cutting'),
                'b_posting' => $this->input->post('books_posting'),
                'b_embossing' => $this->input->post('books_embossing'),
                'b_spotUv' => $this->input->post('books_spot_uv'),
                'b_pasting' => $this->input->post('books_pasting'),
                'b_doubleSidePrinting' => $this->input->post('books_doubleSidePrint'),
                'b_embossingNew' => $this->input->post('books_embossingNew'),
                'b_op_vanish' => $this->input->post('books_op_vanish'),
                'b_matt_varnish' => $this->input->post('books_matt_varnish'),
                'b_gloss_varnish' => $this->input->post('books_gloss_varnish'),
                'b_perfect_binding' => $this->input->post('books_perfect_binding'),
                'b_center_wire' => $this->input->post('books_center_wire'),
                'b_waterbase_varnish' => $this->input->post('books_waterbase_varnish'),
                'i_itemName' => $this->input->post('inner_customer'),
                'i_pages' => $this->input->post('no_of_pages_inner'),
                'i_colourNo' => $this->input->post('inner_no_colours'),
                'i_uv' => $this->input->post('booksinner_uv'),
                'i_laminaing' => $this->input->post('booksinner_laminating'),
                'i_foiling' => $this->input->post('booksinner_foiling'),
                'i_dieCutting' => $this->input->post('booksinner_die_cutting'),
                'i_posting' => $this->input->post('booksinner_posting'),
                'i_embossing' => $this->input->post('booksinner_embossing'),
                'i_spotUv' => $this->input->post('booksinner_spot_uv'),
                'i_pasting' => $this->input->post('booksinner_pasting'),
                'i_doubleSidePrinting' => $this->input->post('booksinner_doubleSidePrint'),
                'i_embossingNew' => $this->input->post('booksinner_embossingNew'),
                'i_op_vanish' => $this->input->post('booksinner_op_vanish'),
                'i_matt_varnish' => $this->input->post('booksinner_matt_varnish'),
                'i_gloss_varnish' => $this->input->post('booksinner_gloss_varnish'),
                'i_perfect_binding' => $this->input->post('booksinner_perfect_binding'),
                'i_center_wire' => $this->input->post('booksinner_center_wire'),
                'i_waterbase_varnish' => $this->input->post('booksinner_waterbase_varnish'),

            );


//            print_r($data);

            $numRow = $this->input->post('rowCount');
//            exit($numRow );
            for ($i = 0; $i < ($numRow); $i++) {
                $count = $this->input->post('itemCode_se' . $i);
                if ($this->input->post('itemCode_se' . $i) != '') {
                    $data['res2'][$i] = array(
                        'itemCode_se' => $this->input->post('itemCode_se' . $i),
                        'desc_td' => $this->input->post('desc_td' . $i),
                        'qty_txt' => $this->input->post('qty_txt' . $i),
                        'rate_txt' => (float)str_replace(',', '', $this->input->post('rate_txt' . $i)),

                    );
                }
            }

            $data['res3'] = array(
                'rowCount' => $this->input->post('rowCount'),
                'id' => $this->input->post('id'),
                'status' => $this->input->post('status'),
                'books_customer' => $this->input->post('books_customer'),
                'inner_no_colours' => $this->input->post('inner_no_colours'),
                'inner_customer' => $this->input->post('inner_customer'),
                'no_of_pages_inner' => $this->input->post('no_of_pages_inner'),
                'memo' => $this->input->post('memo'),

            );


            $cmp = $this->input->post('print');
           // die($cmp);
            if ($cmp == 'NonTax') {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("Job_Ticket_print1", $data);
            } elseif ($cmp == 'VatNbt') {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("Job_Ticket_print2", $data);

            } elseif ($cmp == 'Svat') {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("Job_Ticket_print3", $data);

            }elseif ($cmp == 'usdPrint') {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("usd_quota_print", $data);

            }  else {
                $data['header'] = $this->Job_order_model->getHeaderData();
                $this->session->set_userdata('pass_data', $data);
                $this->load->view("Job_Ticket_print4", $data);

            }
        }
//        }
    }


    public function getJobOrderList()
    {
        $datas["result"] = $this->Job_order_model->getJobOrderList();
        $datas['show'] = "list";
        $this->load->view("customized_forms/job_ticket01/jobOrder01_for_jobTicket01", $datas);
    }

    function getJobOrderRows()
    {
//exit('gdfgdgdgdfg');
        $id = $this->input->post("id");

        $datas['headerJobrow'] = $this->Job_order_model->getSelect1($id);
//        $datas['jobTicket_table'] = $this->Job_order_model->getSelect2($id);
        $datas['jobTicket_table'] = $this->Job_order_model->getSelect2ForLoadToJT1($id);
        $datas['footerJob'] = $this->Job_order_model->getSelect3($id);
        $datas['JBO1_tbl_mid'] = $this->Job_order_model->getJBO1_tbl_mid($id);
//        $datas['JBO1_tbl_detail'] = $this->Job_order_model->getJBO1_tbl_detail($id);
//        echo "<pre>"; print_r($datas['headerJobrow']); exit();
        $this->load->model('Preference_model');
        $datas['cusHList'] = $this->Preference_model->getPrefHeaderForm("invoice");

        $datas['accountCmbData'] = $this->Job_order_model->loadAccountCmb();

        $datas['unitList'] = $this->Job_order_model->loadUnitList2();

        $datas['serialNo'] = $this->Form_serial_model->getRealSerialNumber("Invoice");
        $datas['itemCmbData'] = $this->Job_order_model->loadItemCodeCmbInven();
        $datas['customerList'] = $this->Invoice_model->loadCustomer();
        $datas['serialNo'] = $this->Job_order_model->GenarateSerialNoforJobTicket();
        // echo '<pre>'; print_r($data['itemCmbData']); exit();
        $datas['userName'] = $_SESSION['session_user_data']['userName'];
        $datas['terms'] = $this->Job_order_model->loadTerms();
        $datas['cheakBy'] = $this->Job_order_model->loadCheakBy();
        $datas['byer'] = $this->Job_order_model->loadByer();
        $datas['customerList'] = $this->Job_order_model->loadCustomer();
        $datas['jobNo'] = $this->Job_order_model->loadJobNo();
        $datas['siteList'] = $this->Job_order_model->loadSite();
        $datas['classList'] = $this->Job_order_model->loadClass();
        $datas['numberstoBox'] = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');

        $datas['show'] = "header";
        $this->load->view("customized_forms/job_ticket01/jobOrder01_for_jobTicket01", $datas);


        $datas['show'] = "table";
        $this->load->view("customized_forms/job_ticket01/jobOrder01_for_jobTicket01", $datas);

    }

    public function Delete($id)
    {
        if ($this->deleteper[0]->joborder == 1) {
        } else {
            $this->permissionError();
            return false;
        }
//        if($this->deleteper[0]->purchaseordervender==1){
        $result = $this->Job_order_model->deleteJT2Data($id);
        if ($result) {

            $this->session->set_flashdata("success_msg", "Deleted successfully!.");
            redirect(base_url('JobTicket1_con'));
        } else {

            $this->session->set_flashdata("error_msg", "Unable to Delete. Please try again.");
            redirect(base_url('JobTicket1_con'));
        }
//             }else{$this->permissionError(); }

    }

    public function DeleteQuota($id){

        if ($this->deleteper[0]->cmzdquota == 1) {
        } else {
            $this->permissionError();
            return false;
        }
//        if($this->deleteper[0]->purchaseordervender==1){
        $result = $this->Job_order_model->DeleteQuota($id);
        if ($result) {

            $this->session->set_flashdata("success_msg", "Deleted successfully!.");
            redirect(base_url('JobTicket1_con'));
        } else {

            $this->session->set_flashdata("error_msg", "Unable to Delete. Please try again.");
            redirect(base_url('JobTicket1_con'));
        }

    }

    public function DeleteJT1($id){

        if ($this->deleteper[0]->cmzdjo01_ == 1) {
        } else {
            $this->permissionError();
            return false;
        }
//        if($this->deleteper[0]->purchaseordervender==1){
        $result = $this->Job_order_model->DeleteJT1($id);
        if ($result) {

            $this->session->set_flashdata("success_msg", "Deleted successfully!.");
            redirect(base_url('JobTicket1_con'));
        } else {

            $this->session->set_flashdata("error_msg", "Unable to Delete. Please try again.");
            redirect(base_url('JobTicket1_con'));
        }

    }

}