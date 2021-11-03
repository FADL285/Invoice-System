function sumTotal(selector) {
    let sum = 0;
    $(selector).each(function () {
        sum += +$(this).val();
    })
    return sum.toFixed(2)
}

function calcDiscount() {
    const sub_totalVal = +$('.sub_total').val();
    const discountType = $('.discount_type').val();
    const discountVal = +$('.discount_value').val();
    let netDiscountVal = 0;
    if (discountVal !== 0) {
        netDiscountVal = discountType === 'percentage' ? (sub_totalVal * (discountVal / 100)) : discountVal;
    }
    return netDiscountVal;
}

function calcVat() {
    const sub_totalVal = +$('.sub_total').val();
    return ((sub_totalVal - calcDiscount()) * 0.05).toFixed(2);
}

function sumDueTotal() {
    let sum = 0;
    sum += +$('.sub_total').val();
    sum -= calcDiscount();
    sum += +$('#vat_value').val();
    sum += +$('#shipping').val();
    return sum;
}

function summary() {
    $('#sub_total').val(sumTotal('.row_sub_total'))
    $('#vat_value').val(calcVat());
    $('#total_due').val(sumDueTotal());
}

addProduct = function (product) {
    $('#invoice_details #add-product').on('click', function () {
        $('#invoice_details').find('tbody').append(product);
    })
}

$(function () {

    $('#invoice_details').on('keyup blur', '.quantity, .unit_price, #discount_value, #shipping', function () {
        const row = $(this).closest('tr');
        const quantity = +row.find('.quantity').val();
        const unitPrice = +row.find('.unit_price').val();
        row.find('.row_sub_total').val((quantity * unitPrice).toFixed(2));
        summary()
    })

    $('#invoice_details #discount_type').on('change', function () {
        $('#vat_value').val(calcVat());
        $('#total_due').val(sumDueTotal());
    })

    $('#invoice_details').on('click', '.delete_product', function () {
        $(this).parent().parent().remove();
        summary();
    })
})
