
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function index()
    {
        //$_SESSION['login']=true;
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        if (isset($_SESSION['login'])) {
            redirect('/home');
        } else {

            $this->load->view('users/user_login');
            $this->load->view('users/login-5min');
        }
    }

    public function validatelogin()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($email == "") {
            echo "Your Login Email is not filled";
            return false;
        }
        if ($password == "") {
            echo "Your Password is not filled";
            return false;
        }

        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            $loginsuccess = true;
            $_SESSION['login'] = true;
            $data = $query->result();
            foreach ($data as $value) {
                $_SESSION['settings'] = $value->settings;
                $_SESSION['transactions'] = $value->transactions;
                $_SESSION['reports'] = $value->reports;
                $_SESSION['inventory'] = $value->inventory;
                $_SESSION['assignuser'] = $value->assignuser;
                $_SESSION['staffidno'] = $value->staffidno;
                $_SESSION['studentidno'] = $value->regno;
                $_SESSION['companycode'] = $value->companycode;
                //$_SESSION['staffidno']='EMP-009';

                //get employeedetails
                $this->db->where('employeeno', $value->staffidno);
                $query = $this->db->get('employee');
                $data = $query->result();
                foreach ($data as $valueemp) {
                    $_SESSION['staffidno'] = $valueemp->employeeno;
                    $_SESSION['username'] = $valueemp->firstname;
                    $_SESSION['photo'] = $valueemp->photo;
                }

                //get employee company settings
                $this->db->where('companycode', $value->companycode);
                $query = $this->db->get('company');
                $data = $query->result();
                foreach ($data as $valuecompany) {
                    // $_SESSION['CurrentPeriod']=$valuecompany->defaultperiod;
                    $_SESSION['companycode'] = $valuecompany->companycode;
                    $_SESSION['openningperiod'] = $valuecompany->startingperiod;
                    $_SESSION['openningdate'] = date('Y') . "-" . date('m-d', strtotime($valuecompany->openningdate));
                }

                $this->db->order_by('currentperiod', 'ASC');
                $this->db->limit(1);
                $query = $this->db->get('pcurrentperiod');
                $datap = $query->result();
                foreach ($datap as $period) {
                    $_SESSION['CurrentPeriod'] = $period->currentperiod;

                }

            }
            echo "Success";
            return false;
        } else {

            echo "Please Enter The Correct Password and Username, If You have Forgoten Your login Credentials, Kindly Click Forgot Password Link";
            return false;
        }

    }
}
