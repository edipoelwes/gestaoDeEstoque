<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $expenses = Expense::where([
         ['company_id', Auth::user()->company_id],
      ])->get();

      return view('admin.expenses.index', [
         'expenses' => $expenses,
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.expenses.form');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $request['company_id'] = Auth::user()->company_id;
      $request['user_id'] = Auth::user()->id;

      $expense = Expense::create($request->all());

      return redirect()->route('expenses.edit', [
         'expense' => $expense->id,
      ])->withToastSuccess('Retirada cadastrada com sucesso!');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $detail = Expense::where([['id', $id], ['company_id', Auth::user()->company_id]])->first();

      return view('admin.expenses.details', [
         'detail' => $detail,
      ]);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(Expense $expense)
   {
      return view('admin.expenses.form', [
         'expense' => $expense,
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Expense $expense)
   {
      $expense->update($request->all());

      return redirect()->route('expenses.index', [
         'expense' => $expense->id,
      ])->withToastSuccess('Retirada atualizada com sucesso!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Expense $expense)
   {
      $expense->delete();
      return back()->withToastSuccess('Retirada removida com sucesso!');
   }

   public function changeStatus(Request $request, $id)
   {
      $st = $request->only('status');
      $status = Expense::find($id);
      $status->status = $st['status'];
      $status->save();

      return redirect()->route('expenses.show', [
         'expense' => $id,
      ])->withToastSuccess('Status atualizado com sucesso!');
   }
}
