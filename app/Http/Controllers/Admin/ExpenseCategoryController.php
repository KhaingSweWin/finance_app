<?php

namespace App\Http\Controllers\Admin;

use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExpenseCategoryRequest;
use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('expense_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseCategories = ExpenseCategory::all();

        return view('admin.expenseCategories.index', compact('expenseCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('expense_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $parent_categories=ExpenseCategory::where('parent',0)->get();
        //dd($parent_categories);
        return view('admin.expenseCategories.create',['parent'=>$parent_categories]);
    }

    public function store(StoreExpenseCategoryRequest $request)
    {
        //dd($request->all());
        $expenseCategory = ExpenseCategory::create($request->all());

        return redirect()->route('admin.expense-categories.index');
    }

    public function edit(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseCategory->load('created_by');
        $parent_categories=ExpenseCategory::where('parent',0)->get();

        return view('admin.expenseCategories.edit', compact('expenseCategory','parent_categories'));
    }

    public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        $expenseCategory->update($request->all());

        return redirect()->route('admin.expense-categories.index');
    }

    public function show(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseCategory->load('created_by');

        return view('admin.expenseCategories.show', compact('expenseCategory'));
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sub_categories=ExpenseCategory::where('parent',$expenseCategory->id)->get();
        //dd($sub_categories);
        if($sub_categories->count()==0)
            $expenseCategory->delete();
        return back();
    }

    public function massDestroy(MassDestroyExpenseCategoryRequest $request)
    {
        ExpenseCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
