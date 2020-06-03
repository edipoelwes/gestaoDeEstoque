@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-user-plus">
         {{ isset($company->id) ? 'Editar Empresa' : 'Cadastrar Nova Empresa' }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('users.index') }}">Clientes</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('root.companies.index') }}" class="text-orange">Empresas</a></li>
            </ul>
         </nav>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         @if(! isset($company))
            <form action="{{ route('root.companies.store') }}" method="post" class="app_form"
               enctype="multipart/form-data">
            @else
               <form
                  action="{{ route('root.companies.update', ['company' => $company->id]) }}"
                  method="post" class="app_form" enctype="multipart/form-data">
                  @method('PUT')
         @endif
         @csrf

         <label class="label">
            <span class="legend">*Razão Social:</span>
            <input type="text" name="social_name" placeholder="Razão Social"
               value="{{ old('social_name', $company->social_name ?? null) }}" />

            @error('social_name')
               <span class="message-color" role="alert">
                  <p class="icon-asterisk">{{ $message }}</p>
               </span>
            @enderror
         </label>

         <label class="label">
            <span class="legend">Nome Fantasia:</span>
            <input type="text" name="alias_name" placeholder="Nome Fantasia"
               value="{{ old('alias_name', $company->alias_name ?? null) }}" />

            @error('alias_name')
               <span class="message-color" role="alert">
                  <p class="icon-asterisk">{{ $message }}</p>
               </span>
            @enderror
         </label>

         <div class="label_g2">
            <label class="label">
               <span class="legend">CNPJ:</span>
               <input type="tel" name="document_company" class="mask-cnpj" placeholder="CNPJ da Empresa"
                  value="{{ old('document_company', $company->document_company ?? null) }}" />

               @error('document_company')
                  <span class="message-color" role="alert">
                     <p class="icon-asterisk">{{ $message }}</p>
                  </span>
               @enderror
            </label>

            <label class="label">
               <span class="legend">Inscrição Estadual:</span>
               <input type="text" name="document_company_secondary" placeholder="Número da Inscrição"
                  value="{{ old('document_company_secondary', $company->document_company_secondary ?? null) }}" />

               @error('document_company_secondary')
                  <span class="message-color" role="alert">
                     <p class="icon-asterisk">{{ $message }}</p>
                  </span>
               @enderror
            </label>
         </div>

         <div class="app_collapse">
            <div class="app_collapse_header mt-2 collapse">
               <h3>Endereço</h3>
               <span class="icon-minus-circle icon-notext"></span>
            </div>

            <div class="app_collapse_content">
               <div class="label_g2">
                  <label class="label">
                     <span class="legend">*CEP:</span>
                     <input type="tel" name="zipcode" class="mask-zipcode zip_code_search" placeholder="Digite o CEP"
                        value="{{ old('zipcode', $company->zipcode ?? null) }}" />

                     @error('zipcode')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                     @enderror
                  </label>
               </div>

               <label class="label">
                  <span class="legend">*Endereço:</span>
                  <input type="text" name="street" class="street" placeholder="Endereço Completo"
                     value="{{ old('street', $company->street ?? null) }}" />

                  @error('street')
                     <span class="message-color" role="alert">
                        <p class="icon-asterisk">{{ $message }}</p>
                     </span>
                  @enderror
               </label>

               <div class="label_g2">
                  <label class="label">
                     <span class="legend">*Número:</span>
                     <input type="text" name="number" placeholder="Número do Endereço"
                        value="{{ old('number', $company->number ?? null) }}" />

                     @error('number')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                     @enderror
                  </label>

                  <label class="label">
                     <span class="legend">Complemento:</span>
                     <input type="text" name="complement" placeholder="Completo (Opcional)"
                        value="{{ old('complement', $company->complement ?? null) }}" />

                     @error('complement')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                     @enderror
                  </label>
               </div>

               <label class="label">
                  <span class="legend">*Bairro:</span>
                  <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro"
                     value="{{ old('neighborhood', $company->neighborhood ?? null) }}" />

                  @error('neighborhood')
                     <span class="message-color" role="alert">
                        <p class="icon-asterisk">{{ $message }}</p>
                     </span>
                  @enderror
               </label>

               <div class="label_g2">
                  <label class="label">
                     <span class="legend">*Estado:</span>
                     <input type="text" name="state" class="state" placeholder="Estado"
                        value="{{ old('state', $company->state ?? null) }}" />

                     @error('state')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                     @enderror
                  </label>

                  <label class="label">
                     <span class="legend">*Cidade:</span>
                     <input type="text" name="city" class="city" placeholder="Cidade"
                        value="{{ old('city', $company->city ?? null) }}" />

                     @error('city')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                     @enderror
                  </label>
               </div>
            </div>
         </div>

         @if( isset($company))
            <div class="text-right mt-2">
               <button class="btn btn-large btn-green icon-check-square-o" type="submit">Atualizar Empresa</button>
            </div>
         @else
            <div class="text-right mt-2">
               <button class="btn btn-large btn-green icon-check-square-o" type="submit">Cadastrar Empresa</button>
            </div>
         @endif
         </form>
      </div>
   </div>
</section>
@endsection
