(function (jQuery) {
    $.opt = {};  // jQuery Object

    jQuery.fn.invoice = function (options) {
        var ops = jQuery.extend({}, jQuery.fn.invoice.defaults, options);
        $.opt = ops;

        var inv = new Invoice();
        inv.init();

        jQuery('body').on('click', function (e) {
            var cur = e.target.id || e.target.className;

            if (cur == $.opt.addRow.substring(1))
                inv.newRow();

            if (cur == $.opt.delete.substring(1))
                inv.deleteRow(e.target);

            inv.init();
        });

        jQuery('body').on('keyup', function (e) {
            inv.init();
        });

        return this;
    };
}(jQuery));

function Invoice() {
    self = this;
}

Invoice.prototype = {
    constructor: Invoice,

    init: function () {
        this.calcTotal();
        this.calcTotalQty();
        this.calcSubtotal();
        this.calcTax();
        this.calcDiscount();
        this.calcGrandTotal();
    },

    calcTotal: function () {
         jQuery($.opt.parentClass).each(function (i) {
             var row = jQuery(this);
             var total = row.find($.opt.price).val() * row.find($.opt.qty).val();

             total = self.roundNumber(total, 2);

             row.find($.opt.total).html(total);
         });

         return 1;
     },
	
    calcTotalQty: function () {
         var totalQty = 0;
         jQuery($.opt.qty).each(function (i) {
             var qty = jQuery(this).val();
             if (!isNaN(qty)) totalQty += Number(qty);
         });

         totalQty = self.roundNumber(totalQty, 2);

         jQuery($.opt.totalQty).html(totalQty);

         return 1;
     },

    calcSubtotal: function () {
         var subtotal = 0;
         jQuery($.opt.total).each(function (i) {
             var total = jQuery(this).html();
             if (!isNaN(total)) subtotal += Number(total);
         });

         subtotal = self.roundNumber(subtotal, 2);

         jQuery($.opt.subtotal).html(subtotal);
         jQuery($.opt.subtotal_form).val(subtotal);

         return 1;
     },

    calcTax: function () {
        var tax = 0;
        var tax = (Number(jQuery($.opt.subtotal).html())
                       * 7.7) / 100;
        tax = self.roundNumber(tax, 2);

        jQuery($.opt.tax).html(tax);
        jQuery($.opt.tax_form).val(tax);

        return 1;
    },

    calcDiscount: function () {
        var discount = 0;
        var total_discount_form = 0;
        var total_discount_form = ((Number(jQuery($.opt.subtotal).html())
                           + Number(jQuery($.opt.tax).html()))
                           * Number(jQuery($.opt.discount).val())) / 100;
        total_discount_form = self.roundNumber(total_discount_form, 2);

        jQuery($.opt.total_discount_form).html(total_discount_form);
        jQuery($.opt.total_discount_form).val(total_discount_form);

        return 1;
    },

    calcGrandTotal: function () {
        var grand_total = Number(jQuery($.opt.subtotal).html())
                       + Number(jQuery($.opt.tax).html())
                       - Number(jQuery($.opt.total_discount_form).html());
        grand_total = self.roundNumber(grand_total, 2);

        jQuery($.opt.grand_total).html(grand_total);
        jQuery($.opt.grand_total_form).val(grand_total);

        return 1;
    },

    newRow: function () {

    },

    deleteRow: function (elem) {
        jQuery(elem).parents($.opt.parentClass).remove();

        if (jQuery($.opt.delete).length < 1) {
            jQuery($.opt.delete).hide();
        }

        return 1;
    },

    roundNumber: function (number, decimals) {
        var newString;// The new rounded number
        decimals = Number(decimals);

        if (decimals < 1) {
            newString = (Math.round(number)).toString();
        } else {
            var numString = number.toString();

            if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
                numString += ".";// give it one at the end
            }

            var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
            var d1 = Number(numString.substring(cutoff, cutoff + 1));// The value of the last decimal place that we'll end up with
            var d2 = Number(numString.substring(cutoff + 1, cutoff + 2));// The next decimal, after the last one we want

            if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
                if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
                    while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
                        if (d1 != ".") {
                            cutoff -= 1;
                            d1 = Number(numString.substring(cutoff, cutoff + 1));
                        } else {
                            cutoff -= 1;
                        }
                    }
                }

                d1 += 1;
            }

            if (d1 == 10) {
                numString = numString.substring(0, numString.lastIndexOf("."));
                var roundedNum = Number(numString) + 1;
                newString = roundedNum.toString() + '.';
            } else {
                newString = numString.substring(0, cutoff) + d1.toString();
            }
        }

        if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
            newString += ".";
        }

        var decs = (newString.substring(newString.lastIndexOf(".") + 1)).length;

        for (var i = 0; i < decimals - decs; i++)
            newString += "0";
        //var newNumber = Number(newString);// make it a number if you like

        return newString; // Output the result to the form field (change for your purposes)
    }
};

jQuery.fn.invoice.defaults = {
    addRow: "#addRow",
    delete: ".delete",
    parentClass: ".item-row",

    price: ".price",
    qty: ".qty",
    total: ".total",
    totalQty: "#totalQty",

    subtotal : "#subtotal",
    subtotal_form : "#subtotal_form",
    tax: "#tax",
    tax_form : "#tax_form",
    discount: "#discount",
    discount_form: "#discount_form",
    total_discount_form: "#total_discount_form",
    grand_total : "#grand_total",
    grand_total_form: "#grand_total_form"
};
