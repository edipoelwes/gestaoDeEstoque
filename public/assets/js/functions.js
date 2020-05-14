function confirmDelete(itemId) {
   Swal.fire({
      title: 'Atenção',
      text: 'Deseja realmente excluir o registro selecionado?',
      type: 'warning',
      //input: 'text',
      //inputPlaceholder: 'Informe o motivo',
      //position: 'top-end',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#aaa',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sim, excluir!',
      reverseButtons: true,
      preConfirm: motive => {
         if (!motive) {
            $('.swal2-input').addClass('swal2-inputerror')
            return false
         }
      },
   }).then(result => {

      if (!result.value) return false

      $('#btn-delete-' + itemId)
         .prepend(`<input type="hidden" name="motive" value="${result.value}" />`)
         .submit()
   })
}
