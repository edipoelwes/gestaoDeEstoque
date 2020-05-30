@extends('admin.master.master')

@section('content')
<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2 class="icon-search">
         {{ isset($client->id) ? 'Editar Cliente' : 'Cadastrar Novo Cliente' }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('clients.index') }}" class="text-orange">Clientes</a></li>
            </ul>
         </nav>
      </div>
   </header>


   <div class="dash_content_app_box">

      <div class="nav">
         <ul class="nav_tabs">
            <li class="nav_tabs_item">
               <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
            </li>
         </ul>

         @if(! isset($client))
         <form action="{{ route('clients.store') }}" method="post" class="app_form" enctype="multipart/form-data">
            @else
            <form action="{{ route('clients.update', ['client' => $client->id]) }}" method="post" class="app_form"
               enctype="multipart/form-data">
               @method('PUT')
               @endif
               @csrf
               <div class="nav_tabs_content">
                  <div id="data">

                     <label class="label">
                        <span class="legend">Empresa:</span>
                        <select name="company_id" class="select2">
                           <option value="">Selecione uma Empresa</option>
                           @foreach ($companies as $company)
                           <option value="{{ $company->id }}"
                              {{ set_selected($company->id, old('company_id', $client->company_id ?? null)) }}>
                              {{ $company->social_name }}</option>
                           @endforeach
                        </select>

                        @error('company_id')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>

                     <div class="label_g2">
                        <label class="label">
                           <span class="legend">*Nome:</span>
                           <input type="text" name="name" placeholder="Nome Completo"
                              value="{{ old('name', $client->name ?? null) }}" autocomplete="off" />

                           @error('name')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>

                        <label class="label">
                           <span class="legend">*CPF:</span>
                           <input type="tel" class="mask-doc" name="document" placeholder="CPF do Cliente"
                              value="{{ old('document', $client->document ?? null) }}" />

                           @error('document')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>
                     </div>

                     <div class="label_g2">
                        <label class="label">
                           <span class="legend">*Celular 1:</span>
                           <input type="tel" name="phone" class="mask-cell" placeholder="Número do Telefonce com DDD"
                              value="{{ old('phone', $client->phone ?? null) }}" />

                           @error('phone')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>

                        <label class="label">
                           <span class="legend">*Celular 2:</span>
                           <input type="tel" name="phone_secondary" class="mask-cell"
                              placeholder="Número do Telefonce com DDD"
                              value="{{ old('phone_secondary', $client->phone_secondary ?? null) }}" />

                           @error('phone_secondary')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>
                     </div>

                     <div class="app_collapse mt-2">
                        <div class="app_collapse_header collapse">
                           <h3>Endereço</h3>
                           <span class="icon-plus-circle icon-notext"></span>
                        </div>

                        <div class="app_collapse_content d-none">
                           <div class="label_g2">
                              <label class="label">
                                 <span class="legend">*CEP:</span>
                                 <input type="tel" name="zipcode" class="mask-zipcode zip_code_search"
                                    placeholder="Digite o CEP" value="{{ old('zipcode', $client->zipcode ?? null) }}" />

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
                                 value="{{ old('street', $client->street ?? null) }}" />

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
                                    value="{{ old('number', $client->number ?? null) }}" />

                                 @error('number')
                                 <span class="message-color" role="alert">
                                    <p class="icon-asterisk">{{ $message }}</p>
                                 </span>
                                 @enderror
                              </label>

                              <label class="label">
                                 <span class="legend">Complemento:</span>
                                 <input type="text" name="complement" placeholder="Completo (Opcional)"
                                    value="{{ old('complement', $client->complement ?? null) }}" />
                              </label>
                           </div>

                           <label class="label">
                              <span class="legend">*Bairro:</span>
                              <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro"
                                 value="{{ old('neighborhood', $client->neighborhood ?? null) }}" />

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
                                    value="{{ old('state', $client->state ?? null) }}" />

                                 @error('state')
                                 <span class="message-color" role="alert">
                                    <p class="icon-asterisk">{{ $message }}</p>
                                 </span>
                                 @enderror
                              </label>

                              <label class="label">
                                 <span class="legend">*Cidade:</span>
                                 <input type="text" name="city" class="city" placeholder="Cidade"
                                    value="{{ old('city', $client->city ?? null) }}" />

                                 @error('city')
                                 <span class="message-color" role="alert">
                                    <p class="icon-asterisk">{{ $message }}</p>
                                 </span>
                                 @enderror
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               @if ( isset($client))
               <div class="text-right mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Atualizar Dados</button>
               </div>
               @else
               <div class="text-right mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Dados</button>
               </div>
               @endif

            </form>
      </div>
   </div>
</section>
@endsection
