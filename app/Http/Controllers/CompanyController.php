<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\CompanyAddress;

class CompanyController extends Controller
{
  // Retorna todas as empresas
  public function index()
  {
    $companies = Company::with('addresses')->get();
    return response()->json($companies);
  }

  public function store(StoreCompanyRequest $request)
  {
      // Cria a empresa
      $company = Company::create($request->only([
          'user_id',
          'department_id',
          'name',
          'description',
          'email',
          'cnpj',
          'phone',
          'phone_alternative',
          'whatsapp',
      ]));

      // Cria o endereço da empresa
      $companyAddress = CompanyAddress::create([
          'company_id' => $company->id,
          'address_line_1' => $request->address_line_1,
          'address_line_2' => $request->address_line_2,
          'city' => $request->city,
          'state' => $request->state,
          'postal_code' => $request->postal_code,
      ]);

      // Carrega a relação com o endereço
      $company->load('addresses');

      return response()->json($company, 201);
  }

  // Retorna uma empresa específica
  public function show($id)
  {
    $company = Company::with('addresses')->findOrFail($id);
    return response()->json($company);
  }

  // Atualiza uma empresa existente
  public function update(UpdateCompanyRequest $request, $id)
  {    

    $company = Company::findOrFail($id);

    $company->update($request->only([
        'user_id',
        'department_id',
        'name',
        'description',
        'email',
        'cnpj',
        'phone',
        'phone_alternative',
        'whatsapp',
    ]));

    // Atualiza o endereço da empresa
    $companyAddress = $company->addresses;

    $companyAddress->update([
        'address_line_1' => $request->address_line_1,
        'address_line_2' => $request->address_line_2,
        'city' => $request->city,
        'state' => $request->state,
        'postal_code' => $request->postal_code,
    ]);

    // Carrega a relação com o endereço
    $company->load('addresses');

    return response()->json($company, 200);
  }

  // Exclui uma empresa
  public function destroy($id)
  {
    $company = Company::findOrFail($id);

    // Exclui a empresa
    $company->delete();

    return response()->json(null, 204);
  }
}
