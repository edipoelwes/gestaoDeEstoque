@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-user-plus">
         {{ isset($user->id) ? 'Editar Usuario' : 'Cadastrar Novo Usuario' }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('users.index') }}">Clientes</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('users.create') }}" class="text-orange">Novo Cliente</a></li>
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

         @if(! isset($user))
            <form action="{{ route('users.store') }}" method="post" class="app_form"
               enctype="multipart/form-data">
            @else
               <form
                  action="{{ route('users.update', ['user' => $user->id]) }}"
                  method="post" class="app_form" enctype="multipart/form-data">
                  @method('PUT')
         @endif
         @csrf

         <div class="nav_tabs_content">
            <div id="data">
               <div class="label">
                  <label class="label">
                     <span class="legend">*Nome:</span>
                     <input type="text" name="name" placeholder="Nome Completo"
                        value="{{ old('name', $user->name ?? null) }}" />

                     @error('name')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                     @enderror
                  </label>
               </div>

               <div class="label_g2">

                  <label class="label">
                     <span class="legend">*CPF:</span>
                     <input type="tel" class="mask-doc" name="document" placeholder="CPF do Cliente"
                        value="{{ old('document', $user->document ?? null) }}" />

                     @error('document')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                     @enderror
                  </label>

                  <label class="label">
                     <span class="legend">Foto</span>
                     <input type="file" name="cover">
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
                              placeholder="Digite o CEP" value="{{ old('zipcode', $user->zipcode ?? null) }}" />

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
                           value="{{ old('street', $user->street ?? null) }}" />

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
                              value="{{ old('number', $user->number ?? null) }}" />

                           @error('number')
                              <span class="message-color" role="alert">
                                 <p class="icon-asterisk">{{ $message }}</p>
                              </span>
                           @enderror
                        </label>

                        <label class="label">
                           <span class="legend">Complemento:</span>
                           <input type="text" name="complement" placeholder="Completo (Opcional)"
                              value="{{ old('complement', $user->complement ?? null) }}" />
                        </label>
                     </div>

                     <label class="label">
                        <span class="legend">*Bairro:</span>
                        <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro"
                           value="{{ old('neighborhood', $user->neighborhood ?? null) }}" />

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
                              value="{{ old('state', $user->state ?? null) }}" />

                           @error('state')
                              <span class="message-color" role="alert">
                                 <p class="icon-asterisk">{{ $message }}</p>
                              </span>
                           @enderror
                        </label>

                        <label class="label">
                           <span class="legend">*Cidade:</span>
                           <input type="text" name="city" class="city" placeholder="Cidade"
                              value="{{ old('city', $user->city ?? null) }}" />

                           @error('city')
                              <span class="message-color" role="alert">
                                 <p class="icon-asterisk">{{ $message }}</p>
                              </span>
                           @enderror
                        </label>
                     </div>
                  </div>
               </div>

               <div class="app_collapse mt-2">
                  <div class="app_collapse_header collapse">
                     <h3>Contato</h3>
                     <span class="icon-plus-circle icon-notext"></span>
                  </div>

                  <div class="app_collapse_content d-none">
                     <div class="label_g2">
                        <label class="label">
                           <span class="legend">Residencial:</span>
                           <input type="tel" name="telephone" class="mask-phone"
                              placeholder="Número do Telefonce com DDD"
                              value="{{ old('telephone', $user->telephone ?? null) }}" />
                        </label>

                        <label class="label">
                           <span class="legend">*Celular:</span>
                           <input type="tel" name="cell" class="mask-cell" placeholder="Número do Telefonce com DDD"
                              value="{{ old('cell', $user->cell ?? null) }}" />

                           @error('cell')
                              <span class="message-color" role="alert">
                                 <p class="icon-asterisk">{{ $message }}</p>
                              </span>
                           @enderror
                        </label>
                     </div>
                  </div>
               </div>

               <div class="app_collapse mt-2">
                  <div class="app_collapse_header collapse">
                     <h3>Acesso</h3>
                     <span class="icon-plus-circle icon-notext"></span>
                  </div>

                  <div class="app_collapse_content d-none">
                     <div class="label_g2">
                        <label class="label">
                           <span class="legend">*E-mail:</span>
                           <input type="email" name="email" placeholder="Melhor e-mail"
                              value="{{ old('email', $user->email ?? null) }}" />

                           @error('email')
                              <span class="message-color" role="alert">
                                 <p class="icon-asterisk">{{ $message }}</p>
                              </span>
                           @enderror
                        </label>

                        <label class="label">
                           <span class="legend">Senha:</span>
                           <input type="password" name="password" placeholder="Senha de acesso" value="" />

                           @error('password')
                              <span class="message-color" role="alert">
                                 <p class="icon-asterisk">{{ $message }}</p>
                              </span>
                           @enderror
                        </label>
                     </div>
                  </div>
               </div>
            </div>
            @if( isset($user))
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
