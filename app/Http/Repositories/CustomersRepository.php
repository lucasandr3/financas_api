<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\CustomersRepositoryInterface;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Helpers\Constants;

class CustomersRepository implements CustomersRepositoryInterface
{

    public function getAllCustomers()
    {
        return DB::table('customers as c')
            ->addSelect('c.id','c.full_name', 'c.name_alias', 'c.document', 'c.phone', 'c.email', 'c.zipcode')
            ->addSelect('c.street', 'c.number', 'c.neighborhood', 'c.city', 'c.state', 'c.tag', 'c.score', 'c.type')
            ->addSelect('u.full_name as user')
            ->addSelect('ct.tag')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('customers_tags as ct', 'c.tag', '=', 'ct.id')
            ->get()
        ->toArray();
    }

    public function getCustomerById(int $customer)
    {
        return DB::table('customers as c')
            ->addSelect('c.id','c.full_name', 'c.name_alias', 'c.document', 'c.phone', 'c.email', 'c.zipcode')
            ->addSelect('c.street', 'c.number', 'c.neighborhood', 'c.city', 'c.state', 'c.tag', 'c.score', 'c.type')
            ->addSelect('u.full_name as user')
            ->addSelect('ct.tag')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('customers_tags as ct', 'c.tag', '=', 'ct.id')
            ->where('c.id', $customer)
            ->get()
            ->toArray();
    }

    public function saveCustomer(object $request)
    {
        try {

            $newCustomer = new Customer;
            $newCustomer->full_name = $request->input('full_name');
            $newCustomer->name_alias = $request->input('name_alias');
            $newCustomer->document = $request->input('document');
            $newCustomer->phone = $request->input('phone');
            $newCustomer->email = $request->input('email');
            $newCustomer->zipcode = $request->input('zipcode');
            $newCustomer->street = $request->input('street');
            $newCustomer->number = $request->input('number');
            $newCustomer->neighborhood = $request->input('neighborhood');
            $newCustomer->city = $request->input('city');
            $newCustomer->state = $request->input('state');
            $newCustomer->tag = Constants::SEM_RESTRICAO;
            $newCustomer->score = Constants::SCORE;
            $newCustomer->type = $request->input('type');

            $newCustomer->save();
            return response()->json(['customer' => $newCustomer, 'message' => 'CREATED'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 200);
        }
    }

    public function updateCustomer(object $request, int $customer)
    {
        try {
            DB::beginTransaction();
            $editCustomer = Customer::find($customer);
            $editCustomer->full_name = ($request->input('full_name')) ? $request->input('full_name') : $editCustomer->full_name;
            $editCustomer->name_alias = ($request->input('name_alias')) ? $request->input('name_alias') : $editCustomer->name_alias;
            $editCustomer->document = ($request->input('document')) ? $request->input('document') : $editCustomer->document;
            $editCustomer->phone = ($request->input('phone')) ? $request->input('phone') : $editCustomer->phone;
            $editCustomer->email = ($request->input('email')) ? $request->input('email') : $editCustomer->email;
            $editCustomer->zipcode = ($request->input('zipcode')) ? $request->input('zipcode') : $editCustomer->zipcode;
            $editCustomer->street = ($request->input('street')) ? $request->input('street') : $editCustomer->street;
            $editCustomer->number = ($request->input('number')) ? $request->input('number') : $editCustomer->number;
            $editCustomer->neighborhood = ($request->input('neighborhood')) ? $request->input('neighborhood') : $editCustomer->neighborhood;
            $editCustomer->city = ($request->input('city')) ? $request->input('city') : $editCustomer->city;
            $editCustomer->state = ($request->input('state')) ? $request->input('state') : $editCustomer->state;
            $editCustomer->tag = ($request->input('tag')) ? $request->input('tag') : $editCustomer->tag;
            $editCustomer->score = ($request->input('score')) ? $request->input('score') : $editCustomer->score;
            $editCustomer->type = ($request->input('type')) ? $request->input('type') : $editCustomer->type;

            $editCustomer->save();
            DB::commit();
            return response()->json(['user' => $editCustomer, 'message' => 'UPDATED'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 200);
        }
    }

    public function getTotalExpensesByCustomer(int $customer)
    {
        return DB::table('expenses')
            ->where('customer', $customer)
            ->sum('value');
    }

    public function getExpensesByCustomer(int $customer)
    {
        return DB::table('expenses as e')
            ->addSelect('e.id', 'e.user_id', 'e.title', 'e.description', 'e.value', 'e.installments', 'e.quantity_installments', 'e.photo', 'e.date_expense')
            ->join('customers as c', 'c.id', '=', 'e.customer')
            ->where('e.customer', $customer)
            ->get()
            ->toArray();
    }

    public function getRevenuesByCustomer(int $customer)
    {
        return DB::table('revenues as r')
            ->addSelect('r.id', 'r.user_id', 'r.title', 'r.description', 'r.value', 'r.installments', 'r.quantity_installments', 'r.photo', 'r.date_revenue')
            ->join('customers as c', 'c.id', '=', 'r.customer')
            ->where('r.customer', $customer)
            ->get()
            ->toArray();
    }

    public function getInstallmentsByCustomerExpense(int $expense)
    {
        return DB::table('expense_installments as ei')
            ->select('ei.id', 'ei.installment', 'ei.value_installment', 'ei.pay')
            ->addSelect('e.value as total_expense', 'e.quantity_installments', 'e.title', 'e.description')
            ->join('expenses as e', 'e.id', '=', 'ei.expense')
            ->where('ei.expense', $expense)
            ->get()->toArray();
    }

    public function getInstallmentsByCustomerRevenue(int $revenue)
    {
        return DB::table('revenue_installments as ri')
            ->select('ri.id', 'ri.installment', 'ri.value_installment', 'ri.pay')
            ->addSelect('r.value as total_expense', 'r.quantity_installments', 'r.title', 'r.description')
            ->join('revenues as r', 'r.id', '=', 'ri.revenue')
            ->where('ri.revenue', $revenue)
            ->get()->toArray();
    }

    public function delCustomer(int $customer)
    {
        Customer::destroy($customer);
        return response()->json(['message' => 'Cliente descadastrado com sucesso!!'], 200);
    }
}
