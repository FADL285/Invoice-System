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
                                    <x-product.row order="0" :isSecondary="false"/>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <x-form.button class="btn-add" id="add-product">
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
                                                                  class="discount_value w-10" step="1"
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
        addProduct(`<x-product.row />`)
    </script>
@endsection
