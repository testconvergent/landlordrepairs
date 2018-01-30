$(function() {

    var owner = $('#owner');
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var CVV = $("#cvv");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");
    var submit_package_for_payment = $("#submit_package_for_payment");
    // Use the payform library to format and validate
    // the payment fields.

    cardNumber.payform('formatCardNumber');
    CVV.payform('formatCardCVC');


    cardNumber.keyup(function() {

        amex.removeClass('transparent');
        visa.removeClass('transparent');
        mastercard.removeClass('transparent');

        if ($.payform.validateCardNumber(cardNumber.val()) == false) {
            cardNumberField.addClass('has-error');
        } else {
            cardNumberField.removeClass('has-error');
            cardNumberField.addClass('has-success');
        }

        if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
            mastercard.addClass('transparent');
            amex.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
            mastercard.addClass('transparent');
            visa.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
            amex.addClass('transparent');
            visa.addClass('transparent');
        }
    });
    
    
    confirmButton.click(function(e) {
        e.preventDefault();
        var  validateForm= function() {
            var radios = document.getElementsByName("package");
            if(radios.length){
                var formValid = false;
                var i = 0;
                while (!formValid && i < radios.length) {
                    if (radios[i].checked) formValid = true;
                    i++;        
                }
                return formValid;
            }else{
                return true;
            }
           
        };
        var isCardValid = $.payform.validateCardNumber(cardNumber.val());
        var isCvvValid = $.payform.validateCardCVC(CVV.val());
        var package =validateForm();
        if(owner.val().length < 5){
            toastr.error("Wrong owner name");
        } else if (!isCardValid) {
            toastr.error("Wrong card number");
        } else if (!isCvvValid) {
            toastr.error("Wrong CVV");
        } else if (!package) {
            toastr.error("Must select any package!");
        }
        else {
            // Everything is correct. Add your form submission code here.
            //toastr.error("Everything is correct");
            document.getElementById("submit_package_for_payment").submit();
        }
    });
});
