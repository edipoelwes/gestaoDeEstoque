function updateSubTotal(obj) {
   var amount = $(obj).val();

   if (amount <= 0) {
      $(obj).val(1);
      amount = 1;
   }

   var price = $(obj).attr('data-price');
   var subtotal = parseFloat(price) * parseInt(amount);

   $(obj).closest('tr').find('.subtotal').html('R$ ' + subtotal);

   updateTotal();
}

function updateTotal(disc = 0 ) {
   var total = 0;
   var discount = parseFloat(disc);

   for(var q=0; q<$('.amount').length; q++) {

      var amount =  $('.amount').eq(q);

      var price = amount.attr('data-price');
      var subtotal = parseFloat(price) * parseInt(amount.val());

      total += subtotal;

   }

   total -= discount;

   $('input[name=total_price]').val(total);
}

function updateDiscount() {
   var disc = $('#discount').val();

   if(disc === ''){
      disc = '0,0';
   }

   var discount = disc.replace(',', '.');

   updateTotal(discount);

}

function deleteProduct(obj) {
   $(obj).closest('tr').remove();
   updateTotal();
}

function addProd(obj) {
   $('#add_prod').val('');
   var id = $(obj).attr('data-id');
   var price = $(obj).attr('data-price');
   var name = $(obj).attr('data-name');

   $('.searchresults').hide();

   if( $('input[name="amount['+id+']"]').length == 0 ) {
      var tr =
         '<tr>' +
         '<td>' + id + '</td>' +
         '<td>' + name + '</td>' +
         '<td><input type=number min="1" name="amount[' + id + ']" class="amount" value="1" data-price="' + price + '" onchange="updateSubTotal(this)"></td>' +
         '<td>R$ ' + price + '</td>' +
         '<td class="subtotal">R$ ' + price + '</td>' +
         '<td><a href="javascript:;" onclick="deleteProduct(this)"><span class="icon-trash-o text-orange"></span></a></td>' +
         '</tr>';

      $('#products_table').append(tr);
   }

   updateTotal();
}

$(function () {

   $('#add_prod').on('blur', function () {
      setTimeout(function () {
         $('.searchresults').hide();
      }, 500);

   });


   $('#add_prod').on('keyup', function () {

      var datatype = $(this).attr('data-type');
      var input = $(this).val();

      if (datatype != '') {
         $.ajax({
            //url:BASE_URL+'/ajax/'+datatype,
            url: BASE_URL + '/' + datatype,
            type: 'GET',
            data: {
               input: input
            },
            dataType: 'json',
            success: function (json) {
               //console.log(json);
               if ($(".searchresults").length == 0) {
                  $('#add_prod').after('<div class="searchresults"></div>');
               }

               var html = '<div class="si"><a href="javascript:;" onclick="addProd(this)" data-id="' + json.id + '"data-price="' + json.price + '" data-name="' + json.name + '">' + json.id + ' ' + json.name + ' - R$ ' + json.price + '</a></div>';

               // for(var item in json) {
               //    html += '<div class="si">'+json[item].id+'</div>';
               // }

               $('.searchresults').html(html);

               $('.searchresults').show();

            }
         });
      }
   });
});
