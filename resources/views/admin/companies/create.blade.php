@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-user-plus">Nova Empresa</h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('users.index') }}">Clientes</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('companies.index') }}" class="text-orange">Empresas</a></li>
            </ul>
         </nav>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <form class="app_form" action="{{ route('companies.store') }}" method="post">
            @csrf

            <label class="label">
               <span class="legend">*Razão Social:</span>
               <input type="text" name="social_name" placeholder="Razão Social" value="{{ old('social_name') }}" />

               @error('social_name')
               <span class="message-color" role="alert">
                  <p class="icon-asterisk">{{ $message }}</p>
               </span>
               @enderror
            </label>

            <label class="label">
               <span class="legend">Nome Fantasia:</span>
               <input type="text" name="alias_name" placeholder="Nome Fantasia" value="{{ old('alias_name') }}" />

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
                     value="{{ old('document_company') }}" />

                  @error('document_company')
                  <span class="message-color" role="alert">
                     <p class="icon-asterisk">{{ $message }}</p>
                  </span>
                  @enderror
               </label>

               <label class="label">
                  <span class="legend">Inscrição Estadual:</span>
                  <input type="text" name="document_company_secondary" placeholder="Número da Inscrição"
                     value="{{ old('document_company_secondary') }}" />

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
                           value="{{ old('zipcode') }}" />

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
                        value="{{ old('street') }}" />

                     @error('street')
                     <span class="message-color" role="alert">
                        <p class="icon-asterisk">{{ $message }}</p>
                     </span>
                     @enderror
                  </label>

                  <div class="label_g2">
                     <label class="label">
                        <span class="legend">*Número:</span>
                        <input type="text" name="number" placeholder="Número do Endereço" value="{{ old('number') }}" />

                        @error('number')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>

                     <label class="label">
                        <span class="legend">Complemento:</span>
                        <input type="text" name="complement" placeholder="Completo (Opcional)"
                           value="{{ old('complement') }}" />

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
                        value="{{ old('neighborhood') }}" />

                     @error('neighborhood')
                     <span class="message-color" role="alert">
                        <p class="icon-asterisk">{{ $message }}</p>
                     </span>
                     @enderror
                  </label>

                  <div class="label_g2">
                     <label class="label">
                        <span class="legend">*Estado:</span>
                        <input type="text" name="state" class="state" placeholder="Estado" value="{{ old('state') }}" />

                        @error('state')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>

                     <label class="label">
                        <span class="legend">*Cidade:</span>
                        <input type="text" name="city" class="city" placeholder="Cidade" value="{{ old('city') }}" />

                        @error('city')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>
                  </div>
               </div>
            </div>

            <div class="text-right">
               <button class="btn btn-large btn-green icon-check-square-o" type="submit">Criar Empresa</button>
            </div>
         </form>
      </div>
   </div>
</section>
@endsection
