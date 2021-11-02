@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <form action="{{ route('invoice.store') }}" method="post" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <x-form.input name="customer_name" :label="true"/>
                                </div>
                                <div class="col-4">
                                    <x-form.input name="customer_email" :label="true"/>
                                </div>
                                <div class="col-4">
                                    <x-form.input name="customer_mobile" :label="true"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <x-form.input name="company_name" :label="true"/>
                                </div>
                                <div class="col-4">
                                    <x-form.input name="invoice_number" :label="true"/>
                                </div>
                                <div class="col-4">
                                    <x-form.input name="invoice_date" :label="true"/>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table" id="invoice_details">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>product_name</th>
                                        <th>unit</th>
                                        <th>quantity</th>
                                        <th>unit_price</th>
                                        <th>product_subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>#</td>
                                        <td>
                                            <x-form.input name="product_name[]" class="product_name"/>
                                        </td>
                                        <td>
                                            <label>
                                                <select name="unit[]" id="unit" class="unit custom-select mw-13">
                                                    <option disabled selected>Choose...</option>
                                                    <option value="piece">piece</option>
                                                    <option value="g">gram</option>
                                                    <option value="kg">kilo_gram</option>
                                                </select>
                                            </label>
                                            <x-form.error name="unit"/>
                                        </td>
                                        <td>
                                            <x-form.input type="number" name="quantity[]" class="quantity" step="1"
                                                          min="1"/>
                                        </td>
                                        <td>
                                            <x-form.input type="number" name="unit_price[]" class="unit_price"
                                                          step="0.01" min="0"/>
                                        </td>
                                        <td>
                                            <x-form.input type="number" name="row_sub_total[]" class="row_sub_total"
                                                          value="0.00" readonly/>
                                        </td>
                                    </tr>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <x-form.button class="btn-add">
                                                Add Another Product
                                            </x-form.button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">sub_total</td>
                                        <td>
                                            <x-form.input type="number" name="sub_total" class="sub_total" value="0.00"
                                                          readonly/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">discount</td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <select name="discount_type" id="discount_type"
                                                        class="discount_type custom-select">
                                                    <option value="fixed">EGP</option>
                                                    <option value="percentage">Percentage</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <x-form.input type="number" name="discount_value"
                                                                  class="discount_value w-10" step="0.01"
                                                                  value="0.00" min="0"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">vat (5%)</td>
                                        <td>
                                            <x-form.input type="number" name="vat_value" class="vat_value" readonly/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">shipping</td>
                                        <td>
                                            <x-form.input type="number" name="shipping" id="shipping" class="shipping"
                                                          step="0.01"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">total_due</td>
                                        <td>
                                            <x-form.input type="number" name="total_due" id="total_due"
                                                          class="total_due" readonly/>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="text-right px-2">
                                <x-form.button type="submit" name="save">
                                    save invoice
                                </x-form.button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
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

            $('#invoice_details').on('keyup blur', '.quantity, .unit_price, #discount_value, #shipping', function () {
                const row = $(this).closest('tr');
                const quantity = +row.find('.quantity').val();
                const unitPrice = +row.find('.unit_price').val();
                row.find('.row_sub_total').val((quantity * unitPrice).toFixed(2));
                $('#sub_total').val(sumTotal('.row_sub_total'))
                $('#vat_value').val(calcVat());
                $('#total_due').val(sumDueTotal());
            })

            $('#invoice_details #discount_type').on('change', function () {
                $('#vat_value').val(calcVat());
                $('#total_due').val(sumDueTotal());
            })
        })
    </script>
@endsection
