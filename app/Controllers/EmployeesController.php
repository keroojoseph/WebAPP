<?php

namespace App\Controllers;

use App\Libs\Helper;
use App\Libs\InputFilter;
use App\Models\EmployeesModel;

class EmployeesController extends AbstractController
{
    use Helper, InputFilter;

    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('employees.default');
        $this->_data['employees'] = EmployeesModel::getAll();
        $this->_view();
    }

    public function addAction()
    {
        $this->_language->load('template.common');
        if (isset($_POST['submit'])) {
            $emp = new EmployeesModel;
            $emp->name = $this->filterString($_POST['name']);
            $emp->email = $this->filterString($_POST['email']);
            $emp->phone = $this->filterString($_POST['phone']);
            $emp->address = $this->filterString($_POST['address']);

            if ($emp->save()) {
                $_SESSION['message'] = 'employee added successfully';
                $this->redirect('/employees');
            }
        }
        $this->_view();
    }

    public function editAction()
    {
        $this->_language->load('template.common');
        $id = $this->filterInt($this->_params[0]);
        $emp = new EmployeesModel;
        $emp = $emp->getByPk($id);

        if ($emp === false) {
            $this->redirect('/employees');
        }

        $this->_data['employees'] = $emp;

        if (isset($_POST['submit'])) {
            $emp = new EmployeesModel;
            $emp->customer_id = $this->filterInt($id);
            $emp->name = $this->filterString($_POST['name']);
            $emp->email = $this->filterString($_POST['email']);
            $emp->phone = $this->filterString($_POST['phone']);
            $emp->address = $this->filterString($_POST['address']);

            if ($emp->save()) {
                $_SESSION['message'] = 'employee edited successfully';
                $this->redirect('/employees');
            }
        }
        $this->_view();
    }

    public function deleteAction()
    {
        $this->_language->load('template.common');
        $id = $this->filterInt($this->_params[0]);
        $emp = new EmployeesModel;
        $emp = $emp->getByPk($id);

        if ($emp === false) {
            $this->redirect('/employees');
        }

        if ($emp->delete()) {
            $_SESSION['message'] = 'employee deleted successfully';
            $this->redirect('/employees');
        }
    }
}