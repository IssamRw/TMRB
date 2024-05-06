$(document).ready(function (){

    alertify.set('notifier','position', 'top-right');

    $(document).on('click', '.increment', function () {

        var $quantiteInput = $(this).closest('.qtyBox').find('.qty');
        var produitId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantiteInput.val());

        if(!isNaN(currentValue)){
            var qtyVal = currentValue + 1;
            $quantiteInput.val(qtyVal);
            quantiteIncDec(produitId, qtyVal);
        }
    });
     
    $(document).on('click', '.decrement', function () {

        var $quantiteInput = $(this).closest('.qtyBox').find('.qty');
        var produitId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantiteInput.val());

        if(!isNaN(currentValue) && currentValue > 1){
            var qtyVal = currentValue - 1;
            $quantiteInput.val(qtyVal);
            quantiteIncDec(produitId, qtyVal);
        }
    });
    
    function quantiteIncDec(prodId, qty){
      $.ajax({
           type: "POST",
           url: "financier-code.php",
           data: {
            'produitIncDec': true,
            'produit_id': prodId,
            'quantite': qty
           },
         
           success: function (response) {
            var res = JSON.parse(response);
       
            if(res.status == 200){
               $('#produitArea').load(' #produitContent');
                alertify.success(res.message);


            }else{
                $('#produitArea').load(' #produitContent');
                alertify.error(res.message);
            }
           }
      });
     
    }
 // proceed to place oreder button
 $(document).on('click', '.proceedToPlace', function () {
   // console.log('proceedToPlace');

  var preference = $('#preference').val(); 
  var payment_mode = $('#payment_mode').val(); 

  if(preference == ''){
    swal("Select Projet","Select your Projet","warning");
    return false;
 }
  if(payment_mode == ''){
    swal("Select Payment Mode","Select your Payment mode","warning");
    return false;
 }

 var data = {
    'proceedToPlace': true,
    'preference': preference,
    'payment_mode': payment_mode,
 };
 
  $.ajax({
    type: "POST",
    url: "financier-code.php",
    data: data,
    success: function (response) {
           var res =JSON.parse(response);
           if(res.status == 200){
            window.location.href = "financier-summary.php";

           }else if(res.status == 404){
            swal(res.message, res.message, res.status_type, {
                buttons: {
                    catch: {
                        text: "add projet",
                        value: "catch"
                    },
                    cancel: "Cancel"
                }
            })
            .then((value) =>{
                switch(value){
                    case "catch":
                        $('#c_reference').val(preference);
                        $('#addProjetModal').modal('show');
                        break;
                        default:
                }
            });

           }else{
            swal(res.message, res.message, res.status_type);
           }
    }
   });

 });
   //add projet 
   $(document).on('click', '.saveProjet', function () {
      
    var c_name = $('#c_name').val();
    var c_description = $('#c_description').val();
    var c_reference = $('#c_reference').val();

    if(c_name != '' && c_reference != ''){ 
         if($.isNumeric(c_reference)){
            var data ={
               'saveProjetbtn' :true,
               'nameprojet' : c_name,
               'description' : c_description,
               'reference' : c_reference,
            };
             $.ajax({
                type: "POST",
                url: "financier-code.php",
                data: data,
                success: function (response){
                     var res = JSON.parse(response);
                     if(res.status == 200){
                        swal(res.message, res.message, res.status_type);
                        $('#addProjetModal').modal('hide');
                     }else if(res.status == 422){
                        swal(res.message, res.message, res.status_type);
                    }else{
                        swal(res.message, res.message, res.status_type);
                     }
                }
             });

         }else{
            swal("Enter valid reference","","warning");
         }
    }else{
        swal("Please fill required fields","","warning");
    }
   });
   
   $(document).on('click', '#saveFinancier', function () {

    $.ajax({
         type: "POST",
         url: "financier-code.php",
         data: {
            'saveFinancier': true
         },
         success: function (response){
          var res = JSON.parse(response);

          if(res.status == 200){
            swal(res.message, res.message, res.status_type);
            $('#financierPlaceSuccessMessage').text(res.message);
            $('#financierSuccessModal').modal('show');

          }else{
            swal(res.message, res.message, res.status_type);
          }
         }
    });
  
   });
});


function printMyBillingArea() {
    var divContents = document.getElementById("myBillingArea").innerHTML;
    var a = window.open('', '');
    a.document.write('<html><title>POS System in php </title>');
    a.document.write('<body style="font-family: fangsong;">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
}


window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function downloadPDF(invoiceNo){
    var elementHTML = document.querySelector("#myBillingArea");
    docPDF.html(elementHTML, {
        callback: function(){
        docPDF.save(invoiceNo+'.pdf');
        },
        x: 15,
        y: 15,
        width: 170,
        windowWidth: 650


    });

}
