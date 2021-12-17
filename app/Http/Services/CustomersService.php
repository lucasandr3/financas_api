<?php

namespace App\Http\Services;

use App\Helpers\Constants;
use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\CustomersRepositoryInterface;
use App\Http\Interfaces\Services\CustomersServiceInterface;
use Illuminate\Support\Facades\Validator;

class CustomersService implements CustomersServiceInterface
{
    private $repository;

    public function __construct
    (
        CustomersRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function allCustomers()
    {
        $customers = $this->repository->getAllCustomers();

        $customers = array_map(function ($customer) {
            $customer->document = Helpers::formatDocument($customer->document);
            $customer->phone = Helpers::formatPhone($customer->phone);
            $customer->zipcode = ($customer->zipcode) ? Helpers::formatZipcode($customer->zipcode) : null;

            $totalExpenses = $this->repository->getTotalExpensesByCustomer($customer->id);
            $customer->total_expenses = ($totalExpenses) ? Helpers::formatMoney($totalExpenses) : 'R$ 0,00';

            return $customer;
        }, $customers);

        return response()->json(['data' => $customers], 200);
    }

    public function getCustomer(int $customer)
    {
        $customerObject = $this->repository->getCustomerById($customer);

        if (!sizeof($customerObject) > 0) {
            return response()->json(['message' => 'Cliente não Cadastrado!!'], 200);
        }

        $customerObject = array_map(function ($customerOBJ) {
            $customerOBJ->document = Helpers::formatDocument($customerOBJ->document);
            $customerOBJ->phone = Helpers::formatPhone($customerOBJ->phone);
            $customerOBJ->zipcode = ($customerOBJ->zipcode) ? Helpers::formatZipcode($customerOBJ->zipcode) : null;

            $totalExpenses = $this->repository->getTotalExpensesByCustomer($customerOBJ->id);
            $customerOBJ->total_expenses = ($totalExpenses) ? Helpers::formatMoney($totalExpenses) : 'R$ 0,00';

            return $customerOBJ;
        }, $customerObject);

        return response()->json(['data' => $customerObject], 200);
    }

    public function getExpenses(int $customer)
    {
        $customerObject = $this->repository->getCustomerById($customer);

        if (sizeof($customerObject) === 0) {
            return response()->json(['message' => 'Cliente não está cadastrado.'], 200);
        }

        $expenses = $this->getExpensesByCustomer($customerObject[0]->id);

        return response()->json($expenses, 201);
    }

    public function getRevenues(int $customer)
    {
        $customerObject = $this->repository->getCustomerById($customer);

        if (sizeof($customerObject) === 0) {
            return response()->json(['message' => 'Cliente não está cadastrado.'], 200);
        }

        $revenues = $this->getRevenuesByCustomer($customerObject[0]->id);

        return response()->json($revenues, 200);
    }

    public function newCustomer(object $resquest)
    {
        $validator = Validator::make($resquest->all(), [
            'full_name' => 'required|string',
            'document' => 'required',
            'phone' => 'required',
            'type' => 'required'
        ]);

        if (!$validator->fails()) {

            return $this->repository->saveCustomer($resquest);

        } else {
            return response()->json(['error' => $validator->errors()], 200);
        }
    }

    public function editCustomer(object $resquest, int $customer)
    {
        $customerObject = $this->repository->getCustomerById($customer);

        if (!sizeof($customerObject) > 0) {
            return response()->json(['message' => 'Cliente não Cadastrado!!'], 200);
        }

        $validator = Validator::make($resquest->all(), [
            'full_name' => 'required|string',
            'document' => 'required',
            'phone' => 'required',
            'type' => 'required'
        ]);

        if (!$validator->fails()) {

            $response = $this->repository->UpdateCustomer($resquest, $customer);

            if ($response) {
                return response()->json(['message' => 'Dados do cliente atualizados com sucesso!'], 200);
            } else {
                return response()->json(['message' => 'Erro ao atualizar dados do Cliente!'], 200);
            }

        } else {
            return response()->json(['error' => $validator->errors()], 200);
        }
    }

    private function getExpensesByCustomer(int $card)
    {
        $expenses = $this->repository->getExpensesByCustomer($card);

        $expenses = array_map(function ($expense) {
            $expense->value = Helpers::formatMoney($expense->value);
            $expense->installments = ($expense->installments === 0) ? 'Pagamento único' : 'Parcelado';

            $installmentsCardExpense = $this->getInstallmentsByCustomerExpense($expense->id);

            if ($expense->installments != Constants::SEM_PARCELA_STRING) {
                $expense->installments_object = $installmentsCardExpense;
            }

            $expense->photo = ($expense->photo) ? url('storage/' . $expense->photo) : null;
            return $expense;
        }, $expenses);

        return $expenses;
    }

    private function getRevenuesByCustomer(int $customer)
    {
        $revenues = $this->repository->getRevenuesByCustomer($customer);

        $revenues = array_map(function ($revenue) {
            $revenue->value = Helpers::formatMoney($revenue->value);
            $revenue->installments = ($revenue->installments === 0) ? 'Pagamento único' : 'Parcelado';

            $installmentsCustomerRevenue = $this->getInstallmentsByCustomerRevenue($revenue->id);

            if ($revenue->installments != Constants::SEM_PARCELA_STRING) {
                $revenue->installments_object = $installmentsCustomerRevenue;
            }

            $revenue->photo = ($revenue->photo) ? url('storage/' . $revenue->photo) : null;
            return $revenue;
        }, $revenues);

        return $revenues;
    }

    private function getInstallmentsByCustomerExpense(int $expense)
    {
        $installments = $this->repository->getInstallmentsByCustomerExpense($expense);

        if (!sizeof($installments) > 0) {
            return [];
        }

        $installments = array_map(function ($installment) {
            $installment->installment = $installment->installment . 'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            $installment->total_expense = Helpers::formatMoney($installment->total_expense);
            return $installment;
        }, $installments);

        return $installments;
    }

    private function getInstallmentsByCustomerRevenue(int $revenue)
    {
        $installments = $this->repository->getInstallmentsByCustomerRevenue($revenue);

        if (!sizeof($installments) > 0) {
            return [];
        }

        $installments = array_map(function ($installment) {
            $installment->installment = $installment->installment . 'ª' . ' Parcela';
            $installment->value_installment = Helpers::formatMoney($installment->value_installment);
            $installment->pay = Helpers::formatDateSimple($installment->pay);
            $installment->total_expense = Helpers::formatMoney($installment->total_expense);
            return $installment;
        }, $installments);

        return $installments;
    }

    public function deleteCustomer(int $customer)
    {
        $customerObject = $this->repository->getCustomerById($customer);

        if(!sizeof($customerObject) > 0) {
            return response()->json(['message' => 'Oopss, cliente não está cadastrado!!'], 200);
        }

        return $this->repository->delCustomer($customer);
    }
}
