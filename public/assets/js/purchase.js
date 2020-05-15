function updateSubTotal(obj) {
   var amount = $('#qtd').val();
   var price = $('#price').val();

   if (amount <= 0) {
      $(obj).val(1);
      amount = 1;
   }

   var subtotal = parseFloat(price) * parseInt(amount);

   $(obj).closest('tr').find('.subtotal').html('R$ ' + subtotal.toFixed(2));

   updateTotal();
}

function updateTotal() {
   var total = 0;

   for(var q=0; q<$('.amount').length; q++) {

      var amount =  $('.amount').eq(q);
      var price =  $('.price').eq(q);

      var subtotal = parseFloat(price.val()) * parseInt(amount.val());


      total += subtotal;

   }


   $('input[name=total]').val(total.toFixed(2));
}


function deleteProduct(obj) {
   $(obj).closest('tr').remove();
   updateTotal();
}

function addProd(obj) {
   $('#add_prod').val('');
   var id = $(obj).attr('data-id');
   var price = 0;
   var name = $(obj).attr('data-name');

   $('.searchresults').hide();

   if( $('input[name="amount['+id+']"]').length == 0 ) {
      var tr =
         '<tr>' +
            '<td>' + id + '</td>' +
            '<td>' + name + '</td>' +
            '<td><input type=number min="1" name="amount[' + id + ']" id="qtd" class="amount" value="1" onchange="updateSubTotal(this)"></td>' +
            '<td><input type=text value="0" class="price" name="price['+ id +']" id="price" onchange="updateSubTotal(this)"></td>' +
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

               var html = '<div class="si"><a href="javascript:;" onclick="addProd(this)" data-id="' + json.id + '" data-name="' + json.name + '">' + json.id + ' ' + json.name +'</a></div>';

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
